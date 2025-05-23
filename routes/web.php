<?php

use App\Http\Controllers\PembelianController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/pembelian', [PembelianController::class, 'create'])->name('pembelian.create');
Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
Route::get('/nota', [PembelianController::class, 'index'])->name('nota.index');
Route::get('/nota/{id}', [PembelianController::class, 'show'])->name('nota.show');
Route::get('/nota/{id}/cetak', [\App\Http\Controllers\PembelianController::class, 'cetak'])->name('nota.cetak');

