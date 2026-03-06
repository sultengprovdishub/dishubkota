@extends('layouts.app')

@section('title', 'Profil Dinas')
@section('description', 'Profil Dinas Perhubungan Kota Palu - Visi, Misi, Tugas Pokok, dan Struktur Organisasi.')

@section('content')

{{-- Page Header --}}
<div class="hero-gradient relative py-20 overflow-hidden">
    <div class="absolute inset-0 dots-bg opacity-30"></div>
    <div class="absolute top-0 right-0 w-72 h-72 bg-gold-500/10 rounded-full blur-3xl"></div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="bx bx-chevron-right"></i>
            <span class="text-white">Profil Dinas</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 animate-fade-in-down">Profil Dinas</h1>
        <p class="text-blue-200 text-lg">Dinas Perhubungan Kota Palu</p>
    </div>
    <div class="wave-bottom">
        <svg viewBox="0 0 1440 50" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z" fill="#f9fafb"/>
        </svg>
    </div>
</div>

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Tentang --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
            <div class="reveal">
                <span class="badge-gold uppercase tracking-wider mb-3 inline-block">Tentang Kami</span>
                <h2 class="text-3xl font-bold text-primary-900 mb-5">Dinas Perhubungan<br>Kota Palu</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Dinas Perhubungan Kota Palu adalah unsur pelaksana pemerintah daerah yang menyelenggarakan urusan pemerintahan di bidang perhubungan. Bertugas merumuskan kebijakan teknis di bidang perhubungan, lalu lintas dan angkutan jalan, serta sarana dan prasarana transportasi.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Dengan komitmen tinggi terhadap pelayanan publik, Dinas Perhubungan Kota Palu terus berinovasi dalam menyediakan sistem transportasi yang aman, nyaman, tertib, dan berkelanjutan bagi seluruh lapisan masyarakat Kota Palu.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-2xl p-4 shadow-card text-center">
                        <div class="text-3xl font-extrabold text-primary-700 mb-1">15+</div>
                        <div class="text-sm text-gray-500">Tahun Berdiri</div>
                    </div>
                    <div class="bg-white rounded-2xl p-4 shadow-card text-center">
                        <div class="text-3xl font-extrabold text-gold-600 mb-1">50+</div>
                        <div class="text-sm text-gray-500">Pegawai Aktif</div>
                    </div>
                </div>
            </div>
            <div class="reveal">
                <div class="relative">
                    <div class="hero-gradient rounded-3xl p-10 flex items-center justify-center shadow-xl">
                        <i class="bx bx-bus text-white/70 text-[160px] drop-shadow-xl animate-float"></i>
                    </div>
                    <div class="absolute -bottom-5 -left-5 bg-white rounded-2xl p-5 shadow-card-hover border border-primary-100">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gold-500 rounded-xl flex items-center justify-center">
                                <i class="bx bx-trophy text-white text-2xl"></i>
                            </div>
                            <div>
                                <div class="font-bold text-primary-900">Pelayanan Prima</div>
                                <div class="text-xs text-gray-500">Penghargaan 2023</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Visi Misi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-20">
            <div class="card p-8 reveal border-l-4 border-primary-700">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-14 h-14 bg-primary-100 rounded-2xl flex items-center justify-center">
                        <i class="bx bx-target-lock text-primary-700 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-900">Visi</h3>
                </div>
                <p class="text-gray-700 leading-relaxed text-lg italic font-medium">
                    "Terwujudnya Sistem Transportasi Kota Palu yang Aman, Nyaman, Tertib, dan Berkelanjutan untuk Mendukung Palu sebagai Kota Jasa dan Perdagangan."
                </p>
            </div>
            <div class="card p-8 reveal border-l-4 border-gold-500">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-14 h-14 bg-gold-100 rounded-2xl flex items-center justify-center">
                        <i class="bx bx-list-check text-gold-600 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-primary-900">Misi</h3>
                </div>
                <ul class="space-y-3 text-gray-700">
                    @foreach([
                        'Meningkatkan kualitas pelayanan transportasi yang aman dan nyaman bagi masyarakat',
                        'Mengembangkan infrastruktur dan fasilitas transportasi yang memadai',
                        'Mewujudkan ketertiban dan keselamatan berlalu lintas',
                        'Meningkatkan kualitas SDM aparatur di bidang perhubungan',
                        'Mendorong inovasi dan teknologi dalam pengelolaan transportasi',
                    ] as $misi)
                    <li class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-gold-100 border border-gold-400 flex items-center justify-center shrink-0 mt-0.5">
                            <i class="bx bx-check text-gold-600 text-xs"></i>
                        </span>
                        <span class="text-sm leading-relaxed">{{ $misi }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Tugas & Fungsi --}}
        <div class="mb-20 reveal">
            <div class="text-center mb-10">
                <span class="badge-blue uppercase tracking-wider mb-3 inline-block">Tugas & Fungsi</span>
                <h2 class="section-title">Tugas Pokok & Fungsi</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach([
                    ['icon' => 'bx bx-file-find', 'judul' => 'Perumusan Kebijakan', 'isi' => 'Merumuskan kebijakan teknis di bidang perhubungan dan transportasi daerah.'],
                    ['icon' => 'bx bx-car', 'judul' => 'Lalu Lintas & Angkutan', 'isi' => 'Menyelenggarakan urusan lalu lintas dan angkutan jalan di wilayah Kota Palu.'],
                    ['icon' => 'bx bx-check-shield', 'judul' => 'Pengujian Kendaraan', 'isi' => 'Melaksanakan pengujian kelayakan kendaraan bermotor untuk keselamatan berlalu lintas.'],
                    ['icon' => 'bx bx-building', 'judul' => 'Sarana & Prasarana', 'isi' => 'Pengembangan dan pengelolaan sarana prasarana transportasi kota.'],
                    ['icon' => 'bx bx-book-open', 'judul' => 'Perizinan', 'isi' => 'Penerbitan izin usaha angkutan dan perizinan terkait transportasi lainnya.'],
                    ['icon' => 'bx bx-line-chart', 'judul' => 'Pengawasan & Evaluasi', 'isi' => 'Melakukan pengawasan, monitoring, dan evaluasi terhadap sistem transportasi kota.'],
                ] as $item)
                <div class="card p-6 group hover:border-l-4 hover:border-primary-700 transition-all duration-200 reveal">
                    <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary-700 transition-colors duration-300">
                        <i class="{{ $item['icon'] }} text-primary-700 group-hover:text-white text-xl transition-colors duration-300"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ $item['judul'] }}</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $item['isi'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Struktur Organisasi --}}
        <div class="reveal">
            <div class="text-center mb-10">
                <span class="badge-gold uppercase tracking-wider mb-3 inline-block">Organisasi</span>
                <h2 class="section-title">Struktur Organisasi</h2>
            </div>
            <div class="card p-8 overflow-x-auto">
                <div class="min-w-[640px]">
                    {{-- Kepala Dinas --}}
                    <div class="flex justify-center mb-6">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-primary-700 to-primary-900 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                <i class="bx bx-user text-white text-4xl"></i>
                            </div>
                            <div class="font-bold text-primary-900">Kepala Dinas</div>
                            <div class="text-sm text-gray-500 bg-gold-50 border border-gold-200 rounded-lg px-3 py-1 mt-1">Eselon II</div>
                        </div>
                    </div>
                    {{-- Garis --}}
                    <div class="flex justify-center mb-6"><div class="w-0.5 h-8 bg-primary-300"></div></div>
                    {{-- Sekretariat --}}
                    <div class="flex justify-center mb-6">
                        <div class="text-center bg-primary-50 border border-primary-200 rounded-2xl px-8 py-4">
                            <div class="w-10 h-10 bg-primary-700 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <i class="bx bx-briefcase text-white text-xl"></i>
                            </div>
                            <div class="font-bold text-primary-900 text-sm">Sekretariat</div>
                        </div>
                    </div>
                    <div class="flex justify-center mb-6"><div class="w-0.5 h-8 bg-primary-300"></div></div>
                    {{-- Bidang --}}
                    <div class="flex justify-around gap-4">
                        @foreach(['Bidang Lalu Lintas', 'Bidang Angkutan', 'Bidang Sarana Prasarana', 'Bidang UPTD PKB'] as $bidang)
                        <div class="text-center">
                            <div class="bg-white border-2 border-primary-200 rounded-xl px-4 py-3 hover:border-primary-700 hover:shadow-card transition-all duration-200">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <i class="bx bx-buildings text-primary-700 text-base"></i>
                                </div>
                                <div class="font-semibold text-primary-900 text-xs">{{ $bidang }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
