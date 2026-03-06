@extends('layouts.admin')
@section('title', 'Edit Foto Galeri')
@section('page-title', 'Edit Foto Galeri')
@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Foto <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" required
                            class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto</label>
                        <img src="{{ asset('storage/' . $galeri->foto) }}"
                            class="w-40 h-32 object-cover rounded-xl mb-3 border border-gray-200">
                        <input type="file" name="foto" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="input-field resize-none">{{ old('keterangan', $galeri->keterangan) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="urutan" value="{{ old('urutan', $galeri->urutan) }}" class="input-field">
                    </div>
                </div>
                <div class="flex gap-3 pt-5 border-t border-gray-100 mt-5">
                    <button type="submit" class="btn-primary"><i class="bx bx-save"></i> Simpan</button>
                    <a href="{{ route('admin.galeri.index') }}" class="btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection