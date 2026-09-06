<?php

namespace App\Services;

use App\Models\Admin\Promo;
use App\Models\Admin\Reservation;
use Carbon\Carbon;

/* Discount codes were in the page source, readable by anyone, with no counter.
   This class is why they can move. Every reason a code can fail is named, so the
   front end can say something useful instead of "invalid code". */
class PromoService
{
    public const OK          = null;
    public const UNKNOWN     = 'unknown';
    public const INACTIVE    = 'inactive';
    public const EXPIRED     = 'expired';
    public const NOT_YET     = 'notyet';
    public const MIN_NIGHTS  = 'minnights';
    public const STAY_LIMIT  = 'staylimit';
    public const EXHAUSTED   = 'exhausted';
    public const ALREADY_USED = 'alreadyused';

    /** The reason it cannot be used, or null when it can. */
    public function problem(
        ?string $code,
        $stay,
        int $nights,
        Carbon $checkIn,
        ?string $email = null
    ): ?string {
        if (blank($code)) return self::UNKNOWN;

        $promo = Promo::code($code)->first();
        if (! $promo)             return self::UNKNOWN;
        if (! $promo->is_active)  return self::INACTIVE;
        if ($promo->exhausted())  return self::EXHAUSTED;

        /* Dates are checked against the STAY date, not today. A guest booking in
           August for a February stay should get the winter code. */
        if ($promo->starts_on && $checkIn->lt($promo->starts_on))  return self::NOT_YET;
        if ($promo->ends_on   && $checkIn->gt($promo->ends_on))    return self::EXPIRED;

        if ($promo->min_nights && $nights < $promo->min_nights)    return self::MIN_NIGHTS;

        if (filled($promo->stay_slugs) && ! in_array($stay->slug, $promo->stay_slugs, true)) {
            return self::STAY_LIMIT;
        }

        if ($promo->max_uses_per_email && filled($email)) {
            $used = Reservation::where('promo_id', $promo->id)
                ->where('guest_email', $email)
                ->whereIn('status', ['pending', 'confirmed', 'completed'])
                ->count();

            if ($used >= $promo->max_uses_per_email) return self::ALREADY_USED;
        }

        return self::OK;
    }

    public function validate(?string $code, $stay, int $nights, Carbon $checkIn, ?string $email = null): ?Promo
    {
        return $this->problem($code, $stay, $nights, $checkIn, $email) === self::OK
            ? Promo::code($code)->first()
            : null;
    }

    /* Called once, when a reservation is actually created. Not at quote time: a
       thousand people pricing a stay must not exhaust a code. */
    public function consume(Promo $promo): void
    {
        $promo->increment('used_count');
    }

    public function release(Promo $promo): void
    {
        if ($promo->used_count > 0) $promo->decrement('used_count');
    }
}
