<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('aktif', true)->orderBy('urutan')->get();
        $layanan = Layanan::where('aktif', true)->orderBy('urutan')->take(6)->get();
        $berita = Berita::publish()->latest('published_at')->take(3)->get();
        $galeri = Galeri::orderBy('urutan')->take(6)->get();
        $pengumuman = Pengumuman::aktif()->latest('tanggal_terbit')->take(3)->get();

        $stats = [
            'berita' => Berita::publish()->count(),
            'layanan' => Layanan::where('aktif', true)->count(),
            'galeri' => Galeri::count(),
            'pengumuman' => Pengumuman::aktif()->count(),
        ];

        return view('home', compact('sliders', 'layanan', 'berita', 'galeri', 'pengumuman', 'stats'));
    }
}
