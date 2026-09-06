<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stay extends Model
{
    protected $guarded = [];

    protected $casts = [
        'min_guests'      => 'integer',
        'max_guests'      => 'integer',
        'whole_unit_only' => 'boolean',
        'is_published'    => 'boolean',
    ];

    public function rateTiers(): HasMany
    {
        return $this->hasMany(RateTier::class)->orderByDesc('from_guests');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /* The Pod's weekday reduction is already inside its stored tier figures, so
       the flat 15% must NOT be applied on top. This flag is what tells the quote
       service that. */
    public function discountBakedIn(): bool
    {
        return $this->pricing_mode === 'per_person_group';
    }

    public function scopePublished($q)
    {
        return $q->where('is_published', true)->orderBy('sort_order');
    }
}
