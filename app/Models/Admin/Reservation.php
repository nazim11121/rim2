<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/* A website booking request for a STAY. Deliberately not named "Booking": RMS
   already has an unrelated front-desk concept implied by CheckIn/Checkout, so
   "Reservation" keeps the two domains unambiguous for whoever maintains this
   next. */
class Reservation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'check_in'         => 'date',
        'check_out'        => 'date',
        'nights'           => 'integer',
        'guests'           => 'integer',
        'nightly_rate'     => 'integer',
        'gross'            => 'integer',
        'weekday_discount' => 'integer',
        'promo_discount'   => 'integer',
        'net'              => 'integer',
        'vat'              => 'integer',
        'total'            => 'integer',
        'amount_paid'      => 'integer',
        'confirmed_at'     => 'datetime',
        'cancelled_at'     => 'datetime',
    ];

    public function stay(): BelongsTo  { return $this->belongsTo(Stay::class); }
    public function promo(): BelongsTo { return $this->belongsTo(Promo::class); }

    /* Short, unambiguous on the phone, and unguessable enough that a reference
       cannot be walked. No I, O, 0 or 1: they are misread aloud. */
    public static function makeReference(): string
    {
        do {
            $ref = 'BON-' . strtoupper(Str::padLeft(
                substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 6), 6, 'X'
            ));
        } while (static::where('reference', $ref)->exists());

        return $ref;
    }

    /* An overlap query, not an equality query. Two stays overlap when one starts
       before the other ends. Note the strict inequalities: a checkout on the
       15th and a checkin on the 15th do NOT overlap, because the room is cleaned
       between 11am and 1pm. That single detail is worth a room-night per turn. */
    public function scopeOverlapping($q, $checkIn, $checkOut)
    {
        return $q->where('check_in', '<', $checkOut)
                 ->where('check_out', '>', $checkIn);
    }

    public function scopeBlocking($q)
    {
        return $q->whereIn('status', ['pending', 'confirmed', 'completed']);
    }

    public function balanceDue(): int
    {
        return max(0, $this->total - $this->amount_paid);
    }
}
