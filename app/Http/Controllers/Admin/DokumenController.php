<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::latest()->paginate(10);
        return view('admin.dokumen.index', compact('dokumen'));
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|max:10240',
            'kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $data['file'] = $request->file('file')->store('dokumen', 'public');
        Dokumen::create($data);
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Dokumen $dokumen)
    {
        return view('admin.dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240',
            'kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('dokumen', 'public');
        }

        $dokumen->update($data);
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Dokumen $dokumen)
    {
        $dokumen->delete();
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
