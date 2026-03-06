@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali! Berikut ringkasan aktivitas website.')

@push('styles')
    <style>
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card {
            animation: fadeUp 0.5s ease both;
        }

        .stat-card:nth-child(1) {
            animation-delay: .05s
        }

        .stat-card:nth-child(2) {
            animation-delay: .10s
        }

        .stat-card:nth-child(3) {
            animation-delay: .15s
        }

        .stat-card:nth-child(4) {
            animation-delay: .20s
        }

        .stat-card:nth-child(5) {
            animation-delay: .25s
        }

        .stat-card:nth-child(6) {
            animation-delay: .30s
        }

        .stat-card:nth-child(7) {
            animation-delay: .35s
        }

        .stat-card:nth-child(8) {
            animation-delay: .40s
        }

        .widget {
            animation: fadeUp 0.6s ease both;
        }

        .widget:nth-child(1) {
            animation-delay: .3s
        }

        .widget:nth-child(2) {
            animation-delay: .4s
        }

        .widget:nth-child(3) {
            animation-delay: .5s
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: all .25s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            opacity: .07;
            transform: translate(20px, -20px);
        }

        .bar-chart-bar {
            transition: height .8s cubic-bezier(.4, 0, .2, 1);
            border-radius: 4px 4px 0 0;
            min-height: 4px;
        }
    </style>
@endpush

@section('content')

    {{-- Greeting Banner --}}
    <div class="mb-6 rounded-2xl overflow-hidden"
        style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#2563eb 100%);padding:24px 28px;position:relative;">
        <div
            style="position:absolute;top:-30px;right:-30px;width:180px;height:180px;background:rgba(255,255,255,0.05);border-radius:50%;">
        </div>
        <div
            style="position:absolute;bottom:-40px;right:80px;width:120px;height:120px;background:rgba(255,255,255,0.04);border-radius:50%;">
        </div>
        <div class="flex items-center justify-between relative z-10">
            <div>
                <div class="text-blue-200 text-sm font-medium mb-1">
                    {{ now()->locale('id')->translatedFormat('l, d F Y') }} · {{ now()->format('H:i') }} WITA
                </div>
                <h2 class="text-white text-2xl font-extrabold mb-1">
                    Selamat datang, <span style="color:#fbbf24;">{{ auth()->user()->name }}</span>! 👋
                </h2>
                <p class="text-blue-300 text-sm">Panel Admin Dinas Perhubungan Kota Palu</p>
            </div>
            <div class="hidden md:flex items-center gap-3">
                @if($stats['pesan_baru'] > 0)
                    <a href="{{ route('admin.kontak.index') }}"
                        style="background:rgba(239,68,68,0.9);color:white;padding:10px 18px;border-radius:12px;font-size:13px;font-weight:700;display:flex;align-items:center;gap:6px;text-decoration:none;animation:fadeUp .5s ease;">
                        <i class="bx bx-envelope text-lg"></i>
                        {{ $stats['pesan_baru'] }} Pesan Baru
                    </a>
                @endif
                <a href="{{ route('admin.berita.create') }}"
                    style="background:rgba(255,255,255,0.15);color:white;padding:10px 18px;border-radius:12px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:6px;text-decoration:none;border:1px solid rgba(255,255,255,0.2);">
                    <i class="bx bx-plus text-lg"></i> Tambah Berita
                </a>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        @php
            $statCards = [
                ['label' => 'Berita', 'value' => $stats['berita'], 'icon' => 'bx bx-news', 'grad' => 'linear-gradient(135deg,#3b82f6,#6366f1)', 'route' => 'admin.berita.index'],
                ['label' => 'Galeri', 'value' => $stats['galeri'], 'icon' => 'bx bx-images', 'grad' => 'linear-gradient(135deg,#a855f7,#ec4899)', 'route' => 'admin.galeri.index'],
                ['label' => 'Pengumuman', 'value' => $stats['pengumuman'], 'icon' => 'bx bx-bell', 'grad' => 'linear-gradient(135deg,#f59e0b,#f97316)', 'route' => 'admin.pengumuman.index'],
                ['label' => 'Layanan', 'value' => $stats['layanan'], 'icon' => 'bx bx-cog', 'grad' => 'linear-gradient(135deg,#10b981,#059669)', 'route' => 'admin.layanan.index'],
                ['label' => 'Dokumen', 'value' => $stats['dokumen'], 'icon' => 'bx bx-file', 'grad' => 'linear-gradient(135deg,#f97316,#ef4444)', 'route' => 'admin.dokumen.index'],
                ['label' => 'Pesan Baru', 'value' => $stats['pesan_baru'], 'icon' => 'bx bx-envelope', 'grad' => 'linear-gradient(135deg,#ef4444,#dc2626)', 'route' => 'admin.kontak.index'],
                ['label' => 'Koridor Aktif', 'value' => $stats['koridor'], 'icon' => 'bx bx-route', 'grad' => 'linear-gradient(135deg,#0ea5e9,#2563eb)', 'route' => 'admin.koridor.index'],
                ['label' => 'Total Halte', 'value' => $stats['halte'], 'icon' => 'bx bx-map-pin', 'grad' => 'linear-gradient(135deg,#14b8a6,#0891b2)', 'route' => 'admin.halte.index'],
            ];
        @endphp

        @foreach($statCards as $idx => $s)
            <a href="{{ route($s['route']) }}" class="stat-card group" style="--grad:{{ $s['grad'] }}">
                <div
                    style="position:absolute;top:0;right:0;width:70px;height:70px;background:{{ explode(',', $s['grad'])[1] ?? '#3b82f6' }};opacity:.08;border-radius:50%;transform:translate(20px,-20px);">
                </div>
                <div
                    style="width:38px;height:38px;border-radius:12px;background:{{ $s['grad'] }};display:flex;align-items:center;justify-content:center;margin-bottom:12px;box-shadow:0 4px 12px rgba(0,0,0,.15);">
                    <i class="{{ $s['icon'] }} text-white" style="font-size:17px;"></i>
                </div>
                <div class="text-2xl font-extrabold text-gray-900 counter" data-target="{{ $s['value'] }}">0</div>
                <div class="text-xs text-gray-500 font-medium mt-0.5 leading-tight">{{ $s['label'] }}</div>
                <div style="position:absolute;bottom:14px;right:14px;opacity:0;transform:translateX(-4px);transition:all .2s;"
                    class="group-hover:opacity-100 group-hover:translate-x-0">
                    <i class="bx bx-chevron-right text-gray-300 text-lg"></i>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">

        {{-- Chart Aktivitas 7 hari --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-card widget overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                        <i class="bx bx-bar-chart-alt-2 text-primary-600 text-lg"></i> Aktivitas 7 Hari Terakhir
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5">Berita dibuat & pesan masuk</p>
                </div>
                <div class="flex items-center gap-3 text-xs">
                    <span class="flex items-center gap-1.5 font-medium text-blue-600">
                        <span
                            style="width:10px;height:10px;background:#3b82f6;border-radius:3px;display:inline-block;"></span>
                        Berita
                    </span>
                    <span class="flex items-center gap-1.5 font-medium text-amber-600">
                        <span
                            style="width:10px;height:10px;background:#f59e0b;border-radius:3px;display:inline-block;"></span>
                        Pesan
                    </span>
                </div>
            </div>
            <div class="px-6 py-5">
                @php
                    $maxVal = max(array_merge(
                        array_column($aktivitas, 'berita'),
                        array_column($aktivitas, 'pesan'),
                        [1]
                    ));
                @endphp
                <div class="flex items-end gap-2 h-36">
                    @foreach($aktivitas as $a)
                        <div class="flex-1 flex flex-col items-center gap-1">
                            <div class="w-full flex items-end gap-0.5 justify-center" style="height:108px;">
                                <div class="flex-1 bar-chart-bar"
                                    style="background:linear-gradient(180deg,#3b82f6,#6366f1);height:{{ $maxVal > 0 ? round(($a['berita'] / $maxVal) * 100) : 0 }}%;opacity:.9;"
                                    title="{{ $a['berita'] }} berita"></div>
                                <div class="flex-1 bar-chart-bar"
                                    style="background:linear-gradient(180deg,#f59e0b,#f97316);height:{{ $maxVal > 0 ? round(($a['pesan'] / $maxVal) * 100) : 0 }}%;"
                                    title="{{ $a['pesan'] }} pesan"></div>
                            </div>
                            <span class="text-xs text-gray-400 whitespace-nowrap">{{ $a['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Status Ringkas --}}
        <div class="bg-white rounded-2xl shadow-card widget overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                    <i class="bx bx-tachometer text-emerald-600 text-lg"></i> Status Website
                </h3>
            </div>
            <div class="p-5 space-y-3">
                @php
                    $statusItems = [
                        ['label' => 'Berita Published', 'val' => \App\Models\Berita::where('status', 'publish')->count(), 'total' => $stats['berita'], 'color' => '#3b82f6'],
                        ['label' => 'Pesan Dibaca', 'val' => $stats['pesan_total'] - $stats['pesan_baru'], 'total' => $stats['pesan_total'], 'color' => '#10b981'],
                        ['label' => 'Koridor Aktif', 'val' => $stats['koridor'], 'total' => max(\App\Models\Koridor::count(), 1), 'color' => '#f59e0b'],
                    ];
                @endphp
                @foreach($statusItems as $si)
                    @php $pct = $si['total'] > 0 ? round(($si['val'] / $si['total']) * 100) : 0; @endphp
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-xs font-semibold text-gray-700">{{ $si['label'] }}</span>
                            <span class="text-xs font-bold text-gray-900">{{ $si['val'] }}/{{ $si['total'] }}</span>
                        </div>
                        <div style="height:7px;background:#f1f5f9;border-radius:99px;overflow:hidden;">
                            <div style="height:100%;width:{{ $pct }}%;background:{{ $si['color'] }};border-radius:99px;transition:width 1s ease;"
                                class="progress-bar"></div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="text-xs font-semibold text-gray-500 mb-3">Info Trayek</div>
                    <div class="grid grid-cols-2 gap-2">
                        <div style="background:#eff6ff;border-radius:12px;padding:12px;text-align:center;">
                            <div class="text-lg font-extrabold text-blue-700">{{ $stats['koridor'] }}</div>
                            <div class="text-xs text-blue-500">Koridor</div>
                        </div>
                        <div style="background:#f0fdf4;border-radius:12px;padding:12px;text-align:center;">
                            <div class="text-lg font-extrabold text-emerald-700">{{ $stats['halte'] }}</div>
                            <div class="text-xs text-emerald-500">Halte</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.koridor.index') }}"
                        class="mt-3 flex items-center justify-center gap-1.5 text-xs font-semibold text-primary-700 hover:text-primary-900 transition"
                        style="padding:8px;background:#eff6ff;border-radius:10px;text-decoration:none;">
                        <i class="bx bx-route"></i> Kelola Trayek
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Bottom Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">

        {{-- Berita Terbaru --}}
        <div class="bg-white rounded-2xl shadow-card overflow-hidden widget">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                    <i class="bx bx-news text-blue-600 text-lg"></i> Berita Terbaru
                </h3>
                <a href="{{ route('admin.berita.create') }}" class="btn-primary text-xs py-1.5 px-3">
                    <i class="bx bx-plus"></i> Tambah
                </a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($berita_terbaru as $item)
                    <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-blue-50/40 transition-colors group">
                        <div
                            style="width:36px;height:36px;background:linear-gradient(135deg,#3b82f6,#6366f1);border-radius:10px;display:flex;align-items:center;justify-content:center;shrink:0;">
                            <i class="bx bx-news text-white text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-gray-900 text-sm truncate">{{ $item->judul }}</div>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span
                                    class="text-xs px-2 py-0.5 rounded-full font-medium
                                                    {{ $item->status === 'publish' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $item->status === 'publish' ? '✓ Publish' : 'Draft' }}
                                </span>
                                <span class="text-xs text-gray-400">{{ optional($item->created_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.berita.edit', $item) }}"
                            class="opacity-0 group-hover:opacity-100 transition text-blue-500 hover:text-blue-700">
                            <i class="bx bx-edit text-lg"></i>
                        </a>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center text-gray-400 text-sm">
                        <i class="bx bx-news text-4xl mb-2 block"></i> Belum ada berita.
                    </div>
                @endforelse
            </div>
            <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
                <a href="{{ route('admin.berita.index') }}" class="text-blue-600 text-xs font-semibold hover:underline">
                    Lihat semua {{ $stats['berita'] }} berita →
                </a>
            </div>
        </div>

        {{-- Pesan Masuk --}}
        <div class="bg-white rounded-2xl shadow-card overflow-hidden widget">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                    <i class="bx bx-envelope text-amber-600 text-lg"></i> Pesan Masuk
                    @if($stats['pesan_baru'] > 0)
                        <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                            {{ $stats['pesan_baru'] }} baru
                        </span>
                    @endif
                </h3>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($pesan_terbaru as $item)
                    <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-amber-50/40 transition-colors group
                                                {{ !$item->dibaca ? 'bg-amber-50/30 border-l-3 border-amber-400' : '' }}">
                        <div
                            style="width:36px;height:36px;min-width:36px;background:linear-gradient(135deg,#f59e0b,#f97316);border-radius:10px;display:flex;align-items:center;justify-content:center;position:relative;">
                            <i class="bx bx-user text-white text-sm"></i>
                            @if(!$item->dibaca)
                                <span
                                    style="position:absolute;top:-3px;right:-3px;width:10px;height:10px;background:#ef4444;border-radius:50%;border:2px solid white;"></span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-gray-900 text-sm flex items-center gap-2">
                                {{ $item->nama }}
                                @if(!$item->dibaca)
                                    <span
                                        class="text-[9px] bg-red-100 text-red-600 px-1.5 py-0.5 rounded font-bold uppercase">Baru</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 truncate">{{ $item->subjek }}</div>
                            <div class="text-xs text-gray-400">{{ optional($item->created_at)->diffForHumans() }}</div>
                        </div>
                        <a href="{{ route('admin.kontak.show', $item) }}"
                            class="opacity-0 group-hover:opacity-100 transition text-amber-500 hover:text-amber-700">
                            <i class="bx bx-show text-lg"></i>
                        </a>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center text-gray-400 text-sm">
                        <i class="bx bx-envelope text-4xl mb-2 block"></i> Belum ada pesan masuk.
                    </div>
                @endforelse
            </div>
            <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50">
                <a href="{{ route('admin.kontak.index') }}" class="text-amber-600 text-xs font-semibold hover:underline">
                    Lihat semua {{ $stats['pesan_total'] }} pesan →
                </a>
            </div>
        </div>

    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-2xl shadow-card overflow-hidden widget">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                <i class="bx bx-zap text-yellow-500 text-lg"></i> Aksi Cepat
            </h3>
        </div>
        <div class="p-5 grid grid-cols-3 sm:grid-cols-6 gap-3">
            @php
                $quickActions = [
                    ['Tambah Berita', 'bx bx-plus-circle', 'admin.berita.create', '#3b82f6', '#eff6ff'],
                    ['Upload Foto', 'bx bx-image-add', 'admin.galeri.create', '#a855f7', '#faf5ff'],
                    ['Pengumuman', 'bx bx-bell-plus', 'admin.pengumuman.create', '#f59e0b', '#fffbeb'],
                    ['Tambah Koridor', 'bx bx-route', 'admin.koridor.create', '#0ea5e9', '#f0f9ff'],
                    ['Upload Dokumen', 'bx bx-file-plus', 'admin.dokumen.create', '#f97316', '#fff7ed'],
                    ['Lihat Pesan', 'bx bx-message-detail', 'admin.kontak.index', '#ef4444', '#fef2f2'],
                ];
            @endphp
            @foreach($quickActions as $qa)
                <a href="{{ route($qa[2]) }}"
                    style="display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px 8px;border-radius:14px;background:{{ $qa[4] }};border:2px solid transparent;text-decoration:none;transition:all .2s;"
                    onmouseenter="this.style.borderColor='{{ $qa[3] }}';this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,.1)'"
                    onmouseleave="this.style.borderColor='transparent';this.style.transform='';this.style.boxShadow=''">
                    <div
                        style="width:42px;height:42px;background:{{ $qa[3] }};border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px {{ $qa[3] }}40;">
                        <i class="{{ $qa[1] }} text-white" style="font-size:20px;"></i>
                    </div>
                    <span
                        style="font-size:11px;font-weight:600;color:#374151;text-align:center;line-height:1.3;">{{ $qa[0] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Widget Pengaturan Tarif --}}
    @php
        $tarifGratis = \App\Models\Pengaturan::get('tarif_gratis', '1');
        $tarifHarga = \App\Models\Pengaturan::get('tarif_harga', 0);
        $tarifKeterangan = \App\Models\Pengaturan::get('tarif_keterangan', 'Masa percobaan Oktober – Desember 2024');
    @endphp
    <div class="mt-5 bg-white rounded-2xl shadow-card overflow-hidden widget">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-900 text-sm flex items-center gap-2">
                <i class="bx bx-coin text-yellow-500 text-lg"></i> Pengaturan Tarif Bus
            </h3>
            {{-- Preview Badge --}}
            <span id="tarif-preview-badge" style="padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;
                                 background:{{ $tarifGratis == '1' ? 'linear-gradient(135deg,#16a34a,#15803d)' : 'linear-gradient(135deg,#3b82f6,#1d4ed8)' }};
                                 color:white;">
                {{ $tarifGratis == '1' ? 'GRATIS' : 'Rp ' . number_format($tarifHarga, 0, ',', '.') }}
            </span>
        </div>

        <form action="{{ route('admin.pengaturan.tarif') }}" method="POST" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-start">

                {{-- Toggle Gratis --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Status Tarif</label>
                    <div class="flex gap-2">
                        <button type="button" id="btn-gratis" onclick="setTarif(true)"
                            class="flex-1 py-2.5 rounded-xl text-sm font-bold border-2 transition-all
                                           {{ $tarifGratis == '1' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-500 border-gray-200' }}">
                            <i class="bx bx-check-circle mr-1"></i> Gratis
                        </button>
                        <button type="button" id="btn-bayar" onclick="setTarif(false)"
                            class="flex-1 py-2.5 rounded-xl text-sm font-bold border-2 transition-all
                                           {{ $tarifGratis != '1' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-500 border-gray-200' }}">
                            <i class="bx bx-money mr-1"></i> Berbayar
                        </button>
                    </div>
                    <input type="hidden" name="tarif_gratis" id="tarif_gratis_input" value="{{ $tarifGratis }}">
                </div>

                {{-- Harga --}}
                <div id="harga-section" style="{{ $tarifGratis == '1' ? 'opacity:.4;pointer-events:none;' : '' }}">
                    <label for="tarif_harga" class="block text-xs font-semibold text-gray-600 mb-2">Harga (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-semibold">Rp</span>
                        <input type="number" name="tarif_harga" id="tarif_harga" value="{{ $tarifHarga }}" min="0"
                            step="500" oninput="updatePreview()"
                            class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Contoh: 4000">
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="tarif_keterangan" class="block text-xs font-semibold text-gray-600 mb-2">Keterangan</label>
                    <input type="text" name="tarif_keterangan" id="tarif_keterangan" value="{{ $tarifKeterangan }}"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Masa berlaku / keterangan">
                </div>

            </div>

            {{-- Preview Tarif Card --}}
            <div class="mt-5 p-4 rounded-2xl flex items-center gap-3" id="tarif-card-preview"
                style="background:{{ $tarifGratis == '1' ? 'linear-gradient(135deg,#16a34a,#15803d)' : 'linear-gradient(135deg,#3b82f6,#1d4ed8)' }};">
                <div
                    style="width:38px;height:38px;background:rgba(255,255,255,.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bx bx-coin text-white text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="font-bold text-white text-sm" id="preview-label">
                        Tarif: {{ $tarifGratis == '1' ? 'GRATIS!' : 'Rp ' . number_format($tarifHarga, 0, ',', '.') }}
                    </div>
                    <div class="text-white/80 text-xs" id="preview-ket">{{ $tarifKeterangan }}</div>
                </div>
                <span class="text-[10px] font-bold text-white bg-white/20 px-3 py-1 rounded-full border border-white/30">BTS
                    Scheme</span>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <p class="text-xs text-gray-400">Perubahan ini akan langsung tampil di halaman publik
                    <strong>/trayek</strong>
                </p>
                <button type="submit" class="btn-primary px-6 py-2 text-sm">
                    <i class="bx bx-save mr-1"></i> Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

@endsection


@push('scripts')
    <script>
        // Counter animation
        document.addEventListener('DOMContentLoaded', function () {
            const counters = document.querySelectorAll('.counter');
            const obs = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    const el = entry.target;
                    const target = parseInt(el.dataset.target) || 0;
                    let current = 0;
                    const step = Math.max(1, Math.ceil(target / 40));
                    const timer = setInterval(() => {
                        current = Math.min(current + step, target);
                        el.textContent = current.toLocaleString();
                        if (current >= target) clearInterval(timer);
                    }, 30);
                    obs.unobserve(el);
                });
            }, { threshold: 0.3 });
            counters.forEach(c => obs.observe(c));

            // Animate progress bars
            setTimeout(() => {
                document.querySelectorAll('.progress-bar').forEach(bar => {
                    bar.style.width = bar.style.width;
                });
            }, 400);
        });

        // Tarif Widget: toggle gratis/berbayar
        var isGratis = document.getElementById('tarif_gratis_input')?.value === '1';

        function setTarif(gratis) {
            isGratis = gratis;
            document.getElementById('tarif_gratis_input').value = gratis ? '1' : '0';

            var btnGratis = document.getElementById('btn-gratis');
            var btnBayar = document.getElementById('btn-bayar');
            var hargaSec = document.getElementById('harga-section');

            if (gratis) {
                btnGratis.className = btnGratis.className.replace('bg-white text-gray-500 border-gray-200', '').trim();
                btnGratis.classList.add('bg-green-600', 'text-white', 'border-green-600');
                btnBayar.className = btnBayar.className.replace('bg-blue-600 text-white border-blue-600', '').trim();
                btnBayar.classList.add('bg-white', 'text-gray-500', 'border-gray-200');
                hargaSec.style.opacity = '.4';
                hargaSec.style.pointerEvents = 'none';
            } else {
                btnBayar.className = btnBayar.className.replace('bg-white text-gray-500 border-gray-200', '').trim();
                btnBayar.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                btnGratis.className = btnGratis.className.replace('bg-green-600 text-white border-green-600', '').trim();
                btnGratis.classList.add('bg-white', 'text-gray-500', 'border-gray-200');
                hargaSec.style.opacity = '1';
                hargaSec.style.pointerEvents = 'auto';
            }
            updatePreview();
        }

        function updatePreview() {
            var card = document.getElementById('tarif-card-preview');
            var label = document.getElementById('preview-label');
            var ket = document.getElementById('preview-ket');
            var badge = document.getElementById('tarif-preview-badge');
            var ketVal = document.getElementById('tarif_keterangan')?.value || '';
            var harga = parseInt(document.getElementById('tarif_harga')?.value) || 0;
            var hargaFmt = 'Rp ' + harga.toLocaleString('id-ID');

            if (isGratis) {
                card.style.background = 'linear-gradient(135deg,#16a34a,#15803d)';
                label.textContent = 'Tarif: GRATIS!';
                badge.style.background = 'linear-gradient(135deg,#16a34a,#15803d)';
                badge.textContent = 'GRATIS';
            } else {
                card.style.background = 'linear-gradient(135deg,#3b82f6,#1d4ed8)';
                label.textContent = 'Tarif: ' + hargaFmt;
                badge.style.background = 'linear-gradient(135deg,#3b82f6,#1d4ed8)';
                badge.textContent = hargaFmt;
            }
            ket.textContent = ketVal;
        }

        // Keterangan live update
        document.getElementById('tarif_keterangan')?.addEventListener('input', updatePreview);
    </script>
@endpush