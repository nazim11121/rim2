<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];

    public function packageCategory()
    {
        return $this->belongsTo(PackageCategory::class, 'category_id', 'id');
    }
}
