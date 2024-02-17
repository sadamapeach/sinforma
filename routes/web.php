<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\AccountController;


Route::get('/', function () {
    return view('login.index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->middleware('guest')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

/* Mahasiswa */
Route::controller(MahasiswaController::class)->group(function() { 
    Route::get('/dashboard_mahasiswa', [MahasiswaController::class, 'index'])->name('dashboard_mahasiswa');

    Route::get('/form_mahasiswa', [MahasiswaController::class, 'form'])->name('form_mahasiswa');
    Route::post('/store_form', [MahasiswaController::class, 'store'])->name('save');

    Route::get('/profile_mahasiswa', [MahasiswaController::class, 'profile'])->name('profile_mahasiswa');
    Route::get('/edit_profile', [MahasiswaController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/update_profile', [MahasiswaController::class, 'update_profile'])->name('update_profile');

    Route::post('/change_password', [MahasiswaController::class, 'change_password'])->name('password_mahasiswa');

    Route::get('/presensi_mahasiswa', [MahasiswaController::class, 'presensi'])->name('presensi_mahasiswa');
    Route::get('/add_presensi/{id_absen}', [MahasiswaController::class, 'add_presensi'])->name('add_presensi');
    Route::post('/store_presensi/{id_absen}', [MahasiswaController::class, 'store_presensi'])->name('store_presensi'); 

    Route::get('/progress_mahasiswa', [MahasiswaController::class, 'progress'])->name('progress_mahasiswa');
    Route::get('/add_progress/{id_progress}', [MahasiswaController::class, 'add_progress'])->name('add_progress');
    Route::post('/store_progress/{id_progress}', [MahasiswaController::class, 'store_progress'])->name('store_progress_mhs');

    Route::get('/cetak_nilai_mhs', [MahasiswaController::class, 'cetak_nilai'])->name('cetak_nilai_mhs');
    Route::get('/cetak_skl_mhs', [MahasiswaController::class, 'cetak_skl'])->name('cetak_skl_mhs');
});

/* Akun */
Route::controller(AccountController::class)->middleware('auth')->group(function () {
    Route::get('/change-password', 'viewChangePassword')->name('account.viewChangePassword');
    Route::post('/change-password', 'update')->name('account.update');
});

/* Admin */
Route::get('/dashboard_admin', [AdminController::class, 'index'])->middleware('only_admin')->name('dashboard_admin');
Route::get('/view_profil', [AdminController::class, 'viewProfile'])->middleware('only_admin')->name('view_profil');
Route::get('/edit_profil', [AdminController::class, 'viewEditProfile'])->middleware('only_admin')->name('edit_profil');
Route::post('/edit_profil', [AdminController::class, 'update'])->name('edit_profil');
Route::get('/daftar_mhs', [AdminController::class, 'viewDaftarMhs'])->middleware('only_admin')->name('daftar_mhs');
Route::get('/search_mhs', [AdminController::class, 'searchMahasiswa'])->name('search_mhs');
Route::get('/filter_mhs', [AdminController::class, 'filterByStatus'])->name('filter_mhs');
Route::get('/filter_presensi', [AdminController::class, 'filterPresensi'])->name('filter_presensi');
Route::get('/search_presensi', [AdminController::class, 'searchPresensi'])->name('search_presensi');
Route::get('/progress_mhs/{id_mhs}', [AdminController::class, 'viewProgress'])->middleware('only_admin')->name('progress_mhs');
Route::get('/view_edit_status/{id_mhs}', [AdminController::class, 'viewEditStatus'])->middleware('only_admin')->name('view_edit_status');
Route::post('/delete_mhs/{id_mhs}', [AdminController::class, 'delete2'])->name('delete_mhs');
Route::post('/edit_mhs/{id_mhs}', [AdminController::class, 'update2'])->name('edit_mhs');
Route::get('/entry_mhs', [AdminController::class, 'showEntryMhs'])->middleware('only_admin')->name('entry_mhs');
Route::post('/store_mhs', [AdminController::class, 'store'])->name('store_mhs');
Route::get('/cetak_akun_mhs', [AdminController::class, 'cetakDaftarAkun'])->name('cetak_akun_mhs');
Route::get('/daftar_akun', [AdminController::class, 'viewAccount'])->middleware('only_admin')->name('daftar_akun');
Route::get('/view_presensi', [AdminController::class, 'viewPresensi'])->middleware('only_admin')->name('view_presensi');
Route::get('/verif_presensi/{id_mhs}', [AdminController::class, 'verifyPresensi'])->name('verif_presensi');
Route::get('/skl_mhs', [AdminController::class, 'viewSKL'])->middleware('only_admin')->name('skl_mhs');
Route::get('/lihat_nilai/{id_mhs}', [AdminController::class, 'viewNilai'])->name('lihat_nilai');
Route::get('/view_tambah_skl/{id_mhs}', [AdminController::class, 'viewTambahSKL'])->name('view_tambah_skl');
Route::post('/tambah_skl/{id_mhs}', [AdminController::class, 'tambahSKL'])->name('tambah_skl');
Route::get('/view_edit_skl/{id_mhs}', [AdminController::class, 'viewEditSKL'])->name('view_edit_skl');
Route::post('/update_skl/{id_mhs}', [AdminController::class, 'updateSKL'])->name('update_skl');
Route::match(['get', 'post'], '/delete_skl/{id_mhs}', [AdminController::class, 'deleteSKL'])->name('delete_skl');
Route::get('/view_berita', [AdminController::class, 'viewBerita'])->middleware('only_admin')->name('view_berita');
Route::get('/view_tambah_berita', [AdminController::class, 'viewTambahBerita'])->name('view_tambah_berita');
Route::post('/tambah_berita', [AdminController::class, 'tambahBerita'])->name('tambah_berita');
Route::post('/delete_berita/{id_berita}', [AdminController::class, 'deleteBerita'])->name('delete_berita');
Route::get('/view_edit_berita/{id_berita}', [AdminController::class, 'viewEditBerita'])->name('view_edit_berita');
Route::post('/update_berita/{id_berita}', [AdminController::class, 'updateBerita'])->name('update_berita');
Route::get('/tambah_absen', [AdminController::class, 'viewTambahAbsen'])->name('tambah_absen');
Route::post('/store_absen', [AdminController::class, 'storeAbsen'])->name('store_absen');
Route::get('/dashboard_admin_filter', [AdminController::class, 'filterDashboard'])->name('dashboard_admin_filter');
Route::post('/change_password_admin', [AdminController::class, 'change_password'])->name('password_admin');

Route::get('/rekap_presensi', [AdminController::class, 'viewRekapPresensi'])->name('rekap_presensi');
Route::get('/edit_absen/{id_absen}', [AdminController::class, 'edit_absen'])->name('edit_absen');
Route::post('/update_absen/{id_absen}', [AdminController::class, 'update_absen'])->name('update_absen');
Route::post('/delete_absen/{id_absen}', [AdminController::class, 'delete_absen'])->name('delete_absen');

Route::get('/rekap_mhs/{id_absen}', [AdminController::class, 'rekap_mhs'])->name('rekap_mhs_admin');
Route::get('/verif_absen/{id_absen}/{id_mhs}', [AdminController::class, 'verif_absen'])->name('verif_absen');
Route::get('/filter_absen/{id_absen}', [AdminController::class, 'filterStatusAbsen'])->name('filter_absen');
Route::get('/verified_all_absen/{id_absen}', [AdminController::class, 'verifiedAllAbsen'])->name('verifiedAllAbsen');

/* Mentor */
Route::get('/dashboard_mentor', [MentorController::class, 'index'])->middleware('only_mentor')->name('dashboard_mentor');
Route::get('/daftar_mhs_mentor', [MentorController::class, 'viewDaftarMhs'])->middleware('only_mentor')->name('daftar_mhs_mentor');
Route::get('/search_mhs', [MentorController::class, 'searchMahasiswa'])->name('search_mhs');
Route::get('/filter_mhs', [MentorController::class, 'filterByStatus'])->name('filter_mhs');
Route::get('/view_presensi_mentor/{id_mhs}', [MentorController::class, 'viewPresensi'])->name('view_presensi_mentor');
Route::get('/view_progress_mentor/{id_mhs}', [MentorController::class, 'viewProgress'])->name('view_progress_mentor');
Route::get('/view_profil_mentor', [MentorController::class, 'viewProfile'])->middleware('only_mentor')->name('view_profil_mentor');
Route::get('/edit_profil_mentor', [MentorController::class, 'viewEditProfile'])->middleware('only_mentor')->name('edit_profil_mentor');
Route::post('/edit_profil_mentor', [MentorController::class, 'update'])->name('edit_profil_mentor');
Route::get('/view_nilai_mentor/{id_mhs}', [MentorController::class, 'viewNilai'])->name('view_nilai_mentor');
Route::post('/store_nilai/{id_mhs}', [MentorController::class, 'storeNilai'])->name('store_nilai');
Route::get('/edit_nilai_mentor/{id_mhs}', [MentorController::class, 'viewEditNilai'])->name('edit_nilai_mentor');
Route::post('/edit_nilai_mentor_access/{id_mhs}', [MentorController::class, 'viewEditNilai2'])->name('edit_nilai_mentor_access');
Route::post('/edit_nilai_mentor/{id_mhs}', [MentorController::class, 'storeNilai1'])->name('edit_nilai_mentor');
Route::match(['get', 'post'], '/delete_nilai/{id_mhs}', [MentorController::class, 'deleteNilai'])->name('delete_nilai');

Route::get('/tambah_progress', [MentorController::class, 'viewTambahProgress'])->name('tambah_progress');
Route::post('/store_progress', [MentorController::class, 'storeProgress'])->name('store_progress');

Route::post('/change_password_mentor', [MentorController::class, 'change_password'])->name('password_mentor');

Route::get('/rekap_progress', [MentorController::class, 'viewRekapProgress'])->name('rekap_progress');
Route::get('/edit_progress/{id_progress}', [MentorController::class, 'edit_progress'])->name('edit_progress');
Route::post('/update_progress/{id_progress}', [MentorController::class, 'update_progress'])->name('update_progress');
Route::post('/delete_progress/{id_progress}', [MentorController::class, 'delete_progress'])->name('delete_progress');

Route::get('/search_progress', [MentorController::class, 'searchProgress'])->name('search_progress');
Route::get('/rekap_mhs/{id_progress}', [MentorController::class, 'rekap_mhs'])->name('rekap_mhs');
Route::get('/verif_progress/{id_progress}/{id_mhs}', [MentorController::class, 'verif_progress'])->name('verif_progress');
Route::get('/filter_progress/{id_progress}', [MentorController::class, 'filterStatusProgress'])->name('filter_progress');
Route::get('/filter_nilai', [MentorController::class, 'filterByNilai'])->name('filter_nilai');
Route::get('/dashboard_mentor_filter', [MentorController::class, 'filterDashboard'])->name('dashboard_mentor_filter');
Route::get('/verified_all_progress/{id_progress}', [MentorController::class, 'verifiedAllProgress'])->name('verifiedAllProgress');

Route::get('/filter_sesi_absen/{id_mhs}', [MentorController::class, 'filterSesiAbsen'])->name('filterSesiAbsen');
Route::get('/filter_status_absen/{id_mhs}', [MentorController::class, 'filterStatusAbsen'])->name('filterStatusAbsen');
Route::get('/filter_keterangan_absen/{id_mhs}', [MentorController::class, 'filterKetAbsen'])->name('filterKetAbsen');
Route::get('/filter_status_progress/{id_mhs}', [MentorController::class, 'filterStatusProgress2'])->name('filterStatusProgress2');