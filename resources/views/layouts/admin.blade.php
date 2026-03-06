<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Dishub Kota Palu</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-dishub.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="h-full bg-gray-100 antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-full min-h-screen">

        {{-- Sidebar Overlay (Mobile) --}}
        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" @click="sidebarOpen = false"
            class="fixed inset-0 z-30 bg-black/50 lg:hidden"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-primary-950 to-primary-900 transform transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 flex flex-col shadow-2xl">

            {{-- Logo --}}
            <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10">
                <img src="{{ asset('images/logo-kota-palu.png') }}" alt="Logo Kota Palu"
                    class="w-9 h-9 object-contain shrink-0 drop-shadow-lg">
                <img src="{{ asset('images/logo-dishub.png') }}" alt="Logo Dishub"
                    class="w-10 h-10 object-contain shrink-0 drop-shadow-lg">
                <div>
                    <div class="text-white font-bold text-xs leading-tight">ADMIN DISHUB</div>
                    <div class="text-gold-400 text-xs font-medium">Kota Palu</div>
                </div>
            </div>

            {{-- User Info --}}
            <div class="px-5 py-4 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                        <i class="bx bx-user text-white text-lg"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-white font-semibold text-sm truncate">{{ auth()->user()->name }}</div>
                        <div class="text-blue-300 text-xs truncate">{{ auth()->user()->email }}</div>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-1">
                <div class="text-xs font-semibold text-blue-400 uppercase tracking-wider px-2 mb-2">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-home-alt text-xl"></i> Dashboard
                </a>

                <div class="text-xs font-semibold text-blue-400 uppercase tracking-wider px-2 mt-4 mb-2">Konten</div>

                <a href="{{ route('admin.berita.index') }}"
                    class="{{ request()->routeIs('admin.berita*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-news text-xl"></i> Berita
                </a>
                <a href="{{ route('admin.pengumuman.index') }}"
                    class="{{ request()->routeIs('admin.pengumuman*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-bell text-xl"></i> Pengumuman
                </a>
                <a href="{{ route('admin.galeri.index') }}"
                    class="{{ request()->routeIs('admin.galeri*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-images text-xl"></i> Galeri
                </a>

                <div class="text-xs font-semibold text-blue-400 uppercase tracking-wider px-2 mt-4 mb-2">Pengelolaan
                </div>

                <a href="{{ route('admin.layanan.index') }}"
                    class="{{ request()->routeIs('admin.layanan*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-cog text-xl"></i> Layanan
                </a>
                <a href="{{ route('admin.dokumen.index') }}"
                    class="{{ request()->routeIs('admin.dokumen*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-file text-xl"></i> Dokumen
                </a>

                @php $pesanBaru = \App\Models\KontakPesan::where('dibaca', false)->count(); @endphp
                <a href="{{ route('admin.kontak.index') }}"
                    class="{{ request()->routeIs('admin.kontak*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }} relative">
                    <i class="bx bx-envelope text-xl"></i> Pesan Masuk
                    @if($pesanBaru > 0)
                        <span
                            class="absolute right-2 top-2 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">{{ $pesanBaru }}</span>
                    @endif
                </a>

                <div class="text-xs font-semibold text-blue-400 uppercase tracking-wider px-2 mt-4 mb-2">Trayek Bus
                </div>

                <a href="{{ route('admin.koridor.index') }}"
                    class="{{ request()->routeIs('admin.koridor*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-building text-xl"></i> Koridor
                </a>
                <a href="{{ route('admin.halte.index') }}"
                    class="{{ request()->routeIs('admin.halte*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-map-pin text-xl"></i> Halte
                </a>
                <a href="{{ route('admin.spesifikasi-bus.index') }}"
                    class="{{ request()->routeIs('admin.spesifikasi-bus*') ? 'admin-sidebar-link-active' : 'admin-sidebar-link' }}">
                    <i class="bx bx-bus text-xl"></i> Spesifikasi Bus
                </a>
            </nav>


            {{-- Sidebar Footer --}}
            <div class="px-4 py-4 border-t border-white/10 space-y-2">
                <a href="{{ route('home') }}" target="_blank" class="admin-sidebar-link">
                    <i class="bx bx-globe text-xl"></i> Lihat Website
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="admin-sidebar-link w-full text-red-300 hover:text-red-200 hover:bg-red-500/20">
                        <i class="bx bx-log-out text-xl"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Topbar --}}
            <header class="bg-white border-b border-gray-200 sticky top-0 z-20 shadow-sm">
                <div class="flex items-center justify-between px-4 md:px-6 py-4">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                            <i class="bx bx-menu text-xl"></i>
                        </button>
                        <div>
                            <h1 class="font-bold text-gray-900 text-lg">@yield('page-title', 'Dashboard')</h1>
                            <div class="text-xs text-gray-400">
                                @yield('page-subtitle', 'Panel Admin Dinas Perhubungan Kota Palu')</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="hidden md:flex items-center gap-2 text-sm text-gray-500">
                            <i class="bx bx-calendar text-primary-600"></i>
                            {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                        </span>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div
                    class="mx-4 md:mx-6 mt-4 bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 flex items-center gap-3 text-sm animate-fade-in">
                    <i class="bx bx-check-circle text-green-500 text-xl shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div
                    class="mx-4 md:mx-6 mt-4 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 flex items-center gap-3 text-sm animate-fade-in">
                    <i class="bx bx-x-circle text-red-500 text-xl shrink-0"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Page Content --}}
            <main class="flex-1 p-4 md:p-6 overflow-y-auto">
                @yield('content')
            </main>

            {{-- Admin Footer --}}
            <footer class="border-t border-gray-200 bg-white px-6 py-3 text-xs text-gray-400 text-center">
                © {{ date('Y') }} Dinas Perhubungan Kota Palu — Panel Admin
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>

</html>