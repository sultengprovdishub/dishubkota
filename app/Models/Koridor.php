<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Koridor extends Model
{
    protected $table = 'koridor';

    protected $fillable = [
        'kode',
        'nama',
        'warna',
        'deskripsi',
        'aktif',
        'urutan',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function halte(): HasMany
    {
        return $this->hasMany(Halte::class)->orderBy('urutan');
    }
}
