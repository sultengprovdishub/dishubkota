<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Koridor;
use Illuminate\Http\Request;

class KoridorController extends Controller
{
    public function index()
    {
        $koridor = Koridor::withCount('halte')->orderBy('urutan')->get();
        return view('admin.koridor.index', compact('koridor'));
    }

    public function create()
    {
        return view('admin.koridor.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
            'warna' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
            'aktif' => 'boolean',
            'urutan' => 'required|integer|min:0',
        ]);

        $data['aktif'] = $request->has('aktif');

        Koridor::create($data);

        return redirect()->route('admin.koridor.index')
            ->with('success', 'Koridor berhasil ditambahkan.');
    }

    public function edit(Koridor $koridor)
    {
        return view('admin.koridor.edit', compact('koridor'));
    }

    public function update(Request $request, Koridor $koridor)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
            'warna' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
            'aktif' => 'boolean',
            'urutan' => 'required|integer|min:0',
        ]);

        $data['aktif'] = $request->has('aktif');

        $koridor->update($data);

        return redirect()->route('admin.koridor.index')
            ->with('success', 'Koridor berhasil diperbarui.');
    }

    public function destroy(Koridor $koridor)
    {
        $koridor->delete();
        return redirect()->route('admin.koridor.index')
            ->with('success', 'Koridor berhasil dihapus.');
    }
}
