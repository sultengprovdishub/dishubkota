@extends('layouts.admin')
@section('title', 'Tambah Halte')
@section('page-title', 'Tambah Halte')
@section('page-subtitle', 'Tambah titik halte baru pada koridor')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Utama --}}
        <div class="lg:col-span-2">
            <form action="{{ route('admin.halte.store') }}" method="POST">
                @csrf

                <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                    {{-- Header Card --}}
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3"
                        style="background:linear-gradient(135deg,#0f766e,#0d9488);">
                        <div
                            style="width:40px;height:40px;background:rgba(255,255,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bx bx-map-pin text-white text-xl"></i>
                        </div>
                        <div>
                            <div class="text-white font-bold text-sm">Data Halte</div>
                            <div class="text-teal-200 text-xs">Isi informasi titik perhentian bus</div>
                        </div>
                    </div>

                    <div class="p-6">
                        @include('admin.halte._form')
                    </div>
                </div>

                <div class="flex gap-3 mt-4">
                    <button type="submit" class="btn-primary flex-1 justify-center py-3">
                        <i class="bx bx-save mr-1"></i> Simpan Halte
                    </button>
                    <a href="{{ route('admin.halte.index') }}" class="btn-secondary px-6 py-3">
                        <i class="bx bx-x mr-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>

        {{-- Sidebar Info --}}
        <div class="space-y-4">
            {{-- Preview Card --}}
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                        <i class="bx bx-info-circle text-teal-600"></i> Panduan Koordinat
                    </h3>
                </div>
                <div class="p-5 space-y-3">
                    <div style="background:#f0fdf4;border-radius:14px;padding:14px;">
                        <div class="text-xs font-bold text-teal-800 mb-2">🗺️ Klik Peta untuk Koordinat</div>
                        <p class="text-xs text-teal-700 leading-relaxed">
                            Klik atau geser marker pada peta di bawah untuk menentukan lokasi halte secara presisi.
                            Latitude dan Longitude akan otomatis terisi.
                        </p>
                    </div>
                    <div style="background:#eff6ff;border-radius:14px;padding:14px;">
                        <div class="text-xs font-bold text-blue-800 mb-2">📍 Tipe Halte</div>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li><strong>Terminal</strong> — Halte utama/terminal besar</li>
                            <li><strong>Hub</strong> — Titik transfer koridor</li>
                            <li><strong>Halte</strong> — Pemberhentian biasa</li>
                        </ul>
                    </div>
                    <div style="background:#fefce8;border-radius:14px;padding:14px;">
                        <div class="text-xs font-bold text-yellow-800 mb-2">⚠️ Tips</div>
                        <p class="text-xs text-yellow-700">
                            Urutan menentukan posisi halte di sepanjang rute koridor dari titik awal ke akhir.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection