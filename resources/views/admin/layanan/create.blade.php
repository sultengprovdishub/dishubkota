@extends('layouts.admin')
@section('title', isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan')
@section('page-title', isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan')
@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow-card p-8">
        <form action="{{ isset($layanan) ? route('admin.layanan.update', $layanan) : route('admin.layanan.store') }}" method="POST">
            @csrf
            @if(isset($layanan)) @method('PUT') @endif
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $layanan->nama ?? '') }}" required class="input-field">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ikon Boxicons <span class="text-red-500">*</span></label>
                    <input type="text" name="ikon" value="{{ old('ikon', $layanan->ikon ?? 'bx bx-car') }}" required class="input-field" placeholder="contoh: bx bx-car">
                    <p class="text-xs text-gray-400 mt-1">Gunakan class dari <a href="https://boxicons.com" target="_blank" class="text-primary-600 hover:underline">boxicons.com</a></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="4" required class="input-field resize-none" placeholder="Deskripsi singkat layanan">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">URL (opsional)</label>
                        <input type="text" name="url" value="{{ old('url', $layanan->url ?? '') }}" class="input-field" placeholder="/layanan/izin">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="urutan" value="{{ old('urutan', $layanan->urutan ?? 0) }}" class="input-field">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="aktif" id="aktif" value="1" class="w-5 h-5 cursor-pointer rounded text-primary-600 focus:ring-primary-500"
                           {{ old('aktif', $layanan->aktif ?? true) ? 'checked' : '' }}>
                    <label for="aktif" class="text-sm font-semibold text-gray-700 cursor-pointer">Tampilkan di Website (Aktif)</label>
                </div>
            </div>
            <div class="flex gap-3 pt-5 border-t mt-5">
                <button type="submit" class="btn-primary"><i class="bx bx-save"></i> Simpan</button>
                <a href="{{ route('admin.layanan.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
