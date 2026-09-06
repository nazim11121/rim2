<?php

namespace App\Services;

use App\Models\Admin\Reservation;
use App\Models\Admin\Setting;
use App\Models\Admin\Stay;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

/* Two questions, deliberately separate:
     1. Is this stay free?          overlapping reservations on the stay
     2. Is the property over cap?   20 guests across everything, at once

   The Pod is sold as a whole unit, so question 1 is "is any Pod reservation
   already overlapping", never "is room 4 free". If the Pod is ever part-sold
   this class is the only place that changes. */
class AvailabilityService
{
    public function isAvailable(Stay $stay, Carbon $checkIn, Carbon $checkOut, ?int $ignoreReservationId = null): bool
    {
        return ! Reservation::query()
            ->where('stay_id', $stay->id)
            ->blocking()
            ->overlapping($checkIn->toDateString(), $checkOut->toDateString())
            ->when($ignoreReservationId, fn ($q) => $q->where('id', '!=', $ignoreReservationId))
            ->exists();
    }

    /** The whole property holds 20 guests. Checked per night, not per reservation. */
    public function withinCapacity(Carbon $checkIn, Carbon $checkOut, int $addingGuests, ?int $ignoreReservationId = null): bool
    {
        $cap = (int) Setting::get('property_max_guests', 20);

        foreach (CarbonPeriod::create($checkIn, $checkOut->copy()->subDay()) as $night) {
            $onThatNight = (int) Reservation::query()
                ->blocking()
                ->where('check_in', '<=', $night->toDateString())
                ->where('check_out', '>', $night->toDateString())
                ->when($ignoreReservationId, fn ($q) => $q->where('id', '!=', $ignoreReservationId))
                ->sum('guests');

            if ($onThatNight + $addingGuests > $cap) return false;
        }

        return true;
    }

    /** Every reason a reservation cannot be taken, for the API to report at once. */
    public function problems(Stay $stay, int $guests, Carbon $checkIn, Carbon $checkOut): array
    {
        $problems = [];

        if ($checkIn->lt(now()->startOfDay())) {
            $problems[] = 'check_in_past';
        }
        if ($checkOut->lte($checkIn)) {
            $problems[] = 'check_out_before_check_in';
        }
        if ($stay->whole_unit_only && $guests < $stay->min_guests) {
            // The Pod is whole-unit only: a party of four cannot book it for four.
            $problems[] = 'below_whole_unit_minimum';
        }
        if ($guests > $stay->max_guests) {
            $problems[] = 'over_stay_capacity';
        }
        if (! $this->isAvailable($stay, $checkIn, $checkOut)) {
            $problems[] = 'dates_taken';
        }
        if (! $this->withinCapacity($checkIn, $checkOut, $guests)) {
            $problems[] = 'property_at_capacity';
        }

        return $problems;
    }

    /** Dates already gone, for a calendar to grey out. */
    public function bookedDates(Stay $stay, Carbon $from, Carbon $to): array
    {
        $dates = [];

        Reservation::where('stay_id', $stay->id)->blocking()
            ->overlapping($from->toDateString(), $to->toDateString())
            ->get(['check_in', 'check_out'])
            ->each(function ($r) use (&$dates) {
                foreach (CarbonPeriod::create($r->check_in, $r->check_out->copy()->subDay()) as $d) {
                    $dates[] = $d->toDateString();
                }
            });

        return array_values(array_unique($dates));
    }
}
