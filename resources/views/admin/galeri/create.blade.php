@extends('layouts.admin')
@section('title', 'Upload Foto Galeri')
@section('page-title', 'Upload Foto Galeri')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Foto <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required class="input-field"
                            placeholder="Judul foto">
                        @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto <span
                                class="text-red-500">*</span></label>
                        <input type="file" name="foto" required accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="input-field resize-none"
                            placeholder="Keterangan foto (opsional)">{{ old('keterangan') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="urutan" value="{{ old('urutan', 0) }}" class="input-field">
                    </div>
                </div>
                <div class="flex gap-3 pt-5 border-t border-gray-100 mt-5">
                    <button type="submit" class="btn-primary"><i class="bx bx-upload"></i> Upload</button>
                    <a href="{{ route('admin.galeri.index') }}" class="btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection