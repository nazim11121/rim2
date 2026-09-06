<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseKeeping extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_no', 'id');
    }

    public function amenities()
    {
        return $this->belongsTo(Amenities::class, 'amenities_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
