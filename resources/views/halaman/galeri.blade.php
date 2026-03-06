@extends('layouts.app')
@section('title', 'Galeri')
@section('content')

    <div class="hero-gradient relative py-20 overflow-hidden">
        <div class="absolute inset-0 dots-bg opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <i class="bx bx-chevron-right"></i> <span class="text-white">Galeri</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 animate-fade-in-down">Galeri Kegiatan</h1>
            <p class="text-blue-200 text-lg">Dokumentasi kegiatan Dinas Perhubungan Kota Palu</p>
        </div>
        <div class="wave-bottom">
            <svg viewBox="0 0 1440 50" fill="none" preserveAspectRatio="none">
                <path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z" fill="#f9fafb" />
            </svg>
        </div>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            @if($galeri->isEmpty())
                <div class="card p-16 text-center text-gray-400">
                    <i class="bx bx-images text-7xl mb-4"></i>
                    <h3 class="font-semibold text-xl mb-2">Galeri Kosong</h3>
                    <p>Belum ada foto yang diunggah.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid">
                    @foreach($galeri as $index => $foto)
                        <div class="relative group rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover transition-all duration-300 reveal cursor-pointer"
                            style="animation-delay: {{ ($index % 8) * 0.08 }}s"
                            onclick="openLightbox('{{ asset('storage/' . $foto->foto) }}', '{{ $foto->judul }}', '{{ $foto->keterangan }}')">
                            <img src="{{ asset('storage/' . $foto->foto) }}" alt="{{ $foto->judul }}"
                                class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-900/90 via-primary-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center justify-end p-4">
                                <i
                                    class="bx bx-zoom-in text-white text-3xl mb-2 transform -translate-y-2 group-hover:translate-y-0 transition-transform duration-300"></i>
                                <p class="text-white font-semibold text-sm text-center">{{ $foto->judul }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-10 flex justify-center">
                    {{ $galeri->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- Lightbox --}}
    <div id="lightbox" class="fixed inset-0 z-[100] bg-black/90 hidden items-center justify-center p-4"
        onclick="closeLightbox()">
        <div class="max-w-4xl w-full relative" onclick="event.stopPropagation()">
            <button onclick="closeLightbox()"
                class="absolute -top-10 right-0 text-white hover:text-gold-400 transition-colors">
                <i class="bx bx-x text-4xl"></i>
            </button>
            <img id="lightbox-img" src="" alt="" class="w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl">
            <div class="mt-4 text-center">
                <h3 id="lightbox-title" class="text-white font-bold text-xl"></h3>
                <p id="lightbox-caption" class="text-gray-400 text-sm mt-1"></p>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function openLightbox(src, title, caption) {
                document.getElementById('lightbox-img').src = src;
                document.getElementById('lightbox-title').textContent = title;
                document.getElementById('lightbox-caption').textContent = caption;
                const lb = document.getElementById('lightbox');
                lb.classList.remove('hidden');
                lb.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
            function closeLightbox() {
                const lb = document.getElementById('lightbox');
                lb.classList.add('hidden');
                lb.classList.remove('flex');
                document.body.style.overflow = '';
            }
            document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
        </script>
    @endpush
@endsection