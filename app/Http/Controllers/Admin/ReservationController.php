<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Reservation;
use App\Services\CancellationService;
use Illuminate\Http\Request;

/* Read/manage only — reservations come from the public booking API
   (App\Http\Controllers\Api\ReservationController), never created here. Staff
   act on a reservation via the Confirm / Cancel buttons on the show page, not
   by editing raw fields. */
class ReservationController extends Controller
{
    public function index()
    {
        $allData = Reservation::with('stay')->latest()->get();

        return view('admin.reservations.index', compact('allData'));
    }

    public function show($id)
    {
        $data = Reservation::with(['stay', 'promo'])->findOrFail($id);

        return view('admin.reservations.show', compact('data'));
    }

    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status'       => 'confirmed',
            'confirmed_at' => now(),
        ]);

        return redirect()->route('admin.reservations.show', $id)->with('success', 'Reservation confirmed.');
    }

    public function cancel(Request $request, $id)
    {
        $request->validate([
            'cancel_reason' => 'required|string|max:500',
        ]);

        $reservation = Reservation::findOrFail($id);
        $result = app(CancellationService::class)->cancel($reservation, $request->input('cancel_reason'));

        if ($result['ok'] ?? false) {
            $due = $result['refund_due'] ?? 0;
            $message = $due > 0
                ? "Reservation cancelled. Refund due (per policy, staff to action manually): ৳{$due}."
                : 'Reservation cancelled.';

            return redirect()->route('admin.reservations.show', $id)->with('success', $message);
        }

        return redirect()->route('admin.reservations.show', $id)->with('error', 'Reservation was already cancelled.');
    }
}
