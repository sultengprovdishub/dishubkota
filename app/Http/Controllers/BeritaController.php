<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::publish()->latest('published_at');

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->cari) {
            $query->where('judul', 'like', '%' . $request->cari . '%');
        }

        $berita = $query->paginate(9);
        $kategori = Berita::publish()->distinct()->pluck('kategori');

        return view('berita.index', compact('berita', 'kategori'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->where('status', 'publish')->firstOrFail();
        $lainnya = Berita::publish()->where('id', '!=', $berita->id)->latest('published_at')->take(3)->get();

        // Increment views sekali per sesi per artikel
        $sessionKey = 'berita_viewed_' . $berita->id;
        if (!session()->has($sessionKey)) {
            $berita->incrementViews();
            session()->put($sessionKey, true);
        }

        return view('berita.show', compact('berita', 'lainnya'));
    }
}
