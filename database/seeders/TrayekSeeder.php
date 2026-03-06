<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Koridor;
use App\Models\Halte;
use App\Models\SpesifikasiBus;

class TrayekSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // KORIDOR DATA
        // =====================
        $koridor_data = [
            [
                'kode' => 'K01',
                'nama' => 'Koridor 01 — Terminal Mamboro — Manonda',
                'warna' => '#ef4444',
                'deskripsi' => 'Koridor utama dari Terminal Mamboro menuju Manonda melewati pusat kota.',
                'aktif' => true,
                'urutan' => 1,
                'halte' => [
                    ['nama' => 'Terminal Mamboro', 'lat' => -0.8359, 'lng' => 119.8562, 'tipe' => 'terminal', 'urutan' => 1],
                    ['nama' => 'Halte Talise', 'lat' => -0.8450, 'lng' => 119.8620, 'tipe' => 'halte', 'urutan' => 2],
                    ['nama' => 'Halte Pantai Palu', 'lat' => -0.8555, 'lng' => 119.8650, 'tipe' => 'halte', 'urutan' => 3],
                    ['nama' => 'Halte Jl. Maluku', 'lat' => -0.8631, 'lng' => 119.8682, 'tipe' => 'halte', 'urutan' => 4],
                    ['nama' => 'Halte Pasar Inpres', 'lat' => -0.8720, 'lng' => 119.8701, 'tipe' => 'hub', 'urutan' => 5],
                    ['nama' => 'Manonda', 'lat' => -0.8985, 'lng' => 119.8547, 'tipe' => 'terminal', 'urutan' => 6],
                ],
            ],
            [
                'kode' => 'K02',
                'nama' => 'Koridor 02 — Mamboro — Tatura',
                'warna' => '#3b82f6',
                'deskripsi' => 'Koridor menghubungkan Mamboro ke kawasan Tatura dan sekitarnya.',
                'aktif' => true,
                'urutan' => 2,
                'halte' => [
                    ['nama' => 'Mamboro', 'lat' => -0.8359, 'lng' => 119.8562, 'tipe' => 'terminal', 'urutan' => 1],
                    ['nama' => 'Halte Siranindi', 'lat' => -0.8483, 'lng' => 119.8730, 'tipe' => 'halte', 'urutan' => 2],
                    ['nama' => 'Halte Jl. Moh. Hatta', 'lat' => -0.8600, 'lng' => 119.8790, 'tipe' => 'halte', 'urutan' => 3],
                    ['nama' => 'Tatura Mall', 'lat' => -0.8820, 'lng' => 119.8800, 'tipe' => 'hub', 'urutan' => 4],
                ],
            ],
            [
                'kode' => 'K03',
                'nama' => 'Koridor 03 — Mamboro — Petobo',
                'warna' => '#22c55e',
                'deskripsi' => 'Koridor ke arah Petobo dan wilayah selatan Palu.',
                'aktif' => true,
                'urutan' => 3,
                'halte' => [
                    ['nama' => 'Mamboro', 'lat' => -0.8359, 'lng' => 119.8562, 'tipe' => 'terminal', 'urutan' => 1],
                    ['nama' => 'Halte Jl. Diponegoro', 'lat' => -0.8680, 'lng' => 119.8715, 'tipe' => 'halte', 'urutan' => 2],
                    ['nama' => 'Halte RS Undata', 'lat' => -0.8820, 'lng' => 119.8700, 'tipe' => 'halte', 'urutan' => 3],
                    ['nama' => 'Petobo', 'lat' => -0.9150, 'lng' => 119.8650, 'tipe' => 'terminal', 'urutan' => 4],
                ],
            ],
            [
                'kode' => 'K04',
                'nama' => 'Koridor 04 — Mamboro — Tawaeli',
                'warna' => '#f97316',
                'deskripsi' => 'Koridor menuju kawasan Tawaeli di utara Palu.',
                'aktif' => true,
                'urutan' => 4,
                'halte' => [
                    ['nama' => 'Mamboro', 'lat' => -0.8359, 'lng' => 119.8562, 'tipe' => 'terminal', 'urutan' => 1],
                    ['nama' => 'Halte Pantoloan', 'lat' => -0.7740, 'lng' => 119.8580, 'tipe' => 'halte', 'urutan' => 2],
                    ['nama' => 'Tawaeli', 'lat' => -0.7550, 'lng' => 119.8540, 'tipe' => 'terminal', 'urutan' => 3],
                ],
            ],
            [
                'kode' => 'K05',
                'nama' => 'Koridor 05 — Mamboro — Tipo',
                'warna' => '#a855f7',
                'deskripsi' => 'Koridor ke wilayah barat Palu menuju Tipo.',
                'aktif' => true,
                'urutan' => 5,
                'halte' => [
                    ['nama' => 'Mamboro', 'lat' => -0.8359, 'lng' => 119.8562, 'tipe' => 'terminal', 'urutan' => 1],
                    ['nama' => 'Halte Tanjung Karang', 'lat' => -0.8460, 'lng' => 119.8380, 'tipe' => 'halte', 'urutan' => 2],
                    ['nama' => 'Tipo', 'lat' => -0.8600, 'lng' => 119.8200, 'tipe' => 'terminal', 'urutan' => 3],
                ],
            ],
        ];

        foreach ($koridor_data as $k) {
            $halte_list = $k['halte'];
            unset($k['halte']);
            $koridor = Koridor::create($k);
            foreach ($halte_list as $h) {
                $koridor->halte()->create([
                    'nama' => $h['nama'],
                    'latitude' => $h['lat'],
                    'longitude' => $h['lng'],
                    'tipe' => $h['tipe'],
                    'urutan' => $h['urutan'],
                ]);
            }
        }

        // =====================
        // SPESIFIKASI BUS
        // =====================
        $specs = [
            ['kunci' => 'kapasitas', 'label' => 'Kapasitas Total', 'nilai' => '35 Penumpang', 'ikon' => 'bx bx-user-plus', 'warna' => '#3b82f6', 'warna_bg' => 'rgba(59,130,246,0.08)', 'urutan' => 1],
            ['kunci' => 'kursi', 'label' => 'Kursi Duduk', 'nilai' => '21 Kursi', 'ikon' => 'bx bx-chair', 'warna' => '#6366f1', 'warna_bg' => 'rgba(99,102,241,0.08)', 'urutan' => 2],
            ['kunci' => 'warna', 'label' => 'Warna Armada', 'nilai' => 'Putih + Aksen Emas', 'ikon' => 'bx bx-palette', 'warna' => '#eab308', 'warna_bg' => 'rgba(234,179,8,0.08)', 'urutan' => 3],
            ['kunci' => 'koridor', 'label' => 'Jumlah Koridor', 'nilai' => '5 Koridor Aktif', 'ikon' => 'bx bx-route', 'warna' => '#f97316', 'warna_bg' => 'rgba(249,115,22,0.08)', 'urutan' => 4],
            ['kunci' => 'halte', 'label' => 'Total Halte', 'nilai' => '50 Titik', 'ikon' => 'bx bx-map-pin', 'warna' => '#22c55e', 'warna_bg' => 'rgba(34,197,94,0.08)', 'urutan' => 5],
            ['kunci' => 'fasilitas', 'label' => 'Fasilitas', 'nilai' => 'Layar Videotron', 'ikon' => 'bx bx-tv', 'warna' => '#a855f7', 'warna_bg' => 'rgba(168,85,247,0.08)', 'urutan' => 6],
            ['kunci' => 'operator', 'label' => 'Operator', 'nilai' => 'PT Bagong Transport', 'ikon' => 'bx bx-building', 'warna' => '#ef4444', 'warna_bg' => 'rgba(239,68,68,0.08)', 'urutan' => 7],
            ['kunci' => 'skema', 'label' => 'Skema Operasi', 'nilai' => 'Buy The Service', 'ikon' => 'bx bx-briefcase', 'warna' => '#14b8a6', 'warna_bg' => 'rgba(20,184,166,0.08)', 'urutan' => 8],
        ];

        foreach ($specs as $s) {
            SpesifikasiBus::create($s);
        }

        $this->command->info('✅ TrayekSeeder berhasil: 5 koridor, ' . Halte::count() . ' halte, 8 spesifikasi.');
    }
}
