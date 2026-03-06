<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::orderBy('urutan')->paginate(10);
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'ikon' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'url' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'aktif' => 'boolean',
        ]);
        $data['aktif'] = $request->boolean('aktif');
        Layanan::create($data);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'ikon' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'url' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
            'aktif' => 'boolean',
        ]);
        $data['aktif'] = $request->boolean('aktif');
        $layanan->update($data);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
