@extends('layouts.admin')
@section('title', 'Edit Dokumen')
@section('page-title', 'Edit Dokumen')
@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <form action="{{ route('admin.dokumen.update', $dokumen) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Dokumen <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $dokumen->judul) }}" required
                            class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">File Baru (opsional)</label>
                        <p class="text-xs text-gray-400 mb-2">File saat ini: <span
                                class="font-mono">{{ basename($dokumen->file) }}</span></p>
                        <input type="file" name="file"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:font-semibold file:bg-primary-50 file:text-primary-700">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kategori" value="{{ old('kategori', $dokumen->kategori) }}" required
                            class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="input-field resize-none">{{ old('keterangan', $dokumen->keterangan) }}</textarea>
                    </div>
                </div>
                <div class="flex gap-3 pt-5 border-t mt-5">
                    <button type="submit" class="btn-primary"><i class="bx bx-save"></i> Simpan</button>
                    <a href="{{ route('admin.dokumen.index') }}" class="btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection