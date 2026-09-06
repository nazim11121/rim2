<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RateTier extends Model
{
    protected $guarded = [];

    protected $casts = [
        'from_guests'  => 'integer',
        'weekday_rate' => 'integer',
        'weekend_rate' => 'integer',
    ];

    public function stay(): BelongsTo
    {
        return $this->belongsTo(Stay::class);
    }
}
