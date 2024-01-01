<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;

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

// Route::get('/', function () {
//     return view('login.index');
// });


Route::middleware('web')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
});

// Login
// Route::get('/login', 'App\Http\Controllers\LoginController@index')->middleware('guest')->name('login');
// Route::post('/login', 'App\Http\Controllers\LoginController@authenticate')->name('authenticate');
// Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->middleware('auth');

/* Mahasiswa */
Route::get('/dashboard_mahasiswa', 'App\Http\Controllers\MahasiswaController@index')->name('dashboard_mahasiswa');
Route::get('/form_mahasiswa', 'App\Http\Controllers\MahasiswaController@form')->name('form_mahasiswa');

