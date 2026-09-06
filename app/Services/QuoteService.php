<?php

namespace App\Services;

use App\Exceptions\PricingException;
use App\Models\Admin\Promo;
use App\Models\Admin\Setting;
use App\Models\Admin\Stay;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

/* THE SINGLE SOURCE OF PRICE, server side.

   Read this before changing a number. Four rules, each of which has already
   caused a bug once:

   1. EVERY component is rounded to whole taka, and the rest is DERIVED from the
      rounded figures. Round at print time instead and 12,112.5 and 2,137.5 print
      as 12,112 and 2,137, which do not add up to 14,250 on screen. Guests notice.

   2. The weekday reduction is applied ONCE. For cottages it is a flat 15% off the
      full rate. For the Pod it is already inside the stored weekday_rate, so
      applying it again would double-discount. Stay::discountBakedIn() is the
      switch.

   3. VAT is NEVER included in a displayed nightly rate. It is added at checkout,
      and only there. The floating bar on the site shows net.

   4. A promo applies AFTER the weekday reduction, never before, and a flat promo
      can never exceed the amount owed.

   DIVERGENCE FROM THE FRONT END, on purpose: rates-data.js picks one rate from
   the CHECK-IN day and applies it to every night, because a browser widget
   cannot know the holiday table. This service prices EACH NIGHT on its own
   calendar day, which is correct for a Thursday-to-Saturday stay. So the two can
   differ on a stay that straddles a weekend. That is why the widget calls
   GET /api/quote when the API is reachable and treats its own arithmetic as an
   estimate when it is not. Never "fix" this by making the server match the
   browser. */
class QuoteService
{
    public function __construct(private ?AvailabilityService $availability = null) {}

    /**
     * @return array{nightly:int,nights:int,gross:int,weekday_discount:int,promo_discount:int,net:int,vat:int,total:int,breakdown:array}
     */
    public function for(
        Stay $stay,
        int $guests,
        Carbon $checkIn,
        Carbon $checkOut,
        ?string $promoCode = null
    ): array {
        $nights = $checkIn->diffInDays($checkOut);

        if ($nights < 1) {
            throw new PricingException('Check-out must be at least one night after check-in.');
        }
        if ($guests < $stay->min_guests || $guests > $stay->max_guests) {
            throw new PricingException(
                "{$stay->name} takes {$stay->min_guests} to {$stay->max_guests} guests, not {$guests}."
            );
        }

        $tier = $this->tierFor($stay, $guests);
        $bakedIn = $stay->discountBakedIn();
        $weekdayOff = (float) Setting::get('weekday_discount', 0.15);

        /* One row per night, priced on its own date. This array is what makes a
           disputed invoice answerable: it says exactly which night cost what. */
        $breakdown = [];
        $gross = 0;
        $weekdayDiscount = 0;

        foreach (CarbonPeriod::create($checkIn, $checkOut->copy()->subDay()) as $night) {
            $peak = $this->isPeak($night);
            $rate = $peak ? $tier->weekend_rate : $tier->weekday_rate;

            $nightGross = $rate * $guests;
            /* Cottages: weekday_rate holds the FULL rate, and the reduction is
               taken here so the guest can see what they saved. The Pod's tiers
               already differ by day, so there is nothing to take. */
            $nightOff = ($peak || $bakedIn) ? 0 : (int) round($nightGross * $weekdayOff);

            $gross += $nightGross;
            $weekdayDiscount += $nightOff;

            $breakdown[] = [
                'date'     => $night->toDateString(),
                'day'      => $night->format('D'),
                'peak'     => $peak,
                'rate'     => $rate,
                'gross'    => $nightGross,
                'discount' => $nightOff,
            ];
        }

        $afterDays = $gross - $weekdayDiscount;

        [$promo, $promoDiscount] = $this->promoFor($promoCode, $stay, $nights, $checkIn, $afterDays);

        $net = $afterDays - $promoDiscount;
        $vat = (int) round($net * (float) Setting::get('vat_rate', 0.15));

        return [
            'stay_slug'        => $stay->slug,
            'guests'           => $guests,
            'nights'           => $nights,
            'nightly'          => $tier->weekend_rate,   // the headline figure, before any reduction
            'gross'            => $gross,
            'weekday_discount' => $weekdayDiscount,
            'promo_code'       => $promo?->code,
            'promo_label'      => $promo?->label,
            'promo_discount'   => $promoDiscount,
            'net'              => $net,                  // what the floating bar shows
            'vat'              => $vat,                  // added at checkout only
            'total'            => $net + $vat,
            'currency'         => 'BDT',
            'breakdown'        => $breakdown,
        ];
    }

    /* "The tier whose from_guests is the highest value not exceeding the party
       size." One sentence, both pricing modes: cottages have tiers at 1/2/3, the
       Pod at 6/8/10. */
    public function tierFor(Stay $stay, int $guests)
    {
        $tier = $stay->rateTiers()
            ->where('from_guests', '<=', $guests)
            ->orderByDesc('from_guests')
            ->first();

        if (! $tier) {
            /* Deliberately an exception, not a fallback to the cheapest tier.
               A silent fallback is how a single guest gets charged the
               three-sharing rate and nobody notices for a month. */
            throw new PricingException("No rate tier covers {$guests} guests in {$stay->slug}.");
        }

        return $tier;
    }

    /** Friday, Saturday and anything in the holiday table are full rate. */
    public function isPeak(Carbon $date): bool
    {
        $weekendDays = (array) Setting::get('weekend_days', [5, 6]);   // 0 = Sunday
        $holidays    = (array) Setting::get('holidays', []);

        return in_array($date->dayOfWeek, $weekendDays, true)
            || in_array($date->toDateString(), $holidays, true);
    }

    /** @return array{0: ?Promo, 1: int} */
    private function promoFor(?string $code, Stay $stay, int $nights, Carbon $checkIn, int $base): array
    {
        if (blank($code)) {
            return [null, 0];
        }

        $promo = app(PromoService::class)->validate($code, $stay, $nights, $checkIn);

        if (! $promo) {
            return [null, 0];   // an invalid code is ignored, never an error at quote time
        }

        $discount = $promo->type === 'pct'
            ? (int) round($base * (float) $promo->value)
            : min((int) $promo->value, $base);   // a flat promo can never exceed what is owed

        return [$promo, $discount];
    }
}
