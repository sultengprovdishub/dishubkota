@extends('layouts.admin')
@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita Baru')
@section('page-subtitle', 'Buat konten berita baru')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.berita._form')
                <div class="flex gap-3 pt-4 border-t border-gray-100 mt-6">
                    <button type="submit" name="status" value="publish" class="btn-primary">
                        <i class="bx bx-check-circle"></i> Publish
                    </button>
                    <button type="submit" name="status" value="draft" class="btn-outline">
                        <i class="bx bx-save"></i> Simpan Draft
                    </button>
                    <a href="{{ route('admin.berita.index') }}"
                        class="px-5 py-3 text-gray-500 hover:text-gray-700 font-medium">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection