<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'index'])->name('customer.login');
Route::post('/login', [AuthController::class, 'login'])->name('customer.login.auth');
Route::get('admin/login', [AuthController::class, 'indexAdmin'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login.auth');

Route::middleware(['customer'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('customer.index');
    Route::get('/tagihan', [TagihanController::class, 'indexCust'])->name('customer.tagihan');
    Route::match(['PUT', 'PATCH'], '/tagihan/{tagihan}', [TagihanController::class, 'update'])->name('customer.tagihan.proses');
    Route::get('/penggunaan', [PenggunaanController::class, 'indexCust'])->name('customer.penggunaan');
    Route::post('/logout', [AuthController::class, 'logout'])->name('customer.logout');
});

Route::name('admin.')->middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'indexAdmin'])->name('dashboard');
    Route::resource('admin/pelanggan', PelangganController::class)->except(['show']);
    Route::resource('admin/user', UserController::class)->except(['show']);
    Route::resource('admin/tarif', TarifController::class)->except(['show']);
    Route::name('penggunaan.')->group(function () {
        Route::get('admin/penggunaan/{pelanggan}/create', [PenggunaanController::class,'create'])->name('create');
        Route::get('admin/penggunaan/detail_penggunaan/{pelanggan}', [PenggunaanController::class,'show'])->name('show');
    });
    Route::resource('admin/penggunaan', PenggunaanController::class)->only(['index','store']);
    Route::resource('admin/penggunaan/detail_penggunaan', PenggunaanController::class)->only(['edit', 'update', 'destroy']);
    Route::name('tagihan.')->group(function () {
        Route::get('admin/penggunaan/detail_tagihan/{pelanggan}', [TagihanController::class,'show'])->name('show');
    });
    Route::delete('admin/penggunaan/detail_tagihan/{detail_tagihan}', [TagihanController::class, 'destroy'])->name('detail_tagihan.destroy');
    Route::get('admin/pembayaran', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::match(['PUT', 'PATCH'], 'admin/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('pembayaran.confirm');
    Route::get('admin/riwayat_pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::resource('admin/level', LevelController::class)->except(['show']);
    Route::post('admin/logout', [AuthController::class, 'logout'])->name('logout');
});
