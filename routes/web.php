<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index']);

    //user
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/create', [UserController::class, 'create']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

    //Kategori
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/create', [KategoriController::class, 'create']);
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
    Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy']);

    //Alat
    Route::get('/alat', [AlatController::class, 'index']);
    Route::get('/alat/create', [AlatController::class, 'create']);
    Route::get('/alat/edit/{id}', [AlatController::class, 'edit']);
    Route::post('/alat/store', [AlatController::class, 'store']);
    Route::put('/alat/update/{id}', [AlatController::class, 'update']);
    Route::delete('/alat/delete/{id}', [AlatController::class, 'destroy']);

    //Peminjaman
    Route::get('/peminjaman', [AdminController::class, 'pindex']);
    Route::get('/peminjaman/create', [AdminController::class, 'pincreate']);
    Route::get('/peminjaman/edit/{id}', [AdminController::class, 'pinedit']);
    Route::post('/peminjaman/store', [AdminController::class, 'pinstore']);
    Route::put('/peminjaman/update/{id}', [AdminController::class, 'pinupdate']);
    Route::delete('/peminjaman/delete/{id}', [AdminController::class, 'pindestroy']);

    //log aktivis
    Route::get('/logaktivis', [AdminController::class, 'logs']);

    //Pengembalian
    Route::post('/kembali/{id}', [AdminController::class, 'kembali']);

    Route::get('/pengembalian', [AdminController::class, 'penindex']);
    Route::get('/pengembalian/create', [AdminController::class, 'pencreate']);
    Route::get('/pengembalian/edit/{id}', [AdminController::class, 'penedit']);
    Route::post('/pengembalian/store', [AdminController::class, 'penstore']);
    Route::put('/pengembalian/update/{id}', [AdminController::class, 'penupdate']);
    Route::delete('/pengembalian/delete/{id}', [AdminController::class, 'pendestroy']);
});

Route::prefix('petugas')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/', [PetugasController::class, 'index']);
    Route::get('/pengembalian', [PetugasController::class, 'pengembalian']);

    Route::get('/peminjaman', [PetugasController::class, 'index']);
    Route::get('/peminjaman/{id}/konfirmasi', [PetugasController::class, 'edit']);
    Route::patch('/peminjaman/{id}/update', [PetugasController::class, 'updateStatus']);
    Route::get('/laporan/cetak', [PetugasController::class, 'cetakLaporan']);
});

Route::prefix('peminjam')->middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/', [PeminjamController::class, 'index'])->name('index');
    Route::get('/create', [PeminjamController::class, 'create'])->name('create');
    Route::post('/store', [PeminjamController::class, 'store'])->name('store');
    Route::post('/kembali/{id}', [PeminjamController::class, 'kembali']);
});
