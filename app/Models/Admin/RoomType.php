<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'type', 'id');
    }
}
