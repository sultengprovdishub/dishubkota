<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpesifikasiBus;
use Illuminate\Http\Request;

class SpesifikasiBusController extends Controller
{
    public function index()
    {
        $spesifikasi = SpesifikasiBus::orderBy('urutan')->get();
        return view('admin.spesifikasi-bus.index', compact('spesifikasi'));
    }

    public function create()
    {
        return view('admin.spesifikasi-bus.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kunci' => 'required|string|max:50|unique:spesifikasi_bus,kunci',
            'label' => 'required|string|max:255',
            'nilai' => 'required|string|max:255',
            'ikon' => 'required|string|max:50',
            'warna' => 'required|string|max:20',
            'warna_bg' => 'required|string|max:40',
            'urutan' => 'required|integer|min:0',
        ]);

        SpesifikasiBus::create($data);

        return redirect()->route('admin.spesifikasi-bus.index')
            ->with('success', 'Spesifikasi berhasil ditambahkan.');
    }

    public function edit(SpesifikasiBus $spesifikasiBus)
    {
        return view('admin.spesifikasi-bus.edit', compact('spesifikasiBus'));
    }

    public function update(Request $request, SpesifikasiBus $spesifikasiBus)
    {
        $data = $request->validate([
            'kunci' => 'required|string|max:50|unique:spesifikasi_bus,kunci,' . $spesifikasiBus->id,
            'label' => 'required|string|max:255',
            'nilai' => 'required|string|max:255',
            'ikon' => 'required|string|max:50',
            'warna' => 'required|string|max:20',
            'warna_bg' => 'required|string|max:40',
            'urutan' => 'required|integer|min:0',
        ]);

        $spesifikasiBus->update($data);

        return redirect()->route('admin.spesifikasi-bus.index')
            ->with('success', 'Spesifikasi berhasil diperbarui.');
    }

    public function destroy(SpesifikasiBus $spesifikasiBus)
    {
        $spesifikasiBus->delete();
        return redirect()->route('admin.spesifikasi-bus.index')
            ->with('success', 'Spesifikasi berhasil dihapus.');
    }
}
