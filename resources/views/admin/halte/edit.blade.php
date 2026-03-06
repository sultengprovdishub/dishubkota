@extends('layouts.admin')
@section('title', 'Edit Halte')
@section('page-title', 'Edit Halte')
@section('page-subtitle', 'Ubah data halte dan koordinat lokasinya')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Utama --}}
        <div class="lg:col-span-2">
            <form action="{{ route('admin.halte.update', $halte) }}" method="POST">
                @csrf @method('PUT')

                <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3"
                        style="background:linear-gradient(135deg,#0f766e,#0d9488);">
                        <div
                            style="width:40px;height:40px;background:rgba(255,255,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bx bx-map-pin text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-white font-bold text-sm">Edit Halte</div>
                            <div class="text-teal-200 text-xs">{{ $halte->nama }} — {{ $halte->koridor->nama ?? '-' }}</div>
                        </div>
                        <span
                            class="text-xs px-3 py-1.5 rounded-full font-bold
                                     {{ $halte->tipe === 'Terminal' ? 'bg-blue-400/30 text-blue-100' : ($halte->tipe === 'Hub' ? 'bg-amber-400/30 text-amber-100' : 'bg-white/20 text-white') }}">
                            {{ $halte->tipe }}
                        </span>
                    </div>

                    <div class="p-6">
                        @include('admin.halte._form')
                    </div>
                </div>

                <div class="flex gap-3 mt-4">
                    <button type="submit" class="btn-primary flex-1 justify-center py-3">
                        <i class="bx bx-save mr-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.halte.index') }}" class="btn-secondary px-6 py-3">
                        <i class="bx bx-x mr-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>

        {{-- Sidebar Info --}}
        <div class="space-y-4">
            {{-- Info Halte Saat Ini --}}
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                        <i class="bx bx-map-pin text-teal-600"></i> Info Halte
                    </h3>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">Koridor</span>
                        @if($halte->koridor)
                            <span class="text-xs font-bold px-2 py-1 rounded-full text-white"
                                style="background:{{ $halte->koridor->warna ?? '#3b82f6' }}">
                                {{ $halte->koridor->kode }}
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">Urutan</span>
                        <span class="text-xs font-bold text-gray-900">#{{ $halte->urutan }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">Koordinat</span>
                        <span class="text-xs font-mono text-gray-600">
                            {{ $halte->latitude ? round($halte->latitude, 4) . ', ' . round($halte->longitude, 4) : 'Belum diset' }}
                        </span>
                    </div>
                    @if($halte->latitude)
                        <div style="background:#f0fdf4;border-radius:12px;padding:10px;text-align:center;" class="mt-2">
                            <a href="https://maps.google.com/?q={{ $halte->latitude }},{{ $halte->longitude }}" target="_blank"
                                class="text-xs text-teal-700 font-semibold flex items-center justify-center gap-1">
                                <i class="bx bx-map-alt"></i> Buka di Google Maps
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div style="background:#fefce8;border-radius:16px;padding:16px;border:1px solid #fde68a;">
                <div class="text-xs font-bold text-yellow-800 mb-2 flex items-center gap-2">
                    <i class="bx bx-info-circle text-lg"></i> Tips
                </div>
                <p class="text-xs text-yellow-700">
                    Klik pada peta atau geser marker untuk mengubah koordinat lokasi halte secara presisi.
                </p>
            </div>
        </div>
    </div>
@endsection