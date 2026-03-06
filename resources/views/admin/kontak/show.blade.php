@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan Masuk')
@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Nama</div>
                    <div class="font-semibold text-gray-900">{{ $kontak->nama }}</div>
                </div>
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Email</div>
                    <a href="mailto:{{ $kontak->email }}" class="text-primary-700 hover:underline">{{ $kontak->email }}</a>
                </div>
                @if($kontak->telepon)
                    <div>
                        <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Telepon</div>
                        <div class="text-gray-900">{{ $kontak->telepon }}</div>
                    </div>
                @endif
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Diterima</div>
                    <div class="text-gray-900">{{ optional($kontak->created_at)->format('d M Y, H:i') }} WITA</div>
                </div>
            </div>
            <div class="mb-6">
                <div class="text-xs font-semibold text-gray-400 uppercase mb-2">Subjek</div>
                <div class="font-bold text-gray-900 text-lg">{{ $kontak->subjek }}</div>
            </div>
            <div class="mb-6">
                <div class="text-xs font-semibold text-gray-400 uppercase mb-2">Isi Pesan</div>
                <div class="bg-gray-50 rounded-xl p-5 text-gray-700 leading-relaxed">
                    {!! nl2br(e($kontak->pesan)) !!}
                </div>
            </div>
            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <a href="mailto:{{ $kontak->email }}?subject=Re: {{ $kontak->subjek }}" class="btn-primary">
                    <i class="bx bx-reply"></i> Balas via Email
                </a>
                <a href="{{ route('admin.kontak.index') }}" class="btn-outline">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
                <form action="{{ route('admin.kontak.destroy', $kontak) }}" method="POST" class="ml-auto"
                    onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf @method('DELETE')
                    <button class="px-4 py-3 text-red-500 hover:text-red-700 font-medium text-sm">
                        <i class="bx bx-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection