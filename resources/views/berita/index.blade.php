@extends('layouts.app')
@section('title', 'Berita & Artikel')
@section('content')

    <div class="hero-gradient relative py-20 overflow-hidden">
        <div class="absolute inset-0 dots-bg opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <i class="bx bx-chevron-right"></i> <span class="text-white">Berita</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 animate-fade-in-down">Berita & Artikel</h1>
            <p class="text-blue-200 text-lg">Informasi terkini dari Dinas Perhubungan Kota Palu</p>
        </div>
        <div class="wave-bottom">
            <svg viewBox="0 0 1440 50" fill="none" preserveAspectRatio="none">
                <path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z" fill="#f9fafb" />
            </svg>
        </div>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            {{-- Search & Filter --}}
            <form method="GET" action="{{ route('berita.index') }}"
                class="card p-4 mb-10 flex flex-col sm:flex-row gap-3 reveal">
                <div class="relative flex-1">
                    <i class="bx bx-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari berita..."
                        class="input-field pl-10">
                </div>
                <select name="kategori" class="input-field sm:w-48">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary shrink-0">
                    <i class="bx bx-search"></i> Cari
                </button>
                @if(request('cari') || request('kategori'))
                    <a href="{{ route('berita.index') }}" class="btn-outline shrink-0">Reset</a>
                @endif
            </form>

            {{-- Grid Berita --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($berita as $index => $item)
                    <article class="card group overflow-hidden reveal" style="animation-delay: {{ ($index % 6) * 0.1 }}s">
                        <div class="relative overflow-hidden">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}"
                                    class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-52 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <i class="bx bx-news text-primary-300 text-7xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="badge-blue">{{ $item->kategori }}</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-gray-400 text-xs mb-3">
                                <i class="bx bx-calendar"></i>
                                <span>{{ optional($item->published_at)->translatedFormat('d M Y') }}</span>
                            </div>
                            <h2
                                class="font-bold text-gray-900 text-base leading-snug mb-2 group-hover:text-primary-700 transition-colors line-clamp-2">
                                {{ $item->judul }}
                            </h2>
                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $item->ringkasan }}</p>
                            <a href="{{ route('berita.show', $item->slug) }}"
                                class="text-primary-700 font-semibold text-sm flex items-center gap-1 hover:gap-2 transition-all">
                                Baca Selengkapnya <i class="bx bx-arrow-back rotate-180"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 card p-16 text-center text-gray-400">
                        <i class="bx bx-news text-7xl mb-4"></i>
                        <h3 class="font-semibold text-xl mb-2">Tidak Ada Berita</h3>
                        <p>{{ request('cari') ? 'Tidak ditemukan berita untuk pencarian tersebut.' : 'Belum ada berita yang dipublikasikan.' }}
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 flex justify-center">{{ $berita->links() }}</div>
        </div>
    </section>
@endsection