<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('login.index');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    /* Mahasiswa */
    Route::get('/dashboard_mahasiswa', [MahasiswaController::class, 'index'])->name('dashboard_mahasiswa');
    Route::get('/form_mahasiswa', [MahasiswaController::class, 'form'])->name('form_mahasiswa');

    /* Admin */
    Route::get('/dashboard_admin', [AdminController::class, 'index'])->name('dashboard_admin');
    Route::get('/view_profil', [AdminController::class, 'viewProfile'])->name('view_profil');
    Route::get('/edit_profil', [AdminController::class, 'viewEditProfile'])->name('edit_profil');
    Route::post('/edit_profil', [AdminController::class, 'update'])->name('edit_profil');
    Route::get('/daftar_mhs', [AdminController::class, 'viewDaftarMhs'])->name('daftar_mhs');
    Route::get('/search_mhs', [AdminController::class, 'searchMahasiswa'])->name('search_mhs');
    Route::get('/filter_mhs', [AdminController::class, 'filterByStatus'])->name('filter_mhs');
    Route::get('/progress_mhs/{nim}', [AdminController::class, 'viewProgress'])->name('progress_mhs');
    Route::get('/view_edit_status/{nim}', [AdminController::class, 'viewEditStatus'])->name('view_edit_status');
    Route::post('/delete_mhs/{nim}', [AdminController::class, 'delete2'])->name('delete_mhs');
    Route::post('/edit_mhs/{nim}', [AdminController::class, 'update2'])->name('edit_mhs');
});
