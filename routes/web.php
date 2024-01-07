<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('login.index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->middleware('guest')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->middleware('auth');
});

    /* Mahasiswa */
    Route::get('/dashboard_mahasiswa', [MahasiswaController::class, 'index'])->name('dashboard_mahasiswa');
    Route::get('/form_mahasiswa', [MahasiswaController::class, 'form'])->name('form_mahasiswa');

    /* Admin */
    Route::get('/dashboard_admin', [AdminController::class, 'index'])->middleware('only_admin')->name('dashboard_admin');
    Route::get('/view_profil', [AdminController::class, 'viewProfile'])->middleware('only_admin')->name('view_profil');
    Route::get('/edit_profil', [AdminController::class, 'viewEditProfile'])->middleware('only_admin')->name('edit_profil');
    Route::post('/edit_profil', [AdminController::class, 'update'])->name('edit_profil');
    Route::get('/daftar_mhs', [AdminController::class, 'viewDaftarMhs'])->name('daftar_mhs');
    Route::get('/search_mhs', [AdminController::class, 'searchMahasiswa'])->name('search_mhs');
    Route::get('/filter_mhs', [AdminController::class, 'filterByStatus'])->name('filter_mhs');
    Route::get('/progress_mhs/{nim}', [AdminController::class, 'viewProgress'])->name('progress_mhs');
    Route::get('/view_edit_status/{nim}', [AdminController::class, 'viewEditStatus'])->middleware('only_admin')->name('view_edit_status');
    Route::post('/delete_mhs/{nim}', [AdminController::class, 'delete2'])->name('delete_mhs');
    Route::post('/edit_mhs/{nim}', [AdminController::class, 'update2'])->name('edit_mhs');
});
