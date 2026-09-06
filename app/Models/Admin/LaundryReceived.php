<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaundryReceived extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function laundry()
    {
        return $this->belongsTo(Laundry::class, 'laundry_id', 'id');
    }
}
