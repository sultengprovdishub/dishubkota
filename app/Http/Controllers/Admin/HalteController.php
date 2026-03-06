<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halte;
use App\Models\Koridor;
use Illuminate\Http\Request;

class HalteController extends Controller
{
    public function index()
    {
        $koridor = Koridor::with(['halte' => fn($q) => $q->orderBy('urutan')])->orderBy('urutan')->get();
        return view('admin.halte.index', compact('koridor'));
    }

    public function create(Request $request)
    {
        $koridor_list = Koridor::orderBy('urutan')->get();
        $selected_koridor = $request->koridor_id ? Koridor::find($request->koridor_id) : $koridor_list->first();
        return view('admin.halte.create', compact('koridor_list', 'selected_koridor'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'koridor_id' => 'required|exists:koridor,id',
            'nama' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tipe' => 'required|in:halte,terminal,hub',
            'urutan' => 'required|integer|min:0',
        ]);

        Halte::create($data);

        return redirect()->route('admin.halte.index')
            ->with('success', 'Halte berhasil ditambahkan.');
    }

    public function edit(Halte $halte)
    {
        $koridor_list = Koridor::orderBy('urutan')->get();
        return view('admin.halte.edit', compact('halte', 'koridor_list'));
    }

    public function update(Request $request, Halte $halte)
    {
        $data = $request->validate([
            'koridor_id' => 'required|exists:koridor,id',
            'nama' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tipe' => 'required|in:halte,terminal,hub',
            'urutan' => 'required|integer|min:0',
        ]);

        $halte->update($data);

        return redirect()->route('admin.halte.index')
            ->with('success', 'Halte berhasil diperbarui.');
    }

    public function destroy(Halte $halte)
    {
        $halte->delete();
        return redirect()->route('admin.halte.index')
            ->with('success', 'Halte berhasil dihapus.');
    }
}
