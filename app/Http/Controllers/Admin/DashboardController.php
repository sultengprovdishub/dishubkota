<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\Layanan;
use App\Models\Dokumen;
use App\Models\KontakPesan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'berita' => Berita::count(),
            'galeri' => Galeri::count(),
            'pengumuman' => Pengumuman::count(),
            'layanan' => Layanan::count(),
            'dokumen' => Dokumen::count(),
            'pesan_baru' => KontakPesan::where('dibaca', false)->count(),
            'pesan_total' => KontakPesan::count(),
            'koridor' => \App\Models\Koridor::where('aktif', true)->count(),
            'halte' => \App\Models\Halte::count(),
        ];

        $berita_terbaru = Berita::latest()->take(5)->get();
        $pesan_terbaru = KontakPesan::latest()->take(5)->get();

        // Data aktivitas 7 hari terakhir untuk chart
        $aktivitas = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl = now()->subDays($i);
            $aktivitas[] = [
                'label' => $tgl->format('d M'),
                'berita' => Berita::whereDate('created_at', $tgl)->count(),
                'pesan' => KontakPesan::whereDate('created_at', $tgl)->count(),
            ];
        }

        return view('admin.dashboard', compact('stats', 'berita_terbaru', 'pesan_terbaru', 'aktivitas'));
    }
}

