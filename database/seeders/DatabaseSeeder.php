<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Layanan;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengumuman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@dishub.palu.go.id',
            'password' => Hash::make('password'),
        ]);

        // Layanan
        $layananData = [
            ['nama' => 'Izin Usaha Angkutan', 'ikon' => 'bx bx-car', 'deskripsi' => 'Pengurusan izin usaha angkutan umum, termasuk angkutan kota dan angkutan darat.', 'urutan' => 1],
            ['nama' => 'Pengujian Kendaraan', 'ikon' => 'bx bx-check-shield', 'deskripsi' => 'Uji kelayakan kendaraan bermotor untuk memastikan keselamatan di jalan raya.', 'urutan' => 2],
            ['nama' => 'Perizinan Trayek', 'ikon' => 'bx bx-map-pin', 'deskripsi' => 'Pengurusan surat izin trayek angkutan umum dalam kota dan antar kota.', 'urutan' => 3],
            ['nama' => 'Rekomendasi STNK', 'ikon' => 'bx bx-file', 'deskripsi' => 'Penerbitan rekomendasi kelayakan kendaraan untuk keperluan STNK.', 'urutan' => 4],
            ['nama' => 'Perpanjangan Izin', 'ikon' => 'bx bx-refresh', 'deskripsi' => 'Perpanjangan izin usaha angkutan dan perizinan terkait lainnya.', 'urutan' => 5],
            ['nama' => 'Konsultasi & Informasi', 'ikon' => 'bx bx-info-circle', 'deskripsi' => 'Layanan konsultasi dan informasi seputar transportasi dan perhubungan Kota Palu.', 'urutan' => 6],
        ];

        foreach ($layananData as $item) {
            Layanan::create(array_merge($item, ['aktif' => true]));
        }

        // Berita
        $beritaData = [
            [
                'judul' => 'Dinas Perhubungan Kota Palu Gelar Sosialisasi Keselamatan Lalu Lintas',
                'ringkasan' => 'Dishub Kota Palu menggelar sosialisasi keselamatan lalu lintas untuk menekan angka kecelakaan di jalan raya.',
                'konten' => '<p>Dinas Perhubungan Kota Palu menggelar kegiatan sosialisasi keselamatan lalu lintas yang diikuti oleh ratusan pengemudi angkutan umum dan masyarakat umum.</p><p>Kegiatan ini bertujuan untuk meningkatkan kesadaran masyarakat akan pentingnya keselamatan berlalu lintas dan menekan angka kecelakaan di wilayah Kota Palu.</p>',
                'kategori' => 'Kegiatan',
                'status' => 'publish',
                'published_at' => now()->subDays(3),
            ],
            [
                'judul' => 'Peningkatan Fasilitas Terminal Mamboro Kota Palu',
                'ringkasan' => 'Dishub Kota Palu terus melakukan peningkatan fasilitas Terminal Mamboro untuk kenyamanan penumpang.',
                'konten' => '<p>Dalam rangka meningkatkan pelayanan transportasi publik, Dinas Perhubungan Kota Palu terus melakukan renovasi dan peningkatan fasilitas Terminal Mamboro.</p><p>Berbagai fasilitas baru ditambahkan untuk kenyamanan penumpang, termasuk ruang tunggu yang lebih luas dan fasilitas sanitasi yang memadai.</p>',
                'kategori' => 'Pembangunan',
                'status' => 'publish',
                'published_at' => now()->subDays(7),
            ],
            [
                'judul' => 'Uji KIR Kendaraan Bermotor Periode Maret 2026',
                'ringkasan' => 'Dishub Kota Palu membuka pendaftaran Uji KIR kendaraan bermotor periode Maret 2026.',
                'konten' => '<p>Dinas Perhubungan Kota Palu mengumumkan pembukaan pendaftaran Uji KIR (Kelayakan Inspeksi Rutin) kendaraan bermotor untuk periode Maret 2026.</p><p>Pemilik kendaraan diwajibkan untuk melakukan uji KIR secara berkala sesuai ketentuan yang berlaku untuk memastikan kelaikan kendaraan di jalan raya.</p>',
                'kategori' => 'Layanan',
                'status' => 'publish',
                'published_at' => now()->subDays(10),
            ],
        ];

        foreach ($beritaData as $item) {
            $item['slug'] = Str::slug($item['judul']);
            Berita::create($item);
        }

        // Pengumuman
        $pengumumanData = [
            [
                'judul' => 'Jadwal Pelayanan Dishub Kota Palu Selama Bulan Maret 2026',
                'konten' => 'Dinas Perhubungan Kota Palu menyampaikan bahwa jadwal pelayanan selama bulan Maret 2026 adalah Senin-Kamis pukul 08.00-16.00 WITA dan Jumat pukul 08.00-11.00 WITA.',
                'tanggal_terbit' => now(),
                'tanggal_berakhir' => now()->addMonth(),
                'status' => 'aktif',
            ],
            [
                'judul' => 'Pendaftaran Izin Usaha Angkutan Batch II 2026',
                'konten' => 'Dibuka pendaftaran izin usaha angkutan batch kedua tahun 2026. Bagi pelaku usaha yang belum memiliki izin diwajibkan segera mendaftar.',
                'tanggal_terbit' => now()->subDays(5),
                'status' => 'aktif',
            ],
        ];

        foreach ($pengumumanData as $item) {
            Pengumuman::create($item);
        }
    }
}
