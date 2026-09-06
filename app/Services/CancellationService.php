<?php

namespace App\Services;

use App\Models\Admin\Reservation;
use Illuminate\Support\Facades\DB;

/* Cancelling a reservation.

   ⚠ THE POLICY BELOW IS A PLACEHOLDER AND MUST BE CONFIRMED BY THE RESORT.
   It is written as a sane default so the code is complete, not because anyone
   has approved these numbers. Set the real tiers in config/bonomali.php and
   publish them on the site before taking a single live booking: a refund rule a
   guest has not seen is a rule you cannot enforce.

   Default: 7 days or more, full refund. 3 to 6 days, 50%. Under 3 days, none.

   No payment gateway in this build (see the reservations-table migration
   comment): the resort takes deposits directly, off-platform. So cancel() does
   NOT attempt any refund transaction — it just updates status and releases the
   promo. refund_due is informational, for staff to action manually. */
class CancellationService
{
    /** Whole taka that SHOULD be returned, given how far out the stay is. Informational only. */
    public function refundDue(Reservation $reservation): int
    {
        if ($reservation->amount_paid < 1) return 0;

        $daysOut = now()->startOfDay()->diffInDays($reservation->check_in, false);

        // Ordered tiers: the first whose threshold is met wins.
        $tiers = collect(config('bonomali.cancellation_tiers', [
            ['days' => 7, 'refund' => 1.0],
            ['days' => 3, 'refund' => 0.5],
            ['days' => 0, 'refund' => 0.0],
        ]))->sortByDesc('days');

        $ratio = 0.0;
        foreach ($tiers as $t) {
            if ($daysOut >= $t['days']) { $ratio = (float) $t['refund']; break; }
        }

        return (int) round($reservation->amount_paid * $ratio);
    }

    /**
     * Cancel a reservation. Staff action from the admin panel, not a
     * guest-facing endpoint: cancellation should always pass a human.
     */
    public function cancel(Reservation $reservation, string $reason): array
    {
        if ($reservation->status === 'cancelled') {
            return ['ok' => false, 'reason' => 'already_cancelled'];
        }

        $due = $this->refundDue($reservation);

        return DB::transaction(function () use ($reservation, $reason, $due) {
            $reservation->update([
                'status'        => 'cancelled',
                'cancelled_at'  => now(),
                'cancel_reason' => $reason,
            ]);

            /* Give the discount code back. Without this a cancelled reservation
               burns a use of a limited code forever. */
            if ($reservation->promo) {
                app(PromoService::class)->release($reservation->promo);
            }

            return ['ok' => true, 'refund_due' => $due];
        });
    }
}
