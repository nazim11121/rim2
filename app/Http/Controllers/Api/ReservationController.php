<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PricingException;
use App\Http\Controllers\Controller;
use App\Mail\ReservationReceivedGuest;
use App\Mail\ReservationReceivedOffice;
use App\Models\Admin\Reservation;
use App\Models\Admin\Stay;
use App\Services\AvailabilityService;
use App\Services\PromoService;
use App\Services\QuoteService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function __construct(
        private QuoteService $quotes,
        private AvailabilityService $availability,
        private PromoService $promos,
    ) {}

    /* POST /api/reservations
       The guest-facing "book" step. Never trusts the numbers the browser sent:
       the quote and the availability check are both re-run here, server side,
       exactly as they were for the last GET /api/quote the widget made. */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'stay'        => ['required', 'string', 'exists:stays,slug'],
            'check_in'    => ['required', 'date'],
            'nights'      => ['required', 'integer', 'min:1', 'max:30'],
            'guests'      => ['required', 'integer', 'min:1', 'max:20'],
            'guest_name'  => ['required', 'string', 'max:191'],
            'guest_phone' => ['required', 'string', 'max:40'],
            'guest_email' => ['nullable', 'email', 'max:191'],
            'guest_note'  => ['nullable', 'string'],
            'promo'       => ['nullable', 'string', 'max:40'],
        ]);

        $stay     = Stay::where('slug', $data['stay'])->firstOrFail();
        $checkIn  = Carbon::parse($data['check_in'])->startOfDay();
        $checkOut = $checkIn->copy()->addDays((int) $data['nights']);
        $guests   = (int) $data['guests'];

        $problems = $this->availability->problems($stay, $guests, $checkIn, $checkOut);
        if ($problems !== []) {
            return response()->json(['ok' => false, 'problems' => $problems], 422);
        }

        try {
            $quote = $this->quotes->for($stay, $guests, $checkIn, $checkOut, $data['promo'] ?? null);
        } catch (PricingException $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 422);
        }

        $reservation = DB::transaction(function () use ($stay, $checkIn, $checkOut, $guests, $data, $quote) {
            $promo = filled($quote['promo_code'])
                ? $this->promos->validate($data['promo'] ?? null, $stay, (int) $data['nights'], $checkIn, $data['guest_email'] ?? null)
                : null;

            $reservation = Reservation::create([
                'reference'        => Reservation::makeReference(),
                'stay_id'          => $stay->id,
                'check_in'         => $checkIn->toDateString(),
                'check_out'        => $checkOut->toDateString(),
                'nights'           => $quote['nights'],
                'guests'           => $guests,
                'guest_name'       => $data['guest_name'],
                'guest_phone'      => $data['guest_phone'],
                'guest_email'      => $data['guest_email'] ?? null,
                'guest_note'       => $data['guest_note'] ?? null,
                'promo_id'         => $promo?->id,
                'promo_code'       => $promo?->code,
                'nightly_rate'     => $quote['nightly'],
                'gross'            => $quote['gross'],
                'weekday_discount' => $quote['weekday_discount'],
                'promo_discount'   => $quote['promo_discount'],
                'net'              => $quote['net'],
                'vat'              => $quote['vat'],
                'total'            => $quote['total'],
                'amount_paid'      => 0,
                'status'           => 'pending',
                'payment_status'   => 'unpaid',
                'source'           => 'website',
            ]);

            // Consumed once, on actual creation — never at quote time.
            if ($promo) {
                $this->promos->consume($promo);
            }

            return $reservation;
        });

        $reservation->load('stay');

        // Guest email is optional on the form — only mail them if they gave one.
        if ($reservation->guest_email) {
            Mail::to($reservation->guest_email)->send(new ReservationReceivedGuest($reservation));
        }

        Mail::to('bonomalimangroveresort@gmail.com')->send(new ReservationReceivedOffice($reservation));

        return response()->json([
            'ok'          => true,
            'reference'   => $reservation->reference,
            'reservation' => $reservation,
        ], 201);
    }
}
