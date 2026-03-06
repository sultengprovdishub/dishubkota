<?php

namespace App\Http\Controllers;

use App\Models\KontakPesan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function kirim(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'telepon' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:200',
            'pesan' => 'required|string',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'pesan.required' => 'Pesan wajib diisi.',
        ]);

        KontakPesan::create($request->only('nama', 'email', 'telepon', 'subjek', 'pesan'));

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda berhasil dikirim. Kami akan segera merespons.');
    }
}
