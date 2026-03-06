@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ============================================================ HERO SECTION ============================================================ --}}
<section class="relative overflow-hidden min-h-[92vh] flex items-center">

    {{-- ===== YouTube Video Background ===== --}}
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <iframe
            id="hero-video"
            src="https://www.youtube.com/embed/DYGZwyACsBg?autoplay=1&mute=1&loop=1&playlist=DYGZwyACsBg&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1&fs=0&playsinline=1&enablejsapi=1"
            class="absolute"
            style="
                top: 50%; left: 50%;
                width: 100vw; height: 56.25vw;
                min-height: 100vh; min-width: 177.78vh;
                transform: translate(-50%, -50%);
                pointer-events: none;
                border: none;
            "
            allow="autoplay; encrypted-media"
            allowfullscreen
            title="Hero Background Video">
        </iframe>
        {{-- Overlay biru semi-transparan agar teks tetap terbaca --}}
        <div class="absolute inset-0 bg-gradient-to-br from-primary-950/80 via-primary-900/70 to-primary-800/60"></div>
        {{-- Decorative blobs di atas overlay --}}
        <div class="absolute top-20 right-10 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-10 left-10 w-56 h-56 bg-gold-500/15 rounded-full blur-3xl animate-pulse-slow" style="animation-delay:1s"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Left Content --}}
            <div>
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-gold-300 border border-gold-400/30 rounded-full px-4 py-1.5 text-sm font-medium mb-6 animate-fade-in">
                    <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                    Website Resmi Pemerintah Kota Palu
                </div>
                <h1 class="text-4xl md:text-5xl xl:text-6xl font-extrabold text-white leading-tight mb-6 animate-fade-in-up" style="animation-delay:0.2s">
                    Dinas <span class="text-gold-400">Perhubungan</span><br>
                    Kota Palu
                </h1>
                <p class="text-blue-100 text-lg leading-relaxed mb-8 max-w-xl animate-fade-in-up" style="animation-delay:0.4s">
                    Melayani dengan sepenuh hati. Mewujudkan sistem transportasi yang aman, nyaman, dan berkelanjutan untuk seluruh masyarakat Kota Palu.
                </p>
                <div class="flex flex-wrap gap-4 animate-fade-in-up" style="animation-delay:0.6s">
                    <a href="{{ route('layanan') }}" class="btn-gold">
                        <i class="bx bx-cog"></i> Lihat Layanan
                    </a>
                    <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/20 border border-white/20 transition-all duration-300">
                        <i class="bx bx-phone"></i> Hubungi Kami
                    </a>
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-3 gap-4 mt-12 animate-fade-in-up" style="animation-delay:0.8s">
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-white" data-count="6" data-suffix="">
                            <span data-count="6">0</span>
                        </div>
                        <div class="text-blue-200 text-xs mt-1">Jenis Layanan</div>
                    </div>
                    <div class="text-center border-x border-white/20">
                        <div class="text-3xl font-extrabold text-gold-400">
                            <span data-count="2500">0</span>+
                        </div>
                        <div class="text-blue-200 text-xs mt-1">Kendaraan Diuji</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-white">
                            <span data-count="15">0</span>+
                        </div>
                        <div class="text-blue-200 text-xs mt-1">Tahun Melayani</div>
                    </div>
                </div>
            </div>

            {{-- Right: Illustration / Visual --}}
            <div class="hidden lg:flex justify-center relative animate-float">
                <div class="relative">
                    <div class="w-96 h-96 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 flex items-center justify-center shadow-2xl">
                        <i class="bx bx-bus text-white/80 text-[180px] drop-shadow-2xl"></i>
                    </div>
                    {{-- Floating cards --}}
                    <div class="absolute -top-6 -left-8 glass rounded-2xl p-4 shadow-xl animate-fade-in-up" style="animation-delay:1s">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gold-500 rounded-xl flex items-center justify-center">
                                <i class="bx bx-check-shield text-white text-xl"></i>
                            </div>
                            <div>
                                <div class="text-white font-bold text-sm">Uji KIR Online</div>
                                <div class="text-blue-200 text-xs">Daftar Sekarang</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-8 glass rounded-2xl p-4 shadow-xl animate-fade-in-up" style="animation-delay:1.2s">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center">
                                <i class="bx bx-map-pin text-white text-xl"></i>
                            </div>
                            <div>
                                <div class="text-white font-bold text-sm">Trayek Angkutan</div>
                                <div class="text-blue-200 text-xs">Perizinan Online</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave Bottom --}}
    <div class="wave-bottom">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

