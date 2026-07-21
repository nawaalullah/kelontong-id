<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokMovementController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// Guest routes (hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Protected routes (wajib login)
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori', KategoriController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('stok-movement', StokMovementController::class);

    Route::get('produk/{produk}/tambah-stok', [ProdukController::class, 'showTambahStok'])->name('produk.tambah-stok');
    Route::post('produk/{produk}/tambah-stok', [ProdukController::class, 'tambahStok'])->name('produk.tambah-stok.store');
    Route::resource('produk', ProdukController::class);

    // Transaksi: tanpa edit/update karena bersifat nota kasir (hanya buat, lihat, hapus)
    Route::resource('transaksi', TransaksiController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
});
