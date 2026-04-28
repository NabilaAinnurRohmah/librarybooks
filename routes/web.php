<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserPeminjamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.check', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('anggota', AnggotaController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::post('/pengembalian/kembali/{id}', [PengembalianController::class, 'kembali'])
        ->name('pengembalian.kembali');
    Route::post('/peminjaman/konfirmasi/{id}', [PeminjamanController::class, 'konfirmasi'])
        ->name('peminjaman.konfirmasi');

});

Route::middleware(['auth.check', 'role:peminjam'])->group(function () {
    Route::get('/buku-list', [UserPeminjamController::class, 'index'])
        ->name('peminjam.buku');
    Route::get('/buku/{id}', [UserPeminjamController::class, 'show'])
        ->name('peminjam.detail');
    Route::get('/riwayat', [UserPeminjamController::class, 'riwayat'])
        ->name('peminjam.riwayat');
    Route::post('/pinjam', [UserPeminjamController::class, 'store'])
        ->name('peminjam.pinjam');
});
