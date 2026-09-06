<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalPost extends Model
{
    use SoftDeletes;

    protected $table = 'journal_posts';

    protected $guarded = [];
}
