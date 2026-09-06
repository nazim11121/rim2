<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'type', 'id');
    }
}
