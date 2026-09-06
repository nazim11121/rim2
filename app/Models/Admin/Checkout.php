<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function checkIn()
    {
        return $this->belongsTo(CheckIn::class, 'id', 'checkout_id');
    }
}
