@extends('layouts.admin')
@section('title', 'Edit Koridor')
@section('page-title', 'Edit Koridor')
@section('page-subtitle', 'Perbarui data jalur koridor')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Utama --}}
        <div class="lg:col-span-2">
            <form action="{{ route('admin.koridor.update', $koridor) }}" method="POST" id="koridor-form">
                @csrf @method('PUT')

                <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                    {{-- Header Card --}}
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3"
                        style="background:linear-gradient(135deg,#1e3a8a,#2563eb);">
                        <div
                            style="width:40px;height:40px;background:rgba(255,255,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bx bx-route text-white text-xl"></i>
                        </div>
                        <div>
                            <div class="text-white font-bold text-sm">Edit Koridor</div>
                            <div class="text-blue-200 text-xs">{{ $koridor->kode }} — {{ $koridor->nama }}</div>
                        </div>
                        <div class="ml-auto">
                            <span
                                class="text-xs font-bold px-3 py-1.5 rounded-full
                                         {{ $koridor->aktif ? 'bg-green-400/30 text-green-100' : 'bg-gray-400/30 text-gray-200' }}">
                                {{ $koridor->aktif ? '● Aktif' : '● Nonaktif' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        @include('admin.koridor._form')
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3 mt-4">
                    <button type="submit" class="btn-primary flex-1 justify-center py-3">
                        <i class="bx bx-save mr-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.koridor.index') }}" class="btn-secondary px-6 py-3">
                        <i class="bx bx-x mr-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>

        {{-- Preview Panel --}}
        <div class="space-y-4">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                        <i class="bx bx-show text-primary-600"></i> Preview
                    </h3>
                </div>
                <div class="p-5 space-y-4">
                    <div class="flex items-center gap-3">
                        <div id="prev-color-dot"
                            style="width:44px;height:44px;border-radius:12px;background:{{ $koridor->warna }};flex-shrink:0;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px {{ $koridor->warna }}40;">
                            <i class="bx bx-route text-white text-xl"></i>
                        </div>
                        <div>
                            <div id="prev-kode" class="font-extrabold text-gray-900 text-lg">{{ $koridor->kode }}</div>
                            <div id="prev-nama" class="text-xs text-gray-500 leading-tight">{{ $koridor->nama }}</div>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-medium mb-2">Warna Jalur Peta</div>
                        <div id="prev-line"
                            style="height:8px;border-radius:99px;background:{{ $koridor->warna }};box-shadow:0 2px 8px {{ $koridor->warna }}40;transition:all .3s;">
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Status</span>
                        <span id="prev-status" class="text-xs font-bold px-3 py-1 rounded-full
                                     {{ $koridor->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $koridor->aktif ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <div class="text-xs text-gray-400 font-medium mt-2">Total Halte</div>
                    <div class="text-2xl font-extrabold text-primary-700">{{ $koridor->halte->count() }}
                        <span class="text-sm font-medium text-gray-400">titik</span>
                    </div>
                    <div id="prev-desc-wrap" class="{{ $koridor->deskripsi ? '' : 'hidden' }}">
                        <div class="text-xs text-gray-400 font-medium mb-1">Deskripsi</div>
                        <div id="prev-desc" class="text-xs text-gray-600 bg-gray-50 rounded-xl p-3 leading-relaxed">
                            {{ $koridor->deskripsi }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-amber-50 rounded-2xl p-5 border border-amber-100">
                <div class="text-xs font-bold text-amber-800 mb-2 flex items-center gap-2">
                    <i class="bx bx-info-circle text-lg"></i> Info
                </div>
                <ul class="text-xs text-amber-700 space-y-1.5 list-disc pl-4">
                    <li>Perubahan warna akan langsung mempengaruhi tampilan peta di halaman publik.</li>
                    <li>Halte yang terhubung tidak akan terpengaruh.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kodeInput = document.querySelector('input[name="kode"]');
            const namaInput = document.querySelector('input[name="nama"]');
            const hexInput = document.getElementById('warna-hex');
            const aktifCheck = document.getElementById('aktif');
            const descInput = document.querySelector('textarea[name="deskripsi"]');

            function updatePreview() {
                const warna = hexInput?.value || '#3b82f6';
                document.getElementById('prev-kode').textContent = kodeInput?.value || 'K--';
                document.getElementById('prev-nama').textContent = namaInput?.value || 'Nama Koridor';
                document.getElementById('prev-color-dot').style.background = warna;
                document.getElementById('prev-color-dot').style.boxShadow = '0 4px 12px ' + warna + '40';
                document.getElementById('prev-line').style.background = warna;
                document.getElementById('prev-line').style.boxShadow = '0 2px 8px ' + warna + '40';
                const aktif = aktifCheck?.checked;
                const st = document.getElementById('prev-status');
                st.textContent = aktif ? 'Aktif' : 'Nonaktif';
                st.className = 'text-xs font-bold px-3 py-1 rounded-full ' +
                    (aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500');
                const desc = descInput?.value?.trim();
                document.getElementById('prev-desc-wrap').classList.toggle('hidden', !desc);
                document.getElementById('prev-desc').textContent = desc || '';
            }
            [kodeInput, namaInput, hexInput, descInput].forEach(el => el?.addEventListener('input', updatePreview));
            aktifCheck?.addEventListener('change', updatePreview);
            updatePreview();
        });
    </script>
@endpush