{{-- ============================================================ LAYANAN SECTION ============================================================ --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14 reveal">
            <span class="badge-gold uppercase tracking-wider mb-3 inline-block">Layanan Kami</span>
            <h2 class="section-title">Layanan Unggulan Dishub</h2>
            <p class="section-subtitle">Kami menyediakan berbagai layanan publik terkait transportasi dan perhubungan untuk masyarakat Kota Palu.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($layanan as $index => $item)
            <div class="card p-6 group reveal" style="animation-delay: {{ $index * 0.1 }}s">
                <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-primary-700 transition-colors duration-300">
                    <i class="{{ $item->ikon }} text-primary-700 text-2xl group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $item->nama }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $item->deskripsi }}</p>
                @if($item->url)
                <a href="{{ $item->url }}" class="text-primary-700 font-semibold text-sm flex items-center gap-1 hover:gap-2 transition-all duration-200">
                    Selengkapnya <i class="bx bx-arrow-back rotate-180"></i>
                </a>
                @endif
            </div>
            @empty
            <div class="col-span-3 text-center py-10 text-gray-400">
                <i class="bx bx-cog text-5xl mb-3"></i>
                <p>Belum ada layanan yang ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-10 reveal">
            <a href="{{ route('layanan') }}" class="btn-outline">
                <i class="bx bx-grid-alt"></i> Lihat Semua Layanan
            </a>
        </div>
    </div>
</section>

{{-- ============================================================ STATISTIK SECTION ============================================================ --}}
<section class="py-16 hero-gradient relative overflow-hidden">
    <div class="absolute inset-0 dots-bg opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon' => 'bx bx-news', 'count' => $stats['berita'], 'label' => 'Berita & Artikel', 'suffix' => ''],
                ['icon' => 'bx bx-cog', 'count' => $stats['layanan'], 'label' => 'Jenis Layanan', 'suffix' => ''],
                ['icon' => 'bx bx-images', 'count' => $stats['galeri'], 'label' => 'Foto Galeri', 'suffix' => ''],
                ['icon' => 'bx bx-bell', 'count' => $stats['pengumuman'], 'label' => 'Pengumuman Aktif', 'suffix' => ''],
            ] as $stat)
            <div class="text-center reveal">
                <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/20">
                    <i class="{{ $stat['icon'] }} text-gold-400 text-3xl"></i>
                </div>
                <div class="text-4xl font-extrabold text-white mb-1">
                    <span data-count="{{ $stat['count'] }}" data-suffix="{{ $stat['suffix'] }}">0</span>+
                </div>
                <div class="text-blue-200 text-sm font-medium">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================ BERITA TERBARU ============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 gap-4">
            <div class="reveal">
                <span class="badge-blue uppercase tracking-wider mb-3 inline-block">Informasi Terkini</span>
                <h2 class="section-title text-left">Berita & Artikel Terbaru</h2>
            </div>
            <a href="{{ route('berita.index') }}" class="btn-outline shrink-0 reveal">
                <i class="bx bx-right-arrow-alt"></i> Semua Berita
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($berita as $index => $item)
            <article class="card group overflow-hidden reveal" style="animation-delay: {{ $index * 0.15 }}s">
                <div class="relative overflow-hidden">
                    @if($item->thumbnail)
                        <img src="{{ asset('storage/'.$item->thumbnail) }}" alt="{{ $item->judul }}"
                             class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-52 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                            <i class="bx bx-news text-primary-300 text-6xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="badge-blue">{{ $item->kategori }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 text-gray-400 text-xs mb-3">
                        <i class="bx bx-calendar"></i>
                        <span>{{ optional($item->published_at)->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base leading-snug mb-2 group-hover:text-primary-700 transition-colors line-clamp-2">
                        {{ $item->judul }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $item->ringkasan }}</p>
                    <a href="{{ route('berita.show', $item->slug) }}" class="text-primary-700 font-semibold text-sm flex items-center gap-1 hover:gap-2 transition-all duration-200">
                        Baca Selengkapnya <i class="bx bx-arrow-back rotate-180"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">
                <i class="bx bx-news text-6xl mb-3"></i>
                <p>Belum ada berita yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ============================================================ PENGUMUMAN & CTA ============================================================ --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Pengumuman --}}
            <div class="reveal">
                <span class="badge-gold uppercase tracking-wider mb-3 inline-block">Terbaru</span>
                <h2 class="text-2xl font-bold text-primary-900 mb-6">Pengumuman Resmi</h2>
                <div class="space-y-4">
                    @forelse($pengumuman as $p)
                    <div class="card p-5 flex gap-4 items-start group hover:border-l-4 hover:border-primary-700 transition-all duration-200">
                        <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-primary-700 transition-colors duration-300">
                            <i class="bx bx-bell text-primary-700 group-hover:text-white transition-colors duration-300 text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900 text-sm leading-snug line-clamp-2 mb-1">{{ $p->judul }}</h3>
                            <div class="text-xs text-gray-400 flex items-center gap-1.5">
                                <i class="bx bx-calendar"></i>
                                {{ optional($p->tanggal_terbit)->format('d M Y') }}
                                @if($p->tanggal_berakhir)
                                    <span>s/d {{ optional($p->tanggal_berakhir)->format('d M Y') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card p-8 text-center text-gray-400">
                        <i class="bx bx-bell-off text-4xl mb-2"></i>
                        <p>Belum ada pengumuman aktif.</p>
                    </div>
                    @endforelse
                    <a href="{{ route('pengumuman') }}" class="text-primary-700 font-semibold text-sm flex items-center gap-1 hover:gap-2 transition-all duration-200 mt-2">
                        Lihat Semua Pengumuman <i class="bx bx-arrow-back rotate-180"></i>
                    </a>
                </div>
            </div>

            {{-- CTA Card --}}
            <div class="reveal">
                <div class="hero-gradient rounded-3xl p-8 h-full flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-gold-500/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-gold-500 rounded-2xl flex items-center justify-center mb-5">
                            <i class="bx bx-headphone text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">Butuh Bantuan?</h3>
                        <p class="text-blue-200 text-sm leading-relaxed mb-6">
                            Tim kami siap membantu Anda. Hubungi kami melalui telepon, email, atau kunjungi langsung kantor Dinas Perhubungan Kota Palu.
                        </p>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center gap-3 bg-white/10 rounded-xl p-3">
                                <i class="bx bx-phone text-gold-400 text-xl"></i>
                                <div>
                                    <div class="text-white font-semibold text-sm">(0451) 421-234</div>
                                    <div class="text-blue-200 text-xs">Telepon Kantor</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 bg-white/10 rounded-xl p-3">
                                <i class="bx bxl-whatsapp text-gold-400 text-xl"></i>
                                <div>
                                    <div class="text-white font-semibold text-sm">0812-3456-7890</div>
                                    <div class="text-blue-200 text-xs">WhatsApp</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('kontak') }}" class="relative z-10 btn-gold w-full justify-center">
                        <i class="bx bx-send"></i> Kirim Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ GALERI SECTION ============================================================ --}}
@if($galeri->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14 reveal">
            <span class="badge-blue uppercase tracking-wider mb-3 inline-block">Dokumentasi</span>
            <h2 class="section-title">Galeri Kegiatan</h2>
            <p class="section-subtitle">Dokumentasi berbagai kegiatan dan program Dinas Perhubungan Kota Palu.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($galeri as $index => $foto)
            <div class="relative group rounded-2xl overflow-hidden aspect-video reveal" style="animation-delay: {{ $index * 0.08 }}s">
                <img src="{{ asset('storage/'.$foto->foto) }}" alt="{{ $foto->judul }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-primary-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end p-4">
                    <p class="text-white font-semibold text-sm">{{ $foto->judul }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10 reveal">
            <a href="{{ route('galeri') }}" class="btn-outline">
                <i class="bx bx-images"></i> Lihat Semua Foto
            </a>
        </div>
    </div>
</section>
@endif

@endsection
