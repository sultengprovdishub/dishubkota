@extends('layouts.admin')
@section('title', 'Tambah Pengumuman')
@section('page-title', 'Tambah Pengumuman')
@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.pengumuman._form')
                <div class="flex gap-3 pt-5 border-t mt-5">
                    <button type="submit" class="btn-primary"><i class="bx bx-check"></i> Simpan</button>
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection