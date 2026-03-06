<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function updateTarif(Request $request)
    {
        $request->validate([
            'tarif_gratis' => 'nullable|boolean',
            'tarif_harga' => 'nullable|integer|min:0',
            'tarif_keterangan' => 'nullable|string|max:200',
        ]);

        $gratis = $request->boolean('tarif_gratis');
        Pengaturan::set('tarif_gratis', $gratis ? '1' : '0', 'Status Tarif Gratis');
        Pengaturan::set('tarif_harga', $request->input('tarif_harga', 0), 'Harga Tarif');
        Pengaturan::set('tarif_keterangan', $request->input('tarif_keterangan', ''), 'Keterangan Tarif');

        return back()->with('success', 'Pengaturan tarif berhasil diperbarui!');
    }
}
