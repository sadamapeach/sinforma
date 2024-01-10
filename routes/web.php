<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('login.index');
});

/* Login Routes */
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

/* Mahasiswa Routes */
Route::get('/dashboard_mahasiswa', [MahasiswaController::class, 'index'])->name('dashboard_mahasiswa');
Route::get('/form_mahasiswa', [MahasiswaController::class, 'form'])->name('form_mahasiswa');

/* Admin Routes */
Route::get('/dashboard_admin', [AdminController::class, 'index'])->name('dashboard_admin');
Route::get('/view_profil', [AdminController::class, 'viewProfile'])->name('view_profil');
Route::get('/edit_profil', [AdminController::class, 'viewEditProfile'])->name('edit_profil');
Route::post('/edit_profil', [AdminController::class, 'update'])->name('edit_profil');
Route::get('/daftar_mhs', [AdminController::class, 'viewDaftarMhs'])->name('daftar_mhs');
Route::get('/search_mhs', [AdminController::class, 'searchMahasiswa'])->name('search_mhs');
Route::get('/filter_mhs', [AdminController::class, 'filterByStatus'])->name('filter_mhs');
Route::get('/progress_mhs/{id_mhs}', [AdminController::class, 'viewProgress'])->name('progress_mhs');
Route::get('/view_edit_status/{id_mhs}', [AdminController::class, 'viewEditStatus'])->name('view_edit_status');
Route::post('/delete_mhs/{id_mhs}', [AdminController::class, 'delete2'])->name('delete_mhs');
Route::post('/edit_mhs/{id_mhs}', [AdminController::class, 'update2'])->name('edit_mhs');
Route::get('/generate_akun', [AdminController::class, 'viewGenerateAkun'])->name('generate_akun');
Route::post('/generate_akun', [AdminController::class, 'generateAccounts'])->name('generate_akun');
Route::get('/daftar_akun', [AdminController::class, 'viewAccount'])->name('daftar_akun');
Route::get('/entry_mhs', [AdminController::class, 'showEntryMhs'])->name('entry_mhs');
Route::post('/store_mhs', [AdminController::class, 'store'])->name('store_mhs');
Route::get('/cetak_akun_mhs', [AdminController::class, 'cetakDaftarAkun'])->name('cetak_akun_mhs');
