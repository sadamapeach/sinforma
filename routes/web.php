<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login.index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->middleware('guest')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->middleware('auth');
});

/* Mahasiswa */
Route::get('/dashboard_mahasiswa', 'App\Http\Controllers\MahasiswaController@index')->name('dashboard_mahasiswa');
Route::get('/form_mahasiswa', 'App\Http\Controllers\MahasiswaController@form')->name('form_mahasiswa');

/* Admin */
Route::get('/dashboard_admin', 'App\Http\Controllers\AdminController@index')->name('dashboard_admin');
Route::get('/daftar_mhs', 'App\Http\Controllers\AdminController@viewDaftarMhs')->name('daftar_mhs');
Route::get('/search_mhs', 'App\Http\Controllers\AdminController@searchMahasiswa')->name('search_mhs');
Route::get('/filter_mhs', 'App\Http\Controllers\AdminController@filterByStatus')->name('filter_mhs');
Route::get('/progress_mhs', 'App\Http\Controllers\AdminController@viewProgress')->name('progess_mhs');
Route::get('/view_edit_status/{nim}', 'App\Http\Controllers\AdminController@viewEditStatus')->name('view_edit_status');
Route::post('/delete_mhs/{nim}', 'App\Http\Controllers\AdminController@delete2')->name('delete_mhs');
Route::post('/edit_mhs/{nim}', 'App\Http\Controllers\AdminController@update2')->name('edit_mhs');