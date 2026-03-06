@extends('layouts.admin')
@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('page-subtitle', $berita->judul)

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin.berita._form', ['berita' => $berita])
                <div class="flex gap-3 pt-4 border-t border-gray-100 mt-6">
                    <button type="submit" class="btn-primary">
                        <i class="bx bx-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.berita.index') }}" class="btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection