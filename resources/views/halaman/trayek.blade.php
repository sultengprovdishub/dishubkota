@extends('layouts.app')

@section('title', 'Trayek Bus Trans Palu')
@section('description', 'Informasi lengkap trayek, koridor, dan halte Bus Trans Palu - Dinas Perhubungan Kota Palu')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #transPaluMap { height: 580px !important; width: 100% !important; }
    .halte-popup-title { font-weight:800; font-size:13px; color:#1e3a5f; margin-bottom:4px; }
    .halte-popup-sub   { font-size:11px; color:#64748b; display:flex; align-items:center; gap:6px; margin-top:3px; }
    .halte-popup-dot   { width:10px; height:10px; border-radius:50%; display:inline-block; flex-shrink:0; }
    .halte-popup-tag   { font-size:10px; padding:2px 9px; border-radius:99px; font-weight:700; display:inline-block; margin-top:6px; }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="relative min-h-[50vh] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900"></div>
        <div class="absolute inset-0 opacity-10" style="background-image:linear-gradient(rgba(255,255,255,.15) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.15) 1px,transparent 1px);background-size:40px 40px;"></div>
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-gold-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-primary-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 py-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-gold-500/20 text-gold-300 border border-gold-400/30 rounded-full px-4 py-1.5 text-sm font-semibold mb-6">
                    <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                    Trans Palu — Bus Kota Resmi
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-5">
                    Trayek <span class="text-gold-400">Bus Trans Palu</span>
                </h1>
                <p class="text-blue-200 text-lg leading-relaxed mb-8 max-w-lg">
                    Layanan transportasi umum modern Kota Palu dengan <strong class="text-white">5 koridor</strong>
                    dan <strong class="text-white">50+ titik halte</strong> menghubungkan seluruh penjuru kota.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#peta" class="btn-gold"><i class="bx bx-map-alt"></i> Lihat Peta Interaktif</a>
                    <a href="#koridor" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white font-semibold rounded-xl hover:bg-white/20 border border-white/20 transition">
                        <i class="bx bx-list-ul"></i> Detail Koridor
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    ['bx bx-route','5','Koridor Aktif','bg-orange-500'],
                    ['bx bx-map-pin','50+','Titik Halte','bg-blue-600'],
                    ['bx bx-user-check','35','Kapasitas/Bus','bg-green-600'],
                    ['bx bx-coin','GRATIS','Tarif','bg-yellow-500'],
                ] as $s)
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 hover:border-gold-400/40 transition-all group">
                    <div class="w-12 h-12 {{ $s[3] }} rounded-xl flex items-center justify-center mb-3 shadow-lg group-hover:scale-110 transition-transform">
                        <i class="{{ $s[0] }} text-2xl text-white"></i>
                    </div>
                    <div class="text-2xl font-extrabold text-white">{{ $s[1] }}</div>
                    <div class="text-blue-300 text-xs mt-1">{{ $s[2] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="wave-bottom">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

{{-- PETA INTERAKTIF --}}
<section id="peta" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10 reveal">
            <span class="badge-blue uppercase tracking-wider mb-3 inline-block">Peta Interaktif</span>
            <h2 class="section-title">Jaringan Trayek Bus Trans Palu</h2>
            <p class="section-subtitle">Klik tombol koridor untuk menampilkan/menyembunyikan rute. Klik marker untuk info halte.</p>
        </div>

        {{-- Toggle Buttons --}}
        <div class="flex flex-wrap gap-3 justify-center mb-6 reveal">
            <button onclick="toggleAll()" id="btn-all"
                class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm bg-gray-800 text-white hover:bg-gray-700 transition-all shadow">
                <i class="bx bx-layer"></i> Semua Koridor
            </button>
            @foreach($koridor as $btn)
            <button onclick="toggleKoridor('{{ $btn->kode }}')" id="btn-{{ $btn->kode }}"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-sm text-white shadow hover:opacity-85 transition-all border-2 border-white/30"
                style="background-color:{{ $btn->warna }};">
                <span class="font-black">{{ $btn->kode }}</span>
                <span class="hidden sm:inline text-xs opacity-90">{{ Str::limit($btn->nama, 25) }}</span>
            </button>
            @endforeach
        </div>

        {{-- Map Container --}}
        <div class="reveal">
            <div id="transPaluMap" class="w-full rounded-3xl shadow-2xl border-4 border-white" style="height:580px;"></div>
            <p class="text-center text-xs text-gray-400 mt-3">
                <i class="bx bx-map text-primary-400"></i>
                © OpenStreetMap contributors · Data trayek Bus Trans Palu 2024 · Koordinat bersifat pendekatan
            </p>
        </div>
    </div>
</section>

{{-- 5 KORIDOR ACCORDION --}}
<section id="koridor" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14 reveal">
            <span class="badge-gold uppercase tracking-wider mb-3 inline-block">Detail Trayek</span>
            <h2 class="section-title">{{ $koridor->count() }} Koridor Bus Trans Palu</h2>
            <p class="section-subtitle">Klik koridor untuk melihat daftar halte yang dilalui.</p>
        </div>
        <div class="space-y-4">
            @forelse($koridor as $i => $k)
            <div class="reveal" style="animation-delay:{{ $i*0.1 }}s">
                <details class="group bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden"
                         style="border:1px solid {{ $k->warna }}44;">
                    <summary class="flex items-center gap-4 p-5 cursor-pointer list-none">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg shrink-0 group-hover:scale-105 transition"
                             style="background:linear-gradient(135deg,{{ $k->warna }},{{ $k->warna }}cc);">
                            <span class="text-white font-black text-xs leading-none text-center">{{ $k->kode }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="font-bold text-gray-900">{{ $k->nama }}</h3>
                            </div>
                            <div class="flex gap-4 mt-1 text-sm text-gray-500">
                                <span><i class="bx bx-map-pin" style="color:{{ $k->warna }};"></i> {{ $k->halte->count() }} halte</span>
                                @if($k->deskripsi)
                                <span class="text-xs hidden md:inline" style="color:{{ $k->warna }};">{{ $k->deskripsi }}</span>
                                @endif
                            </div>
                        </div>
                        <i class="bx bx-chevron-down text-gray-400 text-2xl shrink-0 group-open:rotate-180 transition-transform duration-300"></i>
                    </summary>
                    <div class="border-t px-6 py-5" style="border-color:{{ $k->warna }}33;">
                        <div class="space-y-0">
                            @foreach($k->halte as $j => $h)
                            @php $isFirst = ($j === 0); $isLast = ($j === $k->halte->count()-1); @endphp
                            <div class="flex items-stretch gap-0">
                                <div class="flex flex-col items-center shrink-0" style="width:24px;">
                                    @if(!$isFirst)
                                    <div class="w-0.5 flex-1" style="background:{{ $k->warna }}44;"></div>
                                    @else
                                    <div class="flex-1"></div>
                                    @endif
                                    <div class="shrink-0 rounded-full border-2 border-white shadow-md"
                                         style="{{ ($isFirst||$isLast) ? 'width:14px;height:14px;background:'.$k->warna.';' : 'width:10px;height:10px;background:#d1d5db;' }}"></div>
                                    @if(!$isLast)
                                    <div class="w-0.5 flex-1" style="background:{{ $k->warna }}44;"></div>
                                    @else
                                    <div class="flex-1"></div>
                                    @endif
                                </div>
                                <div class="py-2 pl-3 flex items-center">
                                    @if($isFirst)<span class="mr-2 text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-semibold">Asal</span>@endif
                                    @if($isLast)<span class="mr-2 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-semibold">Tujuan</span>@endif
                                    @if($h->tipe === 'terminal')
                                    <span class="mr-1 text-xs px-2 py-0.5 rounded-full font-semibold" style="background:{{ $k->warna }}18;color:{{ $k->warna }};">Terminal</span>
                                    @elseif($h->tipe === 'hub')
                                    <span class="mr-1 text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full font-semibold">Hub</span>
                                    @endif
                                    <span class="text-sm {{ ($isFirst||$isLast) ? 'font-bold text-gray-900' : 'text-gray-600' }}">{{ $h->nama }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button onclick="zoomKoridor('{{ $k->kode }}')"
                            class="mt-4 flex items-center gap-2 text-sm font-semibold transition"
                            style="color:{{ $k->warna }};">
                            <i class="bx bx-map-alt"></i> Lihat di peta
                        </button>
                    </div>
                </details>
            </div>
            @empty
            <div class="text-center py-16 text-gray-400">
                <i class="bx bx-route text-5xl mb-2"></i>
                <p>Belum ada data koridor.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>



{{-- SPESIFIKASI --}}

<section class="py-20" style="background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%);">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14 reveal">
            <span class="badge-blue uppercase tracking-wider mb-3 inline-block">Armada</span>
            <h2 class="section-title">Spesifikasi Bus Trans Palu</h2>
            <p class="section-subtitle">Dioperasikan PT Bagong Transport melalui sistem Buy The Service (BTS).</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

            {{-- KIRI: Showcase Bus --}}
            <div class="reveal">
                {{-- Card Utama --}}
                <div id="bus-card" class="rounded-3xl overflow-hidden shadow-2xl"
                     style="background:linear-gradient(145deg,#0a1628 0%,#0f2550 60%,#0a1628 100%); position:relative;">

                    {{-- Glow circles --}}
                    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:300px;height:200px;background:radial-gradient(ellipse,rgba(245,158,11,0.15) 0%,transparent 70%);pointer-events:none;"></div>
                    <div style="position:absolute;top:0;right:0;width:150px;height:150px;background:radial-gradient(circle,rgba(59,130,246,0.1) 0%,transparent 70%);pointer-events:none;"></div>

                    {{-- Header --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.08);">
                        <div style="display:flex;align-items:center;gap:8px;">
                            <span style="width:8px;height:8px;border-radius:50%;background:#4ade80;display:inline-block;animation:pulse 2s infinite;"></span>
                            <span style="color:white;font-size:12px;font-weight:600;">Bus Trans Palu</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:6px;">
                            <span style="background:rgba(245,158,11,0.2);color:#fbbf24;font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;border:1px solid rgba(245,158,11,0.3);">ARMADA AKTIF</span>
                        </div>
                    </div>

                    {{-- Badge Strip --}}
                    <div style="display:flex;gap:8px;padding:10px 20px;border-bottom:1px solid rgba(255,255,255,0.06);">
                        <span style="background:rgba(34,197,94,0.15);color:#4ade80;font-size:10px;font-weight:600;padding:3px 10px;border-radius:20px;border:1px solid rgba(34,197,94,0.2);">✓ TARIF GRATIS</span>
                        <span style="background:rgba(59,130,246,0.15);color:#60a5fa;font-size:10px;font-weight:600;padding:3px 10px;border-radius:20px;border:1px solid rgba(59,130,246,0.2);">✓ AC</span>
                        <span style="background:rgba(168,85,247,0.15);color:#c084fc;font-size:10px;font-weight:600;padding:3px 10px;border-radius:20px;border:1px solid rgba(168,85,247,0.2);">✓ VIDEOTRON</span>
                        <span style="background:rgba(245,158,11,0.15);color:#fbbf24;font-size:10px;font-weight:600;padding:3px 10px;border-radius:20px;border:1px solid rgba(245,158,11,0.2);">✓ BTS</span>
                    </div>

                    {{-- Bus Image Area --}}
                    <div style="position:relative;display:flex;justify-content:center;align-items:center;padding:24px 16px 8px;min-height:220px;">
                        <img id="bus-img" src="{{ asset('images/bus-trans-palu-1.png') }}"
                             alt="Bus Trans Palu"
                             style="max-height:190px;max-width:100%;object-fit:contain;position:relative;z-index:10;transition:transform 0.6s ease;filter:drop-shadow(0 8px 24px rgba(0,0,0,0.5));"
                             onmouseenter="this.style.transform='scale(1.06) translateY(-4px)'"
                             onmouseleave="this.style.transform='scale(1) translateY(0)'">
                    </div>

                    {{-- Stats Row --}}
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid rgba(255,255,255,0.08);">
                        <div style="text-align:center;padding:16px 8px;border-right:1px solid rgba(255,255,255,0.08);">
                            <div class="stat-num" data-target="35" style="font-size:28px;font-weight:900;color:#f59e0b;line-height:1;">0</div>
                            <div style="font-size:11px;color:rgba(255,255,255,0.65);margin-top:4px;">Penumpang</div>
                        </div>
                        <div style="text-align:center;padding:16px 8px;border-right:1px solid rgba(255,255,255,0.08);">
                            <div class="stat-num" data-target="21" style="font-size:28px;font-weight:900;color:#f59e0b;line-height:1;">0</div>
                            <div style="font-size:11px;color:rgba(255,255,255,0.65);margin-top:4px;">Kursi</div>
                        </div>
                        <div style="text-align:center;padding:16px 8px;">
                            <div class="stat-num" data-target="5" style="font-size:28px;font-weight:900;color:#f59e0b;line-height:1;">0</div>
                            <div style="font-size:11px;color:rgba(255,255,255,0.65);margin-top:4px;">Koridor</div>
                        </div>
                    </div>

                    {{-- Footer strip --}}
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 20px;border-top:1px solid rgba(255,255,255,0.06);">
                        <span style="color:rgba(255,255,255,0.5);font-size:10px;">Putih · Aksen Kuning Emas</span>
                        <span style="color:rgba(255,255,255,0.5);font-size:10px;">50 Halte · 5 Koridor</span>
                    </div>
                </div>

                {{-- Tarif Card --}}
                @php
                    $tGratis = \App\Models\Pengaturan::get('tarif_gratis', '1');
                    $tHarga  = \App\Models\Pengaturan::get('tarif_harga', 0);
                    $tKet    = \App\Models\Pengaturan::get('tarif_keterangan', 'Layanan Bus Trans Palu');
                    $tarifGrad = $tGratis == '1'
                        ? 'linear-gradient(135deg,#16a34a,#15803d)'
                        : 'linear-gradient(135deg,#3b82f6,#1d4ed8)';
                    $tarifShadow = $tGratis == '1'
                        ? '0 4px 20px rgba(22,163,74,0.35)'
                        : '0 4px 20px rgba(59,130,246,0.35)';
                    $tarifLabel = $tGratis == '1'
                        ? 'GRATIS!'
                        : 'Rp '.number_format($tHarga,0,',','.');
                @endphp
                <div style="margin-top:12px;display:flex;align-items:center;gap:14px;background:{{ $tarifGrad }};border-radius:18px;padding:14px 20px;box-shadow:{{ $tarifShadow }};cursor:default;transition:transform 0.2s;"
                     onmouseenter="this.style.transform='translateY(-2px)'"
                     onmouseleave="this.style.transform='translateY(0)'">
                    <div style="width:42px;height:42px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bx bx-coin" style="color:white;font-size:20px;"></i>
                    </div>
                    <div>
                        <div style="color:white;font-weight:800;font-size:16px;">Tarif: {{ $tarifLabel }}</div>
                        <div style="color:rgba(255,255,255,0.8);font-size:12px;margin-top:2px;">{{ $tKet }}</div>
                    </div>
                    <div style="margin-left:auto;background:rgba(255,255,255,0.2);color:white;font-size:10px;font-weight:700;padding:4px 12px;border-radius:20px;border:1px solid rgba(255,255,255,0.3);">BTS Scheme</div>
                </div>
            </div>

            {{-- KANAN: Spesifikasi Cards --}}
            <div class="reveal">
                <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px;">
                    @forelse($spesifikasi as $s)
                    <div style="background:white;border-radius:16px;padding:16px;border:1px solid #f1f5f9;box-shadow:0 1px 6px rgba(0,0,0,0.05);cursor:default;transition:all 0.25s;"
                         onmouseenter="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)';this.style.borderColor='{{ $s->warna }}40'"
                         onmouseleave="this.style.transform='translateY(0)';this.style.boxShadow='0 1px 6px rgba(0,0,0,0.05)';this.style.borderColor='#f1f5f9'">
                        <div style="width:40px;height:40px;background:{{ $s->warna_bg }};border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:12px;border:1px solid {{ $s->warna }}25;transition:transform 0.2s;"
                             onmouseenter="this.style.transform='scale(1.12)'"
                             onmouseleave="this.style.transform='scale(1)'">
                            <i class="{{ $s->ikon }}" style="color:{{ $s->warna }};font-size:18px;"></i>
                        </div>
                        <div style="color:#9ca3af;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">{{ $s->label }}</div>
                        <div style="color:#1e293b;font-weight:700;font-size:13px;line-height:1.3;">{{ $s->nilai }}</div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center text-gray-400 py-8">Belum ada data spesifikasi.</div>
                    @endforelse
                </div>

                {{-- Info note --}}
                <div style="margin-top:14px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:14px;padding:12px 16px;display:flex;align-items:flex-start;gap:10px;">
                    <i class="bx bx-info-circle" style="color:#3b82f6;font-size:18px;flex-shrink:0;margin-top:1px;"></i>
                    <p style="color:#1d4ed8;font-size:12px;line-height:1.5;margin:0;">Bus Trans Palu adalah layanan transportasi publik resmi Kota Palu di bawah Dinas Perhubungan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
// Counter animation saat section masuk layar
(function() {
    const nums = document.querySelectorAll('.stat-num');
    function animateCounters() {
        nums.forEach(el => {
            const target = parseInt(el.dataset.target);
            let current = 0;
            const step = Math.max(1, Math.floor(target / 30));
            const timer = setInterval(() => {
                current = Math.min(current + step, target);
                el.textContent = current;
                if (current >= target) clearInterval(timer);
            }, 40);
        });
    }
    if ('IntersectionObserver' in window) {
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { animateCounters(); obs.disconnect(); }});
        }, { threshold: 0.4 });
        const card = document.getElementById('bus-card');
        if (card) obs.observe(card);
    } else {
        animateCounters();
    }
})();
</script>
@endpush


{{-- PANDUAN --}}





<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-12 reveal">
            <span class="badge-gold uppercase tracking-wider mb-3 inline-block">Panduan</span>
            <h2 class="section-title">Cara Naik Bus Trans Palu</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['bx bx-map-pin','1','Temukan Halte','Cari 50+ titik halte Bus Trans Palu terdekat dari lokasi Anda.','bg-primary-50 text-primary-700'],
                ['bx bx-bus-school','2','Tunggu Bus','Bus beroperasi setiap hari dengan interval kedatangan reguler.','bg-gold-50 text-gold-700'],
                ['bx bx-log-in','3','Naik & Nikmati','Nikmati perjalanan nyaman ber-AC bersama Bus Trans Palu.','bg-green-50 text-green-700'],
                ['bx bx-exit','4','Turun di Tujuan','Turun di halte paling dekat dengan tujuan Anda.','bg-purple-50 text-purple-700'],
            ] as $step)
            <div class="text-center reveal">
                <div class="w-16 h-16 {{ $step[4] }} rounded-2xl flex items-center justify-center mx-auto mb-6 mt-4 relative">
                    <i class="{{ $step[0] }} text-2xl"></i>
                    <span class="absolute -top-3 -right-3 w-7 h-7 bg-primary-700 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg z-10">{{ $step[1] }}</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">{{ $step[2] }}</h3>
                <p class="text-gray-500 text-sm">{{ $step[3] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 reveal">
        <div class="hero-gradient rounded-3xl p-10 text-center relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-gold-500/10 rounded-full"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gold-500 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg">
                    <i class="bx bx-info-circle text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-extrabold text-white mb-3">Butuh Informasi Lebih Lanjut?</h3>
                <p class="text-blue-200 mb-6 max-w-md mx-auto">Hubungi Dinas Perhubungan Kota Palu untuk informasi jadwal dan trayek terkini.</p>
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('kontak') }}" class="btn-gold"><i class="bx bx-envelope"></i> Hubungi Kami</a>
                    <a href="{{ route('layanan') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-white/10 text-white font-semibold rounded-xl hover:bg-white/20 border border-white/20 transition">
                        <i class="bx bx-grid-alt"></i> Lihat Layanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
(function() {
    function initMap() {
        if (typeof L === 'undefined') { setTimeout(initMap, 300); return; }

        var map = L.map('transPaluMap', {
            center: [-0.870, 119.878],
            zoom: 12,
            scrollWheelZoom: true
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);

        // Build KORIDOR data from DB via PHP → JS
        @php
        $koridorMapData = [];
        foreach($koridor as $k) {
            $koridorMapData[$k->kode] = [
                'nama'  => $k->nama,
                'warna' => $k->warna,
                'halte' => $k->halte->map(fn($h) => [
                    'n'   => $h->nama,
                    'lat' => (float)$h->latitude,
                    'lng' => (float)$h->longitude,
                    'hub' => $h->tipe === 'hub' || $h->tipe === 'terminal',
                ])->values()->all(),
            ];
        }
        @endphp
        var KORIDOR = @json($koridorMapData);


        var layerGroups = {};
        var polylineObjs = {};
        var allVisible = true;

        function mkIcon(color, big) {
            var s = big ? 16 : 10;
            return L.divIcon({
                className:'',
                html:'<div style="width:'+s+'px;height:'+s+'px;background:'+color+';border-radius:50%;border:2px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.3);'+(big?'outline:2px solid '+color+';outline-offset:2px;':'')+'"></div>',
                iconSize:[s,s], iconAnchor:[s/2,s/2], popupAnchor:[0,-s/2]
            });
        }

        Object.keys(KORIDOR).forEach(function(kode) {
            var d = KORIDOR[kode];
            var grp = L.layerGroup();
            var lls = d.halte.map(function(h){ return [h.lat, h.lng]; });

            L.polyline(lls,{color:'#fff',weight:9,opacity:.2,lineCap:'round',lineJoin:'round'}).addTo(grp);
            var poly = L.polyline(lls,{color:d.warna,weight:5,opacity:.9,lineCap:'round',lineJoin:'round'});
            poly.addTo(grp);
            polylineObjs[kode] = poly;

            d.halte.forEach(function(h, idx) {
                var isEnd = (idx===0||idx===d.halte.length-1);
                var big = h.hub || isEnd;
                var mkr = L.marker([h.lat,h.lng],{icon:mkIcon(d.warna,big),zIndexOffset:h.hub?600:isEnd?400:0});
                var tag='';
                if(idx===0) tag='<span class="halte-popup-tag" style="background:'+d.warna+';color:#fff">ASAL</span>';
                else if(isEnd) tag='<span class="halte-popup-tag" style="background:#1e40af;color:#fff">TUJUAN</span>';
                else if(h.hub) tag='<span class="halte-popup-tag" style="background:#6366f1;color:#fff">⇄ TRANSFER HUB</span>';
                mkr.bindPopup(
                    '<div class="halte-popup-title">'+h.n+'</div>'+
                    '<div class="halte-popup-sub"><span class="halte-popup-dot" style="background:'+d.warna+'"></span>Koridor '+kode+' · '+d.nama.split('—')[0].trim()+'</div>'+
                    (tag?'<div style="margin-top:6px">'+tag+'</div>':''),
                    {maxWidth:220}
                );
                mkr.addTo(grp);
            });

            grp.addTo(map);
            layerGroups[kode] = grp;
        });

        // Legenda
        var legend = L.control({position:'bottomright'});
        legend.onAdd = function() {
            var d = L.DomUtil.create('div');
            d.style.cssText='background:#fff;border-radius:14px;padding:13px 16px;box-shadow:0 6px 24px rgba(0,0,0,.15);font-family:sans-serif;min-width:190px;';
            var rows = Object.keys(KORIDOR).map(function(k){
                return '<div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;cursor:pointer" onclick="toggleKoridor(\''+k+'\')">'
                    +'<div style="width:28px;height:5px;background:'+KORIDOR[k].warna+';border-radius:4px"></div>'
                    +'<b style="font-size:11px;color:#1f2937">'+k+'</b>'
                    +'<span style="font-size:10px;color:#6b7280">'+KORIDOR[k].nama.split('—')[0].trim()+'</span></div>';
            }).join('');
            d.innerHTML='<div style="font-weight:800;font-size:12px;color:#1e40af;margin-bottom:9px;padding-bottom:7px;border-bottom:1px solid #e5e7eb">🗺️ Legenda Koridor</div>'+rows
                +'<div style="display:flex;align-items:center;gap:8px;margin-top:8px;padding-top:8px;border-top:1px solid #e5e7eb">'
                +'<div style="width:14px;height:14px;background:#6366f1;border-radius:50%;border:2px solid #fff;outline:2px solid #6366f1;outline-offset:2px"></div>'
                +'<span style="font-size:10px;color:#374151">Titik Transfer HUB</span></div>';
            return d;
        };
        legend.addTo(map);

        window.toggleKoridor = function(kode) {
            var btn = document.getElementById('btn-'+kode);
            if(map.hasLayer(layerGroups[kode])) {
                map.removeLayer(layerGroups[kode]);
                if(btn) btn.style.opacity='0.3';
            } else {
                map.addLayer(layerGroups[kode]);
                if(btn) btn.style.opacity='1';
            }
        };

        window.toggleAll = function() {
            allVisible = !allVisible;
            var btnAll = document.getElementById('btn-all');
            Object.keys(layerGroups).forEach(function(k){
                var btn=document.getElementById('btn-'+k);
                if(allVisible){ map.addLayer(layerGroups[k]); if(btn)btn.style.opacity='1'; }
                else{ map.removeLayer(layerGroups[k]); if(btn)btn.style.opacity='0.3'; }
            });
            if(btnAll) btnAll.innerHTML = allVisible ? '<i class="bx bx-layer"></i> Semua Koridor' : '<i class="bx bx-layer-minus"></i> Sembunyikan';
        };

        window.zoomKoridor = function(kode) {
            if(!layerGroups[kode]) return;
            if(!map.hasLayer(layerGroups[kode])) toggleKoridor(kode);
            var poly = polylineObjs[kode];
            if(poly) map.fitBounds(poly.getBounds(),{padding:[40,40]});
            document.getElementById('peta').scrollIntoView({behavior:'smooth'});
        };

        // Multiple invalidateSize calls
        [100,300,600,1200].forEach(function(ms){ setTimeout(function(){ map.invalidateSize(); }, ms); });
    }

    if(document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMap);
    } else {
        initMap();
    }
})();
</script>
@endpush