@extends('layouts.app')
@section('title', 'Layanan')
@section('content')

<div class="hero-gradient relative py-20 overflow-hidden">
    <div class="absolute inset-0 dots-bg opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
            <i class="bx bx-chevron-right"></i> <span class="text-white">Layanan</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 animate-fade-in-down">Layanan Kami</h1>
        <p class="text-blue-200 text-lg">Layanan publik Dinas Perhubungan Kota Palu</p>
    </div>
    <div class="wave-bottom">
        <svg viewBox="0 0 1440 50" fill="none" preserveAspectRatio="none"><path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z" fill="white"/></svg>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($layanan as $index => $item)
            <div class="card p-7 group reveal" style="animation-delay: {{ $index * 0.1 }}s">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-50 to-primary-100 rounded-2xl flex items-center justify-center mb-5 group-hover:from-primary-700 group-hover:to-primary-900 transition-all duration-300 shadow-card">
                    <i class="{{ $item->ikon }} text-primary-700 text-3xl group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-xl mb-3">{{ $item->nama }}</h3>
                <p class="text-gray-500 leading-relaxed text-sm mb-5">{{ $item->deskripsi }}</p>
                <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                    @if($item->url)
                        <a href="{{ $item->url }}" class="text-primary-700 font-semibold text-sm flex items-center gap-1 hover:gap-2 transition-all">
                            Ajukan <i class="bx bx-arrow-back rotate-180"></i>
                        </a>
                    @else
                        <a href="{{ route('kontak') }}" class="text-primary-700 font-semibold text-sm flex items-center gap-1 hover:gap-2 transition-all">
                            Hubungi Kami <i class="bx bx-arrow-back rotate-180"></i>
                        </a>
                    @endif
                    <span class="badge-blue">Layanan Publik</span>
                </div>
            </div>
            @empty
            <div class="col-span-3 card p-16 text-center text-gray-400">
                <i class="bx bx-cog text-6xl mb-4"></i>
                <p>Belum ada layanan yang ditambahkan.</p>
            </div>
            @endforelse
        </div>

        {{-- Prosedur --}}
        <div class="mt-20 reveal">
            <div class="text-center mb-12">
                <span class="badge-gold uppercase tracking-wider mb-3 inline-block">Panduan</span>
                <h2 class="section-title">Prosedur Pengajuan Layanan</h2>
                <p class="section-subtitle">Ikuti langkah-langkah berikut untuk mengajukan layanan kepada Dinas Perhubungan Kota Palu.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['step' => '01', 'icon' => 'bx bx-file', 'title' => 'Siapkan Dokumen', 'desc' => 'Lengkapi berkas persyaratan yang dibutuhkan sesuai jenis layanan.'],
                    ['step' => '02', 'icon' => 'bx bx-buildings', 'title' => 'Datang ke Kantor', 'desc' => 'Kunjungi kantor Dishub Kota Palu atau daftar secara online.'],
                    ['step' => '03', 'icon' => 'bx bx-check-circle', 'title' => 'Verifikasi Berkas', 'desc' => 'Berkas Anda akan diverifikasi oleh petugas yang berwenang.'],
                    ['step' => '04', 'icon' => 'bx bx-award', 'title' => 'Terima Izin', 'desc' => 'Izin/dokumen akan diterbitkan sesuai ketentuan yang berlaku.'],
                ] as $step)
                <div class="relative card p-6 text-center reveal">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-gold-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                        {{ $step['step'] }}
                    </div>
                    <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center mx-auto mt-4 mb-4">
                        <i class="{{ $step['icon'] }} text-primary-700 text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ $step['title'] }}</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA Kontak --}}
        <div class="mt-16 hero-gradient rounded-3xl p-10 text-center relative overflow-hidden reveal">
            <div class="absolute inset-0 dots-bg opacity-20"></div>
            <div class="relative z-10">
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">Butuh Informasi Lebih Lanjut?</h3>
                <p class="text-blue-200 mb-6 max-w-xl mx-auto">Hubungi tim kami untuk mendapatkan panduan dan informasi terkait layanan Dinas Perhubungan Kota Palu.</p>
                <a href="{{ route('kontak') }}" class="btn-gold">
                    <i class="bx bx-phone-call"></i> Hubungi Kami Sekarang
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
