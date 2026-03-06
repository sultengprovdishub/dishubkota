@extends('layouts.app')
@section('title', 'Kontak')
@section('content')

<div class="hero-gradient relative py-20 overflow-hidden">
    <div class="absolute inset-0 dots-bg opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="flex items-center gap-2 text-blue-200 text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
            <i class="bx bx-chevron-right"></i> <span class="text-white">Kontak</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 animate-fade-in-down">Hubungi Kami</h1>
        <p class="text-blue-200 text-lg">Kami siap membantu pertanyaan dan kebutuhan Anda</p>
    </div>
    <div class="wave-bottom">
        <svg viewBox="0 0 1440 50" fill="none" preserveAspectRatio="none"><path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z" fill="#f9fafb"/></svg>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        @if(session('success'))
        <div class="mb-8 bg-green-50 border border-green-200 text-green-800 rounded-2xl p-5 flex items-start gap-4 animate-fade-in reveal">
            <i class="bx bx-check-circle text-green-500 text-3xl shrink-0"></i>
            <div>
                <div class="font-bold">Pesan Berhasil Dikirim!</div>
                <div class="text-sm mt-0.5">{{ session('success') }}</div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Info Kontak --}}
            <div class="space-y-5 reveal">
                <h2 class="text-2xl font-bold text-primary-900 mb-6">Informasi Kontak</h2>

                @foreach([
                    ['icon' => 'bx bx-map-pin', 'color' => 'primary', 'title' => 'Alamat Kantor', 'lines' => ['Jl. Mohammad Yamin No.2', 'Palu, Sulawesi Tengah 94111']],
                    ['icon' => 'bx bx-phone', 'color' => 'gold', 'title' => 'Telepon', 'lines' => ['(0451) 421-234', 'Senin–Kamis: 08.00–16.00']],
                    ['icon' => 'bx bxl-whatsapp', 'color' => 'green', 'title' => 'WhatsApp', 'lines' => ['0812-3456-7890', 'Respon dalam 1x24 jam']],
                    ['icon' => 'bx bx-envelope', 'color' => 'primary', 'title' => 'Email', 'lines' => ['dishub@palukota.go.id']],
                ] as $info)
                <div class="card p-5 flex items-start gap-4 group">
                    <div class="w-12 h-12 bg-{{ $info['color'] === 'green' ? 'green' : ($info['color'] === 'gold' ? 'gold' : 'primary') }}-100 rounded-xl flex items-center justify-center shrink-0">
                        <i class="{{ $info['icon'] }} text-{{ $info['color'] === 'green' ? 'green' : ($info['color'] === 'gold' ? 'gold' : 'primary') }}-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-sm">{{ $info['title'] }}</h4>
                        @foreach($info['lines'] as $line)
                        <p class="text-gray-600 text-sm">{{ $line }}</p>
                        @endforeach
                    </div>
                </div>
                @endforeach

                {{-- Jam Layanan --}}
                <div class="card p-5">
                    <h4 class="font-bold text-primary-900 mb-4 flex items-center gap-2">
                        <i class="bx bx-time-five text-gold-500"></i> Jam Pelayanan
                    </h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between py-2 border-b border-gray-50">
                            <span class="text-gray-600">Senin – Kamis</span>
                            <span class="font-semibold text-gray-900">08.00 – 16.00</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-50">
                            <span class="text-gray-600">Jumat</span>
                            <span class="font-semibold text-gray-900">08.00 – 11.00</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Sabtu & Minggu</span>
                            <span class="font-semibold text-red-500">Tutup</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Kontak --}}
            <div class="lg:col-span-2 reveal">
                <div class="card p-8">
                    <h2 class="text-2xl font-bold text-primary-900 mb-2">Kirim Pesan</h2>
                    <p class="text-gray-500 text-sm mb-6">Isi formulir di bawah untuk mengirim pesan kepada kami. Kami akan merespons secepatnya.</p>

                    <form action="{{ route('kontak.kirim') }}" method="POST" id="contact-form">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap"
                                       class="input-field @error('nama') border-red-400 @enderror">
                                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com"
                                       class="input-field @error('email') border-red-400 @enderror">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon</label>
                                <input type="tel" name="telepon" value="{{ old('telepon') }}" placeholder="08xx-xxxx-xxxx"
                                       class="input-field">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subjek <span class="text-red-500">*</span></label>
                                <input type="text" name="subjek" value="{{ old('subjek') }}" placeholder="Perihal pesan Anda"
                                       class="input-field @error('subjek') border-red-400 @enderror">
                                @error('subjek') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pesan <span class="text-red-500">*</span></label>
                                <textarea name="pesan" rows="5" placeholder="Tulis pesan Anda di sini..."
                                          class="input-field resize-none @error('pesan') border-red-400 @enderror">{{ old('pesan') }}</textarea>
                                @error('pesan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn-primary mt-6 w-full justify-center text-base py-3.5" id="submit-btn">
                            <i class="bx bx-send"></i> Kirim Pesan
                        </button>
                    </form>
                </div>

                {{-- Peta --}}
                <div class="card mt-6 overflow-hidden reveal">
                    <div class="bg-gradient-to-br from-primary-800 to-primary-950 p-5 flex items-center gap-3">
                        <i class="bx bx-map text-gold-400 text-2xl"></i>
                        <div>
                            <h3 class="font-bold text-white">Lokasi Kantor</h3>
                            <p class="text-blue-200 text-xs">Jl. Mohammad Yamin No.2, Palu</p>
                        </div>
                    </div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.8!2d119.8741!3d-0.9022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMC054oCYNTQnMDguMSJTIDExOcKwNTInMjYuOCJF!5e0!3m2!1sid!2sid!4v1"
                        class="w-full h-56 border-0" allowfullscreen loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.getElementById('contact-form').addEventListener('submit', function() {
        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="bx bx-loader-alt animate-spin"></i> Mengirim...';
    });
</script>
@endpush
@endsection
