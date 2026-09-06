<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PricingException;
use App\Http\Controllers\Controller;
use App\Models\Admin\Stay;
use App\Services\AvailabilityService;
use App\Services\PromoService;
use App\Services\QuoteService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function __construct(
        private QuoteService $quotes,
        private AvailabilityService $availability,
        private PromoService $promos,
    ) {}

    /* GET /api/quote?stay=golpata&check_in=2026-09-04&nights=2&guests=2&promo=MONSOON15

       The booking widget calls this on every change so the browser and the server
       can never disagree about a price. It is deliberately cheap: no writes, no
       promo consumption. */
    public function show(Request $request): JsonResponse
    {
        $data = $request->validate([
            'stay'     => ['required', 'string', 'exists:stays,slug'],
            'check_in' => ['required', 'date'],
            'nights'   => ['required', 'integer', 'min:1', 'max:30'],
            'guests'   => ['required', 'integer', 'min:1', 'max:20'],
            'promo'    => ['nullable', 'string', 'max:40'],
        ]);

        $stay     = Stay::where('slug', $data['stay'])->firstOrFail();
        $checkIn  = Carbon::parse($data['check_in'])->startOfDay();
        $checkOut = $checkIn->copy()->addDays((int) $data['nights']);

        try {
            $quote = $this->quotes->for($stay, (int) $data['guests'], $checkIn, $checkOut, $data['promo'] ?? null);
        } catch (PricingException $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 422);
        }

        $problems = $this->availability->problems($stay, (int) $data['guests'], $checkIn, $checkOut);

        /* If a code was sent but did not apply, say WHY. */
        $promoProblem = filled($data['promo'] ?? null) && ! $quote['promo_code']
            ? $this->promos->problem($data['promo'], $stay, (int) $data['nights'], $checkIn)
            : null;

        return response()->json([
            'ok'            => true,
            'quote'         => $quote,
            'available'     => $problems === [],
            'problems'      => $problems,
            'promo_problem' => $promoProblem,
            'check_in'      => $checkIn->toDateString(),
            'check_out'     => $checkOut->toDateString(),
        ]);
    }

    /* GET /api/availability?stay=golpata&from=2026-09-01&to=2026-10-31
       Dates a calendar should grey out. */
    public function availability(Request $request): JsonResponse
    {
        $data = $request->validate([
            'stay' => ['required', 'string', 'exists:stays,slug'],
            'from' => ['nullable', 'date'],
            'to'   => ['nullable', 'date'],
        ]);

        $stay = Stay::where('slug', $data['stay'])->firstOrFail();
        $from = isset($data['from']) ? Carbon::parse($data['from']) : now()->startOfDay();
        $to   = isset($data['to'])   ? Carbon::parse($data['to'])   : $from->copy()->addMonths(6);

        return response()->json([
            'ok'           => true,
            'stay'         => $stay->slug,
            'booked_dates' => $this->availability->bookedDates($stay, $from, $to),
            'check_in'     => '13:00',
            'check_out'    => '11:00',
        ]);
    }
}
