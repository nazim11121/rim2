<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Dining extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
