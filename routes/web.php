<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// PIKR Detail Route
Route::get('/pikr/{id}', [\App\Http\Controllers\PikrDetailController::class, 'show'])->name('pikr.detail');

// Edukasi Detail Route
Route::get('/edukasi/{id}', [\App\Http\Controllers\EdukasiDetailController::class, 'show'])->name('edukasi.detail');

Route::get('/tailwind-test', function () {
    return view('tailwind-test');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Laporan Routes
    Route::get('/admin/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/admin/laporan/pikr', [App\Http\Controllers\LaporanController::class, 'pikrPdf'])->name('admin.laporan.pikr');
    Route::get('/admin/laporan/pikr/{id}', [App\Http\Controllers\LaporanController::class, 'pikrDetailPdf'])->name('admin.laporan.pikr.detail');
    Route::get('/admin/laporan/anggota', [App\Http\Controllers\LaporanController::class, 'anggotaPdf'])->name('admin.laporan.anggota');
    Route::get('/admin/laporan/kegiatan', [App\Http\Controllers\LaporanController::class, 'kegiatanPdf'])->name('admin.laporan.kegiatan');
    
    // Admin Routes
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard', ['user' => auth()->user()]);
    })->name('admin.dashboard');
    
    // Master Data Routes
    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/', function () {
            return view('master.index');
        })->name('index');
        
        // PIKR Routes
        Route::resource('pikr', \App\Http\Controllers\PikrController::class);
        
        // Anggota Routes
        Route::get('pikr/{pikr_id}/anggota', [\App\Http\Controllers\AnggotaController::class, 'index'])->name('anggota.index');
        Route::get('pikr/{pikr_id}/anggota/create', [\App\Http\Controllers\AnggotaController::class, 'create'])->name('anggota.create');
        Route::post('pikr/{pikr_id}/anggota', [\App\Http\Controllers\AnggotaController::class, 'store'])->name('anggota.store');
        Route::get('anggota/{anggota}', [\App\Http\Controllers\AnggotaController::class, 'show'])->name('anggota.show');
        Route::get('anggota/{anggota}/edit', [\App\Http\Controllers\AnggotaController::class, 'edit'])->name('anggota.edit');
        Route::put('anggota/{anggota}', [\App\Http\Controllers\AnggotaController::class, 'update'])->name('anggota.update');
        Route::delete('anggota/{anggota}', [\App\Http\Controllers\AnggotaController::class, 'destroy'])->name('anggota.destroy');
        
        // Prestasi Routes
        Route::get('anggota/{anggota_id}/prestasi', [\App\Http\Controllers\PrestasiController::class, 'index'])->name('prestasi.index');
        Route::get('anggota/{anggota_id}/prestasi/create', [\App\Http\Controllers\PrestasiController::class, 'create'])->name('prestasi.create');
        Route::post('anggota/{anggota_id}/prestasi', [\App\Http\Controllers\PrestasiController::class, 'store'])->name('prestasi.store');
        Route::get('prestasi/{prestasi}', [\App\Http\Controllers\PrestasiController::class, 'show'])->name('prestasi.show');
        Route::get('prestasi/{prestasi}/edit', [\App\Http\Controllers\PrestasiController::class, 'edit'])->name('prestasi.edit');
        Route::put('prestasi/{prestasi}', [\App\Http\Controllers\PrestasiController::class, 'update'])->name('prestasi.update');
        Route::delete('prestasi/{prestasi}', [\App\Http\Controllers\PrestasiController::class, 'destroy'])->name('prestasi.destroy');
        
        // Jabatan Routes
        Route::get('pikr/{pikr_id}/jabatan', [\App\Http\Controllers\JabatanController::class, 'index'])->name('jabatan.index');
        Route::get('pikr/{pikr_id}/jabatan/create', [\App\Http\Controllers\JabatanController::class, 'create'])->name('jabatan.create');
        Route::post('pikr/{pikr_id}/jabatan', [\App\Http\Controllers\JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('jabatan/{jabatan}', [\App\Http\Controllers\JabatanController::class, 'show'])->name('jabatan.show');
        Route::get('jabatan/{jabatan}/edit', [\App\Http\Controllers\JabatanController::class, 'edit'])->name('jabatan.edit');
        Route::put('jabatan/{jabatan}', [\App\Http\Controllers\JabatanController::class, 'update'])->name('jabatan.update');
        Route::delete('jabatan/{jabatan}', [\App\Http\Controllers\JabatanController::class, 'destroy'])->name('jabatan.destroy');
        
        // Kegiatan Routes
        Route::get('pikr/{pikr_id}/kegiatan', [\App\Http\Controllers\KegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('pikr/{pikr_id}/kegiatan/calendar', [\App\Http\Controllers\KegiatanController::class, 'calendar'])->name('kegiatan.calendar');
        Route::get('pikr/{pikr_id}/kegiatan/create', [\App\Http\Controllers\KegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('pikr/{pikr_id}/kegiatan', [\App\Http\Controllers\KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('kegiatan/{kegiatan}', [\App\Http\Controllers\KegiatanController::class, 'show'])->name('kegiatan.show');
        Route::get('kegiatan/{kegiatan}/edit', [\App\Http\Controllers\KegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('kegiatan/{kegiatan}', [\App\Http\Controllers\KegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('kegiatan/{kegiatan}', [\App\Http\Controllers\KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
        
        // Laporan Kegiatan Routes
        Route::get('laporan', [\App\Http\Controllers\LaporanKegiatanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/create', [\App\Http\Controllers\LaporanKegiatanController::class, 'create'])->name('laporan.create');
        Route::post('laporan', [\App\Http\Controllers\LaporanKegiatanController::class, 'store'])->name('laporan.store');
        Route::get('laporan/{laporan}', [\App\Http\Controllers\LaporanKegiatanController::class, 'show'])->name('laporan.show');
        Route::get('laporan/{laporan}/edit', [\App\Http\Controllers\LaporanKegiatanController::class, 'edit'])->name('laporan.edit');
        Route::put('laporan/{laporan}', [\App\Http\Controllers\LaporanKegiatanController::class, 'update'])->name('laporan.update');
        Route::delete('laporan/{laporan}', [\App\Http\Controllers\LaporanKegiatanController::class, 'destroy'])->name('laporan.destroy');
        
        // Kategori Edukasi Routes
        Route::resource('kategori-edukasi', \App\Http\Controllers\KategoriEdukasiController::class, [
            'names' => 'kategori_edukasi'
        ]);
        
        // Edukasi Routes
        Route::resource('edukasi', \App\Http\Controllers\EdukasiController::class);
        
        // BKBN Routes
        Route::resource('bkbn', \App\Http\Controllers\BkbnController::class);
        
        // Artikel Routes
        Route::get('pikr/{pikr_id}/artikel', [\App\Http\Controllers\ArtikelController::class, 'index'])->name('artikel.index');
        Route::get('pikr/{pikr_id}/artikel/create', [\App\Http\Controllers\ArtikelController::class, 'create'])->name('artikel.create');
        Route::post('pikr/{pikr_id}/artikel', [\App\Http\Controllers\ArtikelController::class, 'store'])->name('artikel.store');
        Route::get('artikel/{artikel}', [\App\Http\Controllers\ArtikelController::class, 'show'])->name('artikel.show');
        Route::get('artikel/{artikel}/edit', [\App\Http\Controllers\ArtikelController::class, 'edit'])->name('artikel.edit');
        Route::put('artikel/{artikel}', [\App\Http\Controllers\ArtikelController::class, 'update'])->name('artikel.update');
        Route::delete('artikel/{artikel}', [\App\Http\Controllers\ArtikelController::class, 'destroy'])->name('artikel.destroy');
        Route::patch('artikel/{artikel}/verify', [\App\Http\Controllers\ArtikelController::class, 'verify'])->name('artikel.verify');
        
    });
});

// Laporan Kegiatan Verification Route
Route::patch('laporan/{id}/verify', [\App\Http\Controllers\LaporanKegiatanController::class, 'verify'])->name('master.laporan.verify')->middleware(['auth', 'role:admin']);

// Route for Jabatan Structure - Accessible without authentication
Route::get('/api/jabatan/structure', [\App\Http\Controllers\JabatanController::class, 'getStructure'])->name('api.jabatan.structure');
