<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function profil()
    {
        return view('halaman.profil');
    }

    public function layanan()
    {
        $layanan = Layanan::where('aktif', true)->orderBy('urutan')->get();
        return view('halaman.layanan', compact('layanan'));
    }

    public function galeri()
    {
        $galeri = Galeri::orderBy('urutan')->paginate(12);
        return view('halaman.galeri', compact('galeri'));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::aktif()->latest('tanggal_terbit')->paginate(10);
        return view('halaman.pengumuman', compact('pengumuman'));
    }

    public function dokumen(Request $request)
    {
        $query = Dokumen::latest();
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }
        $dokumen = $query->paginate(10);
        $kategori = Dokumen::distinct()->pluck('kategori');
        return view('halaman.dokumen', compact('dokumen', 'kategori'));
    }

    public function trayek()
    {
        $koridor = \App\Models\Koridor::with(['halte' => fn($q) => $q->orderBy('urutan')])
            ->where('aktif', true)
            ->orderBy('urutan')
            ->get();

        $spesifikasi = \App\Models\SpesifikasiBus::orderBy('urutan')->get();

        return view('halaman.trayek', compact('koridor', 'spesifikasi'));
    }

    public function kontak()
    {
        return view('halaman.kontak');
    }

    public function unduhDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->increment('unduhan');
        return response()->download(storage_path('app/public/' . $dokumen->file));
    }
}
