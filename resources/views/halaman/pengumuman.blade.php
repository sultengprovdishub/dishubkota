@extends('layouts.app')
@section('title', 'Pengumuman')
@section('content')

    <div class="hero-gradient relative py-20 overflow-hidden">
        <div class="absolute inset-0 dots-bg opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <i class="bx bx-chevron-right"></i> <span class="text-white">Pengumuman</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 animate-fade-in-down">Pengumuman Resmi</h1>
            <p class="text-blue-200 text-lg">Informasi dan pengumuman resmi Dinas Perhubungan Kota Palu</p>
        </div>
        <div class="wave-bottom">
            <svg viewBox="0 0 1440 50" fill="none" preserveAspectRatio="none">
                <path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z" fill="#f9fafb" />
            </svg>
        </div>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            @forelse($pengumuman as $index => $item)
                <div class="card p-6 mb-5 group reveal" style="animation-delay: {{ $index * 0.1 }}s" x-data="{ open: false }">
                    <div class="flex items-start gap-5">
                        <div
                            class="w-14 h-14 bg-primary-50 rounded-2xl flex flex-col items-center justify-center shrink-0 group-hover:bg-primary-700 transition-colors duration-300 border border-primary-100">
                            <i
                                class="bx bx-bell text-primary-700 group-hover:text-white text-2xl transition-colors duration-300"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                <span class="badge-{{ $item->status === 'aktif' ? 'green' : 'blue' }}">
                                    {{ $item->status === 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <i class="bx bx-calendar"></i>
                                    {{ optional($item->tanggal_terbit)->format('d M Y') }}
                                    @if($item->tanggal_berakhir)
                                        <span>— {{ optional($item->tanggal_berakhir)->format('d M Y') }}</span>
                                    @endif
                                </span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg leading-snug mb-3">{{ $item->judul }}</h3>
                            <div class="text-gray-600 text-sm leading-relaxed" :class="open ? '' : 'line-clamp-2'">
                                {!! nl2br(e($item->konten)) !!}
                            </div>
                            <div class="flex items-center gap-4 mt-3">
                                <button @click="open = !open"
                                    class="text-primary-700 font-semibold text-sm flex items-center gap-1 hover:gap-2 transition-all">
                                    <span x-text="open ? 'Tutup' : 'Baca Selengkapnya'"></span>
                                    <i :class="open ? 'bx bx-chevron-up' : 'bx bx-chevron-down'"></i>
                                </button>
                                @if($item->file_lampiran)
                                    <a href="{{ asset('storage/' . $item->file_lampiran) }}" download
                                        class="text-gold-600 font-semibold text-sm flex items-center gap-1 hover:text-gold-700">
                                        <i class="bx bx-download"></i> Unduh Lampiran
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card p-16 text-center text-gray-400">
                    <i class="bx bx-bell-off text-7xl mb-4"></i>
                    <h3 class="font-semibold text-xl mb-2">Belum Ada Pengumuman</h3>
                    <p>Saat ini belum ada pengumuman yang aktif.</p>
                </div>
            @endforelse

            <div class="mt-8 flex justify-center">{{ $pengumuman->links() }}</div>
        </div>
    </section>
@endsection