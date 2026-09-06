<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $guarded = [];
    protected $casts = ['value' => 'array'];

    /* Cached forever and flushed on write. Every quote reads four settings, so
       without the cache a busy availability calendar hammers this table. */
    public static function get(string $key, $default = null)
    {
        $all = Cache::rememberForever('bonomali.settings', function () {
            return static::pluck('value', 'key')->all();
        });

        return $all[$key] ?? $default;
    }

    public static function put(string $key, $value, ?string $note = null): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value, 'note' => $note]);
        Cache::forget('bonomali.settings');
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('bonomali.settings'));
        static::deleted(fn () => Cache::forget('bonomali.settings'));
    }
}
