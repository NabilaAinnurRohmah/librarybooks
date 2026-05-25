<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserPeminjamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::middleware(['auth.check', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('anggota', AnggotaController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('rak', RakController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('/pengembalian', [PengembalianController::class, 'index'])
        ->name('pengembalian.index');
    Route::post('/pengembalian/kembali/{id}', [PengembalianController::class, 'kembali'])
        ->name('pengembalian.kembali');

});

Route::middleware(['auth.check', 'role:peminjam'])->group(function () {
    Route::get('/buku-list', [UserPeminjamController::class, 'index'])
        ->name('peminjam.buku');
    Route::get('/buku/{id}', [UserPeminjamController::class, 'show'])
        ->name('peminjam.detail');
    Route::get('/pengembalian', [UserPeminjamController::class, 'pengembalian'])
        ->name('peminjam.pengembalian');
    Route::get('/peminjaman', [UserPeminjamController::class, 'peminjaman'])
        ->name('peminjam.peminjaman');
    Route::post('/pinjam', [UserPeminjamController::class, 'store'])
        ->name('peminjam.pinjam');
});
