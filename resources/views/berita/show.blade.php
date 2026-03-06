@extends('layouts.app')
@section('title', $berita->judul)
@section('description', $berita->ringkasan)
@section('content')

    <div class="hero-gradient relative py-16 overflow-hidden">
        <div class="absolute inset-0 dots-bg opacity-30"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <i class="bx bx-chevron-right"></i>
                <a href="{{ route('berita.index') }}" class="hover:text-white">Berita</a>
                <i class="bx bx-chevron-right"></i>
                <span class="text-white line-clamp-1">{{ Str::limit($berita->judul, 40) }}</span>
            </div>
            <span class="badge-blue mb-4 inline-block">{{ $berita->kategori }}</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight animate-fade-in-down">
                {{ $berita->judul }}
            </h1>
            <div class="flex flex-wrap items-center gap-4 text-blue-200 text-sm mt-4">
                <span class="flex items-center gap-1.5">
                    <i class="bx bx-calendar"></i>
                    {{ optional($berita->published_at)->format('d M Y') }}
                </span>
                <span class="flex items-center gap-1.5">
                    <i class="bx bx-show"></i>
                    {{ number_format($berita->views) }} kali dilihat
                </span>
            </div>
        </div>
        <div class="wave-bottom">
            <svg viewBox="0 0 1440 50" fill="none" preserveAspectRatio="none">
                <path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z" fill="#f9fafb" />
            </svg>
        </div>
    </div>

    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Konten Berita --}}
                <div class="lg:col-span-2">
                    <div class="card overflow-hidden reveal">
                        @if($berita->thumbnail)
                            <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}"
                                class="w-full h-72 object-cover">
                        @endif
                        <div class="p-8">
                            @if($berita->ringkasan)
                                <p class="text-lg text-gray-600 font-medium leading-relaxed mb-6 pb-6 border-b border-gray-100">
                                    {{ $berita->ringkasan }}
                                </p>
                            @endif
                            <div
                                class="prose prose-lg max-w-none text-gray-700 leading-relaxed [&>p]:mb-4 [&>h2]:text-2xl [&>h2]:font-bold [&>h2]:text-primary-900 [&>h2]:mt-6 [&>h2]:mb-3 [&>ul]:list-disc [&>ul]:pl-6 [&>ol]:list-decimal [&>ol]:pl-6">
                                {!! $berita->konten !!}
                            </div>

                            {{-- Share --}}
                            <div
                                class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between flex-wrap gap-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-600 mr-1">Bagikan:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                        target="_blank"
                                        class="w-9 h-9 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center transition-colors">
                                        <i class="bx bxl-facebook text-lg"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($berita->judul) }}"
                                        target="_blank"
                                        class="w-9 h-9 bg-sky-500 hover:bg-sky-600 text-white rounded-lg flex items-center justify-center transition-colors">
                                        <i class="bx bxl-twitter text-lg"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . request()->url()) }}"
                                        target="_blank"
                                        class="w-9 h-9 bg-green-500 hover:bg-green-600 text-white rounded-lg flex items-center justify-center transition-colors">
                                        <i class="bx bxl-whatsapp text-lg"></i>
                                    </a>
                                    <span
                                        class="ml-2 flex items-center gap-1 text-xs text-gray-400 bg-gray-100 px-3 py-1.5 rounded-full">
                                        <i class="bx bx-show"></i> {{ number_format($berita->views) }} pembaca
                                    </span>
                                </div>
                                <a href="{{ route('berita.index') }}" class="btn-outline text-sm py-2 px-4">
                                    <i class="bx bx-arrow-back"></i> Kembali ke Berita
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar Berita Lainnya --}}
                <div class="space-y-5 reveal">
                    <h3 class="font-bold text-primary-900 text-xl">Berita Lainnya</h3>
                    @foreach($lainnya as $item)
                        <div class="card p-4 group">
                            <div class="flex gap-3">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}"
                                        class="w-20 h-16 rounded-xl object-cover shrink-0">
                                @else
                                    <div class="w-20 h-16 rounded-xl bg-primary-50 flex items-center justify-center shrink-0">
                                        <i class="bx bx-news text-primary-300 text-2xl"></i>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('berita.show', $item->slug) }}"
                                        class="font-semibold text-gray-900 text-sm leading-snug line-clamp-2 group-hover:text-primary-700 transition-colors">
                                        {{ $item->judul }}
                                    </a>
                                    <div class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                        <i class="bx bx-calendar"></i>
                                        {{ optional($item->published_at)->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Banner Kontak --}}
                    <div class="hero-gradient rounded-2xl p-6 text-center">
                        <i class="bx bx-headphone text-gold-400 text-4xl mb-3"></i>
                        <h4 class="font-bold text-white mb-2">Butuh Bantuan?</h4>
                        <p class="text-blue-200 text-xs mb-4">Hubungi tim kami untuk informasi lebih lanjut.</p>
                        <a href="{{ route('kontak') }}" class="btn-gold text-sm py-2 px-5">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection