<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| WELCOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (redirect otomatis sesuai role - lihat resources/views/dashboard.blade.php)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('mitra.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN AREA (khusus role admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD ADMIN
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    /*
    |--------------------------
    | MITRA MANAGEMENT (READ + DETAIL + TOGGLE + DELETE)
    |--------------------------
    */
    Route::get('/mitra', [AdminController::class, 'mitra'])->name('mitra.index');
    Route::get('/mitra/{id}', [AdminController::class, 'showMitra'])->name('mitra.show');
    Route::patch('/mitra/{id}/toggle', [AdminController::class, 'toggleMitra'])->name('mitra.toggle');
    Route::delete('/mitra/{id}', [AdminController::class, 'deleteMitra'])->name('mitra.delete');

    /*
    |--------------------------
    | STOK BARANG (CRUD RESOURCE)
    |--------------------------
    */
    Route::resource('stok', StokBarangController::class);

    /*
    |--------------------------
    | KAS (CASH IN / CASH OUT)
    |--------------------------
    */
    Route::get('/kas/{jenis}', [KasController::class, 'index'])
        ->whereIn('jenis', ['masuk', 'keluar'])
        ->name('kas.index');
    Route::get('/kas/{jenis}/create', [KasController::class, 'create'])
        ->whereIn('jenis', ['masuk', 'keluar'])
        ->name('kas.create');
    Route::post('/kas/{jenis}', [KasController::class, 'store'])
        ->whereIn('jenis', ['masuk', 'keluar'])
        ->name('kas.store');
    Route::delete('/kas/{kas}', [KasController::class, 'destroy'])->name('kas.destroy');

    /*
    |--------------------------
    | PEMESANAN STOK (kelola status pesanan mitra)
    |--------------------------
    */
    Route::patch('/pemesanan/{pemesanan}/status', [PemesananController::class, 'updateStatus'])
        ->name('pemesanan.status');

    /*
    |--------------------------
    | KELOLA USER (admin + mitra dalam satu halaman)
    |--------------------------
    */
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::patch('/user/{user}/role', [UserController::class, 'updateRole'])->name('user.role');
    Route::patch('/user/{user}/toggle', [UserController::class, 'toggleActive'])->name('user.toggle');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    /*
    |--------------------------
    | PENGATURAN APLIKASI (khusus admin)
    |--------------------------
    */
    Route::put('/pengaturan/aplikasi', [PengaturanController::class, 'updateAplikasi'])
        ->name('pengaturan.aplikasi');
});

/*
|--------------------------------------------------------------------------
| MITRA AREA (khusus role mitra)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:mitra'])->prefix('mitra')->name('mitra.')->group(function () {
    Route::get('/dashboard', [MitraController::class, 'dashboard'])->name('dashboard');
    Route::get('/stok', [MitraController::class, 'stok'])->name('stok');
});

/*
|--------------------------------------------------------------------------
| PEMESANAN STOK (dipakai mitra untuk pesan, admin+mitra untuk lihat daftar)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/pemesanan', [PemesananController::class, 'index'])
        ->name('pemesanan.index');

    Route::get('/pemesanan/{pemesanan}', [PemesananController::class, 'show'])
        ->name('pemesanan.show');

    Route::delete('/pemesanan/{pemesanan}', [PemesananController::class, 'destroy'])
        ->name('pemesanan.destroy');
});

Route::middleware(['auth', 'role:mitra'])->group(function () {

    Route::get('/pemesanan/create/{barang}', [PemesananController::class, 'create'])
        ->name('pemesanan.create');

    Route::post('/pemesanan', [PemesananController::class, 'store'])
        ->name('pemesanan.store');
});

/*
|--------------------------------------------------------------------------
| LAPORAN (isi & scope otomatis menyesuaikan role - lihat LaporanController)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
});

/*
|--------------------------------------------------------------------------
| PENGATURAN (profil untuk semua role, kartu tambahan untuk admin)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::put('/pengaturan/profil', [PengaturanController::class, 'updateProfil'])->name('pengaturan.profil');
    Route::put('/pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
