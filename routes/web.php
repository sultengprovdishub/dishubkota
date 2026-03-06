<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\DokumenController as AdminDokumenController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;
use App\Http\Controllers\Admin\KoridorController as AdminKoridorController;
use App\Http\Controllers\Admin\HalteController as AdminHalteController;
use App\Http\Controllers\Admin\SpesifikasiBusController as AdminSpesifikasiBusController;
use App\Http\Controllers\Admin\PengaturanController as AdminPengaturanController;


/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil & Halaman Statis
Route::get('/profil', [HalamanController::class, 'profil'])->name('profil');
Route::get('/layanan', [HalamanController::class, 'layanan'])->name('layanan');
Route::get('/galeri', [HalamanController::class, 'galeri'])->name('galeri');
Route::get('/pengumuman', [HalamanController::class, 'pengumuman'])->name('pengumuman');
Route::get('/dokumen', [HalamanController::class, 'dokumen'])->name('dokumen');
Route::get('/kontak', [HalamanController::class, 'kontak'])->name('kontak');
Route::get('/trayek', [HalamanController::class, 'trayek'])->name('trayek');
Route::get('/dokumen/{id}/unduh', [HalamanController::class, 'unduhDokumen'])->name('dokumen.unduh');

// Berita Publik
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Form Kontak
Route::post('/kontak/kirim', [KontakController::class, 'kirim'])->name('kontak.kirim');

/*
|--------------------------------------------------------------------------
| Panel Admin (dilindungi auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Berita
    Route::resource('berita', AdminBeritaController::class)->except(['show']);
    Route::get('berita/{beritum}', [AdminBeritaController::class, 'edit'])->name('berita.show');

    // Galeri
    Route::resource('galeri', AdminGaleriController::class)->except(['show']);

    // Pengumuman
    Route::resource('pengumuman', AdminPengumumanController::class)->except(['show']);

    // Layanan
    Route::resource('layanan', AdminLayananController::class)->except(['show']);

    // Dokumen
    Route::resource('dokumen', AdminDokumenController::class)->except(['show']);

    // Kontak / Pesan Masuk
    Route::get('kontak', [AdminKontakController::class, 'index'])->name('kontak.index');
    Route::get('kontak/{kontak}', [AdminKontakController::class, 'show'])->name('kontak.show');
    Route::delete('kontak/{kontak}', [AdminKontakController::class, 'destroy'])->name('kontak.destroy');

    // Trayek — Koridor
    Route::resource('koridor', AdminKoridorController::class)->except(['show']);

    // Trayek — Halte
    Route::resource('halte', AdminHalteController::class)->except(['show']);

    // Trayek — Spesifikasi Bus
    Route::resource('spesifikasi-bus', AdminSpesifikasiBusController::class)->except(['show']);

    // Pengaturan Tarif
    Route::post('pengaturan/tarif', [AdminPengaturanController::class, 'updateTarif'])->name('pengaturan.tarif');
});

// Redirect /dashboard ke admin dashboard jika sudah login
Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

require __DIR__ . '/auth.php';
