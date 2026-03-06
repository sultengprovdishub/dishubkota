<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';
    protected $fillable = ['key', 'value', 'label'];

    /**
     * Ambil nilai pengaturan berdasarkan key, dengan fallback default.
     */
    public static function get(string $key, $default = null)
    {
        $row = static::where('key', $key)->first();
        return $row ? $row->value : $default;
    }

    /**
     * Set / upsert nilai pengaturan.
     */
    public static function set(string $key, $value, string $label = ''): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'label' => $label]
        );
    }
}
