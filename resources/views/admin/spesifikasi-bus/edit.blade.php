@extends('layouts.admin')
@section('title', 'Edit Spesifikasi Bus')
@section('page-title', 'Edit Spesifikasi')
@section('page-subtitle', 'Ubah data spesifikasi bus')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Utama --}}
        <div class="lg:col-span-2">
            <form action="{{ route('admin.spesifikasi-bus.update', $spesifikasiBus) }}" method="POST">
                @csrf @method('PUT')

                <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3"
                        style="background:linear-gradient(135deg,#7c3aed,#9333ea);">
                        <div
                            style="width:40px;height:40px;background:{{ $spesifikasiBus->warna_bg ?? 'rgba(255,255,255,0.15)' }};border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="{{ $spesifikasiBus->ikon ?? 'bx bx-cog' }}"
                                style="font-size:20px;color:{{ $spesifikasiBus->warna ?? '#fff' }};"></i>
                        </div>
                        <div>
                            <div class="text-white font-bold text-sm">Edit: {{ $spesifikasiBus->label }}</div>
                            <div class="text-purple-200 text-xs">{{ $spesifikasiBus->nilai }}</div>
                        </div>
                    </div>

                    <div class="p-6">
                        @include('admin.spesifikasi-bus._form')
                    </div>
                </div>

                <div class="flex gap-3 mt-4">
                    <button type="submit" class="btn-primary flex-1 justify-center py-3">
                        <i class="bx bx-save mr-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.spesifikasi-bus.index') }}" class="btn-secondary px-6 py-3">
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
                        <i class="bx bx-show text-purple-600"></i> Preview Card
                    </h3>
                </div>
                <div class="p-5">
                    <div id="spek-preview-card"
                        style="border-radius:16px;padding:16px;border:1px solid #f1f5f9;background:white;box-shadow:0 1px 6px rgba(0,0,0,0.05);transition:all .3s;">
                        <div class="flex items-start gap-3">
                            <div id="prev-icon-wrap"
                                style="width:42px;height:42px;border-radius:12px;background:{{ $spesifikasiBus->warna_bg ?? '#f5f3ff' }};flex-shrink:0;display:flex;align-items:center;justify-content:center;transition:all .3s;">
                                <i id="prev-icon" class="{{ $spesifikasiBus->ikon ?? 'bx bx-cog' }}"
                                    style="font-size:20px;color:{{ $spesifikasiBus->warna ?? '#7c3aed' }};transition:all .3s;"></i>
                            </div>
                            <div>
                                <div id="prev-label" class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    {{ $spesifikasiBus->label }}
                                </div>
                                <div id="prev-nilai" class="font-bold text-gray-900 text-base mt-0.5">
                                    {{ $spesifikasiBus->nilai }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="background:#faf5ff;border-radius:16px;padding:16px;border:1px solid #e9d5ff;">
                <div class="text-xs font-bold text-purple-800 mb-2 flex items-center gap-2">
                    <i class="bx bx-info-circle text-lg"></i> Quick Ikon
                </div>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(['bx bx-user', 'bx bx-bus', 'bx bx-coin', 'bx bx-cog', 'bx bx-map', 'bx bx-tv', 'bx bx-chair', 'bx bx-wifi', 'bx bxs-badge-check'] as $ic)
                        <div class="flex flex-col items-center gap-1 cursor-pointer p-2 rounded-lg hover:bg-purple-100"
                            onclick="document.querySelector('input[name=ikon]').value='{{ $ic }}';document.querySelector('input[name=ikon]').dispatchEvent(new Event('input'))">
                            <i class="{{ $ic }} text-purple-600 text-lg"></i>
                            <span class="text-[9px] text-gray-400 text-center leading-tight">{{ Str::after($ic, 'bx-') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateSpekPreview() {
                const label = document.querySelector('input[name="label"]')?.value || 'Label';
                const nilai = document.querySelector('input[name="nilai"]')?.value || 'Nilai';
                const ikon = document.querySelector('input[name="ikon"]')?.value || 'bx bx-cog';
                const warna = document.querySelector('input[name="warna"]')?.value ||
                    document.getElementById('warna-picker')?.value || '#7c3aed';
                const bg = document.querySelector('input[name="warna_bg"]')?.value ||
                    document.getElementById('warna-bg-picker')?.value || '#f5f3ff';

                document.getElementById('prev-label').textContent = label;
                document.getElementById('prev-nilai').textContent = nilai;
                document.getElementById('prev-icon').className = ikon;
                document.getElementById('prev-icon').style.color = warna;
                document.getElementById('prev-icon-wrap').style.background = bg;
            }
            document.querySelectorAll('input, textarea').forEach(el => el.addEventListener('input', updateSpekPreview));
            updateSpekPreview();
        });
    </script>
@endpush