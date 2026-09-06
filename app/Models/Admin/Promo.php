<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $guarded = [];

    protected $casts = [
        'value'      => 'decimal:4',
        'starts_on'  => 'date',
        'ends_on'    => 'date',
        'stay_slugs' => 'array',
        'is_active'  => 'boolean',
    ];

    public function scopeCode($q, string $code)
    {
        return $q->where('code', strtoupper(trim($code)));
    }

    public function exhausted(): bool
    {
        return $this->max_uses !== null && $this->used_count >= $this->max_uses;
    }
}
