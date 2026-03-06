<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakPesan;

class KontakController extends Controller
{
    public function index()
    {
        $pesan = KontakPesan::latest()->paginate(15);
        // Tandai semua sebagai dibaca
        KontakPesan::where('dibaca', false)->update(['dibaca' => true]);
        return view('admin.kontak.index', compact('pesan'));
    }

    public function show(KontakPesan $kontak)
    {
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy(KontakPesan $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
