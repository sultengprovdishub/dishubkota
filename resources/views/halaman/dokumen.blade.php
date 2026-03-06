@extends('layouts.app')
@section('title', 'Dokumen & Unduhan')
@section('content')

    <div class="hero-gradient relative py-20 overflow-hidden">
        <div class="absolute inset-0 dots-bg opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <i class="bx bx-chevron-right"></i> <span class="text-white">Dokumen</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 animate-fade-in-down">Dokumen & Unduhan</h1>
            <p class="text-blue-200 text-lg">Dokumen dan formulir resmi yang dapat diunduh</p>
        </div>
        <div class="wave-bottom">
            <svg viewBox="0 0 1440 50" fill="none" preserveAspectRatio="none">
                <path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z" fill="#f9fafb" />
            </svg>
        </div>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            {{-- Filter Kategori --}}
            <div class="card p-4 mb-8 flex flex-wrap items-center gap-3 reveal">
                <span class="text-sm font-semibold text-gray-600 flex items-center gap-1.5">
                    <i class="bx bx-filter-alt text-primary-700"></i> Filter:
                </span>
                <a href="{{ route('dokumen') }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ !request('kategori') ? 'bg-primary-700 text-white shadow-md' : 'bg-white border border-gray-200 text-gray-600 hover:border-primary-700 hover:text-primary-700' }}">
                    Semua
                </a>
                @foreach($kategori as $kat)
                    <a href="{{ route('dokumen', ['kategori' => $kat]) }}"
                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request('kategori') === $kat ? 'bg-primary-700 text-white shadow-md' : 'bg-white border border-gray-200 text-gray-600 hover:border-primary-700 hover:text-primary-700' }}">
                        {{ $kat }}
                    </a>
                @endforeach
            </div>

            {{-- List Dokumen --}}
            <div class="space-y-4">
                @forelse($dokumen as $index => $item)
                    <div class="card p-5 group hover:border-l-4 hover:border-primary-700 transition-all duration-200 reveal"
                        style="animation-delay: {{ $index * 0.08 }}s">
                        <div class="flex items-center gap-5">
                            <div
                                class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-primary-700 transition-colors duration-300">
                                <i
                                    class="bx bx-file-pdf text-primary-700 group-hover:text-white text-2xl transition-colors duration-300"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="badge-blue text-xs">{{ $item->kategori }}</span>
                                </div>
                                <h3 class="font-bold text-gray-900 leading-snug">{{ $item->judul }}</h3>
                                @if($item->keterangan)
                                    <p class="text-gray-500 text-sm mt-1 line-clamp-1">{{ $item->keterangan }}</p>
                                @endif
                                <div class="text-xs text-gray-400 flex items-center gap-3 mt-1">
                                    <span class="flex items-center gap-1"><i class="bx bx-calendar"></i>
                                        {{ optional($item->created_at)->format('d M Y') }}</span>
                                    <span class="flex items-center gap-1"><i class="bx bx-download"></i>
                                        {{ number_format($item->unduhan) }} unduhan</span>
                                </div>
                            </div>
                            <a href="{{ route('dokumen.unduh', $item->id) }}" class="btn-primary shrink-0 py-2.5 px-5 text-sm">
                                <i class="bx bx-download"></i>
                                <span class="hidden sm:inline">Unduh</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="card p-16 text-center text-gray-400">
                        <i class="bx bx-folder-open text-7xl mb-4"></i>
                        <h3 class="font-semibold text-xl mb-2">Belum Ada Dokumen</h3>
                        <p>Belum ada dokumen yang tersedia{{ request('kategori') ? ' untuk kategori ini' : '' }}.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-10 flex justify-center">{{ $dokumen->links() }}</div>
        </div>
    </section>
@endsection