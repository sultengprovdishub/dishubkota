@extends('layouts.admin')
@section('title', 'Upload Dokumen')
@section('page-title', 'Upload Dokumen')
@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Dokumen <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required class="input-field"
                            placeholder="Nama dokumen">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">File <span
                                class="text-red-500">*</span></label>
                        <input type="file" name="file" required
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p class="text-xs text-gray-400 mt-1">Maks 10MB. Format: PDF, DOC, DOCX, XLS, XLSX dll.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kategori" value="{{ old('kategori', 'Umum') }}" required
                            class="input-field" list="kat-list">
                        <datalist id="kat-list">
                            <option value="Umum">
                            <option value="Formulir">
                            <option value="Peraturan">
                            <option value="Laporan">
                            <option value="SK">
                        </datalist>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="input-field resize-none"
                            placeholder="Keterangan singkat">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
                <div class="flex gap-3 pt-5 border-t mt-5">
                    <button type="submit" class="btn-primary"><i class="bx bx-upload"></i> Upload</button>
                    <a href="{{ route('admin.dokumen.index') }}" class="btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection