<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dinas Perhubungan Kota Palu') | Dishub Kota Palu</title>
    <meta name="description"
        content="@yield('description', 'Website resmi Dinas Perhubungan Kota Palu - Melayani dengan sepenuh hati untuk transportasi yang lebih baik.')">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-dishub.png') }}" @vite(['resources/css/app.css', 'resources/js/app.js']) @stack('styles') </head>

<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- Topbar Informasi --}}
    <div class="bg-primary-900 text-white text-xs py-2 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-1.5"><i class="bx bx-phone"></i> (0451) 421-234</span>
                <span class="flex items-center gap-1.5"><i class="bx bx-envelope"></i> dishub@palukota.go.id</span>
                <span class="flex items-center gap-1.5"><i class="bx bx-time"></i> Sen-Kam: 08.00-16.00 | Jum:
                    08.00-11.00</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="#" class="hover:text-gold-400 transition-colors"><i class="bx bxl-facebook text-base"></i></a>
                <a href="#" class="hover:text-gold-400 transition-colors"><i class="bx bxl-instagram text-base"></i></a>
                <a href="#" class="hover:text-gold-400 transition-colors"><i class="bx bxl-youtube text-base"></i></a>
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 30)"
        :class="scrolled ? 'shadow-lg bg-white/95 backdrop-blur-md' : 'bg-white shadow-sm'"
        class="sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18 py-3">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    {{-- Logo Kota Palu --}}
                    @if(file_exists(public_path('images/logo-kota-palu.png')))
                        <img src="{{ asset('images/logo-kota-palu.png') }}" alt="Logo Kota Palu"
                            style="height:42px;width:42px;object-fit:contain;flex-shrink:0;">
                    @else
                        <div
                            class="w-11 h-11 bg-gradient-to-br from-primary-700 to-primary-900 rounded-xl flex items-center justify-center shadow-md">
                            <i class="bx bx-shield text-white text-xl"></i>
                        </div>
                    @endif
                    {{-- Divider --}}
                    <div class="w-px h-9 bg-gray-200 hidden sm:block"></div>
                    {{-- Logo Dishub --}}
                    @if(file_exists(public_path('images/logo-dishub.png')))
                        <img src="{{ asset('images/logo-dishub.png') }}" alt="Logo Dishub"
                            style="height:42px;width:42px;object-fit:contain;flex-shrink:0;">
                    @else
                        <div
                            class="w-11 h-11 bg-gradient-to-br from-blue-700 to-blue-900 rounded-xl flex items-center justify-center shadow-md">
                            <i class="bx bx-bus text-white text-xl"></i>
                        </div>
                    @endif
                    {{-- Teks --}}
                    <div class="hidden sm:block">
                        <div class="font-bold text-primary-900 text-sm leading-tight">DINAS PERHUBUNGAN</div>
                        <div class="text-gold-600 font-semibold text-xs">KOTA PALU</div>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('home') ? 'text-primary-700 bg-primary-50' : '' }}">Beranda</a>
                    <a href="{{ route('profil') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('profil') ? 'text-primary-700 bg-primary-50' : '' }}">Profil</a>
                    <a href="{{ route('layanan') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('layanan') ? 'text-primary-700 bg-primary-50' : '' }}">Layanan</a>
                    <a href="{{ route('trayek') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('trayek') ? 'text-primary-700 bg-primary-50' : '' }}">Trayek
                        Bus</a>
                    <a href="{{ route('berita.index') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('berita*') ? 'text-primary-700 bg-primary-50' : '' }}">Berita</a>
                    <a href="{{ route('pengumuman') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('pengumuman') ? 'text-primary-700 bg-primary-50' : '' }}">Pengumuman</a>
                    <a href="{{ route('galeri') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('galeri') ? 'text-primary-700 bg-primary-50' : '' }}">Galeri</a>
                    <a href="{{ route('dokumen') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('dokumen') ? 'text-primary-700 bg-primary-50' : '' }}">Dokumen</a>
                    <a href="{{ route('kontak') }}"
                        class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs('kontak') ? 'text-primary-700 bg-primary-50' : '' }}">Kontak</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary ml-3 py-2 px-5 text-sm">
                            <i class="bx bx-shield-quarter"></i> Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="ml-3 flex items-center gap-1.5 px-4 py-2 text-primary-700 font-semibold rounded-lg hover:bg-primary-50 transition-colors text-sm">
                            <i class="bx bx-lock-open-alt"></i> Login
                        </a>
                    @endauth
                </div>

                {{-- Mobile Hamburger --}}
                <button @click="open = !open"
                    class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                    <i :class="open ? 'bx bx-x' : 'bx bx-menu'" class="text-2xl"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden bg-white border-t border-gray-100 shadow-lg px-4 py-4 space-y-1">
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-home text-lg"></i> Beranda
            </a>
            <a href="{{ route('profil') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-building text-lg"></i> Profil
            </a>
            <a href="{{ route('layanan') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-cog text-lg"></i> Layanan
            </a>
            <a href="{{ route('trayek') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-bus text-lg"></i> Trayek Bus
            </a>
            <a href="{{ route('berita.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-news text-lg"></i> Berita
            </a>
            <a href="{{ route('pengumuman') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-bell text-lg"></i> Pengumuman
            </a>
            <a href="{{ route('galeri') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-images text-lg"></i> Galeri
            </a>
            <a href="{{ route('dokumen') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-file text-lg"></i> Dokumen
            </a>
            <a href="{{ route('kontak') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-700 font-medium transition-colors">
                <i class="bx bx-phone text-lg"></i> Kontak
            </a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn-primary mt-2 w-full justify-center">
                    <i class="bx bx-shield-quarter"></i> Panel Admin
                </a>
            @endauth
        </div>
    </nav>

    {{-- Running Text Pengumuman --}}
    @hasSection('no-ticker')
    @else
        <div class="bg-primary-700 text-white py-2 overflow-hidden hidden md:block">
            <div class="flex items-center max-w-full">
                <div class="bg-gold-500 text-white font-bold px-4 py-1 text-xs shrink-0 flex items-center gap-1.5 mr-4">
                    <i class="bx bx-bell text-sm"></i> PENGUMUMAN
                </div>
                <div class="ticker-wrapper flex-1">
                    <div class="ticker-content text-sm gap-8">
                        <span class="mr-16">🚌 Jadwal pelayanan Dishub Kota Palu: Senin-Kamis 08.00-16.00 WITA | Jumat
                            08.00-11.00 WITA</span>
                        <span class="mr-16">📋 Pendaftaran Izin Usaha Angkutan batch II 2026 dibuka — segera daftarkan usaha
                            Anda</span>
                        <span class="mr-16">🔧 Uji KIR Kendaraan periode Maret 2026 — pastikan kendaraan Anda dalam kondisi
                            laik jalan</span>
                        <span class="mr-16">📞 Hotline Dishub Kota Palu: (0451) 421-234 | WhatsApp: 0812-3456-7890</span>
                        <span class="mr-16">🚌 Jadwal pelayanan Dishub Kota Palu: Senin-Kamis 08.00-16.00 WITA | Jumat
                            08.00-11.00 WITA</span>
                        <span class="mr-16">📋 Pendaftaran Izin Usaha Angkutan batch II 2026 dibuka — segera daftarkan usaha
                            Anda</span>
                        <span class="mr-16">🔧 Uji KIR Kendaraan periode Maret 2026 — pastikan kendaraan Anda dalam kondisi
                            laik jalan</span>
                        <span class="mr-16">📞 Hotline Dishub Kota Palu: (0451) 421-234 | WhatsApp: 0812-3456-7890</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-primary-950 text-gray-300">

        {{-- Footer Main --}}
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                {{-- Kolom 1: Brand --}}
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-5">
                        {{-- Logo Kota Palu (footer) --}}
                        @if(file_exists(public_path('images/logo-kota-palu.png')))
                            <img src="{{ asset('images/logo-kota-palu.png') }}" alt="Logo Kota Palu"
                                style="height:52px;width:52px;object-fit:contain;filter:drop-shadow(0 2px 4px rgba(0,0,0,.4));flex-shrink:0;">
                        @else
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-primary-700 to-primary-900 border border-primary-700 rounded-xl flex items-center justify-center">
                                <i class="bx bx-shield text-white text-3xl"></i>
                            </div>
                        @endif
                        {{-- Logo Dishub (footer) --}}
                        @if(file_exists(public_path('images/logo-dishub.png')))
                            <img src="{{ asset('images/logo-dishub.png') }}" alt="Logo Dishub"
                                style="height:52px;width:52px;object-fit:contain;filter:drop-shadow(0 2px 4px rgba(0,0,0,.4));flex-shrink:0;">
                        @else
                            <div
                                class="w-14 h-14 bg-white/10 border border-white/20 rounded-xl flex items-center justify-center">
                                <i class="bx bx-bus text-white text-3xl"></i>
                            </div>
                        @endif
                        <div>
                            <div class="font-bold text-white text-base leading-tight">DINAS PERHUBUNGAN</div>
                            <div class="text-gold-400 font-semibold text-sm">KOTA PALU</div>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-400 mb-5 max-w-sm">
                        Dinas Perhubungan Kota Palu berkomitmen memberikan pelayanan transportasi terbaik untuk
                        mewujudkan sistem transportasi yang aman, nyaman, dan berkelanjutan di Kota Palu.
                    </p>
                    <div class="flex gap-3 mb-5">
                        <a href="#"
                            class="w-9 h-9 bg-white/10 hover:bg-primary-700 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <i class="bx bxl-facebook text-lg"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 bg-white/10 hover:bg-primary-700 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <i class="bx bxl-instagram text-lg"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 bg-white/10 hover:bg-primary-700 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <i class="bx bxl-youtube text-lg"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 bg-white/10 hover:bg-primary-700 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <i class="bx bxl-twitter text-lg"></i>
                        </a>
                    </div>
                    {{-- Jam Pelayanan --}}
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="text-gold-400 font-semibold text-sm mb-2 flex items-center gap-1.5">
                            <i class="bx bx-time"></i> Jam Pelayanan
                        </div>
                        <div class="space-y-1 text-xs text-gray-400">
                            <div class="flex justify-between"><span>Senin – Kamis</span><span class="text-white">08.00 –
                                    16.00 WITA</span></div>
                            <div class="flex justify-between"><span>Jumat</span><span class="text-white">08.00 – 11.00
                                    WITA</span></div>
                            <div class="flex justify-between"><span>Sabtu – Minggu</span><span
                                    class="text-red-400">Tutup</span></div>
                        </div>
                    </div>
                </div>

                {{-- Kolom 2: Menu Cepat --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 flex items-center gap-2">
                        <span class="w-6 h-0.5 bg-gold-500"></span> Menu Cepat
                    </h4>
                    <ul class="space-y-2">
                        @foreach([['Beranda', 'home'], ['Profil Dinas', 'profil'], ['Layanan', 'layanan'], ['Berita & Artikel', 'berita.index'], ['Pengumuman', 'pengumuman'], ['Galeri', 'galeri'], ['Unduh Dokumen', 'dokumen'], ['Hubungi Kami', 'kontak']] as $menu)
                            <li>
                                <a href="{{ route($menu[1]) }}"
                                    class="text-gray-400 hover:text-gold-400 transition-colors duration-200 text-sm flex items-center gap-2">
                                    <i class="bx bx-chevron-right text-gold-500"></i> {{ $menu[0] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kolom 3: Kontak --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 flex items-center gap-2">
                        <span class="w-6 h-0.5 bg-gold-500"></span> Kontak Kami
                    </h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex gap-3">
                            <i class="bx bx-map-pin text-gold-500 mt-0.5 shrink-0 text-lg"></i>
                            <span>Jl. Mohammad Yamin No.2, Palu, Sulawesi Tengah 94111</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="bx bx-phone text-gold-500 shrink-0 text-lg"></i>
                            <span>(0451) 421-234</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="bx bxl-whatsapp text-gold-500 shrink-0 text-lg"></i>
                            <span>0812-3456-7890 (WhatsApp)</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="bx bx-envelope text-gold-500 shrink-0 text-lg"></i>
                            <span>dishub@palukota.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="border-t border-white/10">
            <div
                class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-500">
                <span>© {{ date('Y') }} Dinas Perhubungan Kota Palu. Hak Cipta Dilindungi.</span>
                <span>Dikembangkan dengan <span class="text-red-400">♥</span> oleh Tim IT Dishub Kota Palu</span>
            </div>
        </div>
    </footer>

    {{-- Back to Top Button --}}
    <button id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})"
        class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-primary-700 hover:bg-gold-500 text-white rounded-full shadow-lg hover:shadow-glow-blue transition-all duration-300 transform translate-y-20 opacity-0 flex items-center justify-center">
        <i class="bx bx-chevron-up text-2xl"></i>
    </button>

    <script>
        // Back to top button
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.remove('translate-y-20', 'opacity-0');
                backToTop.classList.add('translate-y-0', 'opacity-100');
            } else {
                backToTop.classList.add('translate-y-20', 'opacity-0');
                backToTop.classList.remove('translate-y-0', 'opacity-100');
            }
        });

        // Scroll Reveal (Intersection Observer)
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        reveals.forEach(el => observer.observe(el));

        // Counter animation
        function animateCounter(el, target) {
            let current = 0;
            const increment = Math.ceil(target / 60);
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                el.textContent = current.toLocaleString('id-ID') + (el.dataset.suffix || '');
            }, 30);
        }
        const counterObs = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    animateCounter(el, parseInt(el.dataset.count));
                    counterObs.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('[data-count]').forEach(el => counterObs.observe(el));
    </script>

    @stack('scripts')
</body>

</html>