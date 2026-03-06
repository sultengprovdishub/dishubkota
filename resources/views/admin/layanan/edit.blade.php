@extends('layouts.admin')
@section('title', 'Edit Layanan')
@section('page-title', 'Edit Layanan')
@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <form action="{{ route('admin.layanan.update', $layanan) }}" method="POST">
                @csrf @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Layanan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $layanan->nama) }}" required
                            class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ikon Boxicons <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="ikon" value="{{ old('ikon', $layanan->ikon) }}" required
                            class="input-field">
                        <p class="text-xs text-gray-400 mt-1">Lihat ikon di <a href="https://boxicons.com" target="_blank"
                                class="text-primary-600 hover:underline">boxicons.com</a></p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi <span
                                class="text-red-500">*</span></label>
                        <textarea name="deskripsi" rows="4" required
                            class="input-field resize-none">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">URL</label>
                            <input type="text" name="url" value="{{ old('url', $layanan->url) }}" class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                            <input type="number" name="urutan" value="{{ old('urutan', $layanan->urutan) }}"
                                class="input-field">
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="aktif" id="aktif" value="1"
                            class="w-5 h-5 cursor-pointer rounded text-primary-600" {{ old('aktif', $layanan->aktif) ? 'checked' : '' }}>
                        <label for="aktif" class="text-sm font-semibold text-gray-700 cursor-pointer">Tampilkan di
                            Website</label>
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