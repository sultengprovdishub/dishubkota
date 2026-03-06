<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';

    protected $fillable = ['judul', 'subjudul', 'gambar', 'url_tombol', 'teks_tombol', 'urutan', 'aktif'];

    protected $casts = ['aktif' => 'boolean'];
}
