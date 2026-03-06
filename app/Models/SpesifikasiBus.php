<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpesifikasiBus extends Model
{
    protected $table = 'spesifikasi_bus';

    protected $fillable = [
        'kunci',
        'label',
        'nilai',
        'ikon',
        'warna',
        'warna_bg',
        'urutan',
    ];
}
