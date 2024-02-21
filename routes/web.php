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
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('dashboard_mahasiswa');

    Route::get('/mahasiswa/form', [MahasiswaController::class, 'form'])->name('form_mahasiswa');
    Route::post('/store_form', [MahasiswaController::class, 'store'])->name('save');

    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'profile'])->name('profile_mahasiswa');
    Route::get('/mahasiswa/profile/edit', [MahasiswaController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/update_profile', [MahasiswaController::class, 'update_profile'])->name('update_profile');

    Route::post('/change_password', [MahasiswaController::class, 'change_password'])->name('password_mahasiswa');

    Route::get('/mahasiswa/presensi', [MahasiswaController::class, 'presensi'])->name('presensi_mahasiswa');
    Route::get('/mahasiswa/presensi/add/{id_absen}', [MahasiswaController::class, 'add_presensi'])->name('add_presensi');
    Route::post('/store_presensi/{id_absen}', [MahasiswaController::class, 'store_presensi'])->name('store_presensi'); 

    Route::get('/mahasiswa/progress', [MahasiswaController::class, 'progress'])->name('progress_mahasiswa');
    Route::get('/mahasiswa/progress/add/{id_progress}', [MahasiswaController::class, 'add_progress'])->name('add_progress');
    Route::post('/store_progress/{id_progress}', [MahasiswaController::class, 'store_progress'])->name('store_progress_mhs');

    Route::get('/mahasiswa/dashboard/download_nilai', [MahasiswaController::class, 'cetak_nilai'])->name('cetak_nilai_mhs');
    Route::get('/mahasiswa/dashboard/download_skl', [MahasiswaController::class, 'cetak_skl'])->name('cetak_skl_mhs');
});

/* Akun */
Route::controller(AccountController::class)->middleware('auth')->group(function () {
    Route::get('/change-password', 'viewChangePassword')->name('account.viewChangePassword');
    Route::post('/change-password', 'update')->name('account.update');
});

/* Admin */
Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('only_admin')->name('dashboard_admin');
Route::get('/admin/dashboard/filter', [AdminController::class, 'filterDashboard'])->name('dashboard_admin_filter');

Route::get('/admin/profile', [AdminController::class, 'viewProfile'])->middleware('only_admin')->name('view_profil');
Route::get('/admin/profile/edit', [AdminController::class, 'viewEditProfile'])->middleware('only_admin')->name('edit_profil');
Route::post('/admin/profile/edit', [AdminController::class, 'update'])->name('edit_profil');
Route::post('/change_password_admin', [AdminController::class, 'change_password'])->name('password_admin');

Route::get('/admin/generate_akun', [AdminController::class, 'showEntryMhs'])->middleware('only_admin')->name('entry_mhs');
Route::get('/admin/daftar_akun', [AdminController::class, 'viewAccount'])->middleware('only_admin')->name('daftar_akun');
Route::get('/admin/daftar_akun/download', [AdminController::class, 'cetakDaftarAkun'])->name('cetak_akun_mhs');

Route::get('/admin/daftar_mahasiswa', [AdminController::class, 'viewDaftarMhs'])->middleware('only_admin')->name('daftar_mhs');
Route::get('/admin/daftar_mahasiswa/filter', [AdminController::class, 'filterByStatusAdmin'])->name('filter_mhs_admin');
Route::get('/admin/daftar_mahasiswa/edit_mahasiswa/{id_mhs}', [AdminController::class, 'viewEditStatus'])->middleware('only_admin')->name('view_edit_status');
Route::post('/edit_mhs/{id_mhs}', [AdminController::class, 'update2'])->name('edit_mhs');
Route::post('/delete_mhs/{id_mhs}', [AdminController::class, 'delete2'])->name('delete_mhs');
Route::post('/store_mhs', [AdminController::class, 'store'])->name('store_mhs');

Route::get('/admin/generate_presensi', [AdminController::class, 'viewTambahAbsen'])->name('tambah_absen');
Route::post('/admin/generate_presensi_simpan', [AdminController::class, 'storeAbsen'])->name('store_absen');
Route::get('/admin/rekapitulasi_presensi', [AdminController::class, 'viewRekapPresensi'])->name('rekap_presensi');
Route::get('/admin/rekapitulasi_presensi/edit/{id_absen}', [AdminController::class, 'edit_absen'])->name('edit_absen');
Route::post('/update_absen/{id_absen}', [AdminController::class, 'update_absen'])->name('update_absen');
Route::post('/delete_absen/{id_absen}', [AdminController::class, 'delete_absen'])->name('delete_absen');
Route::get('/admin/rekapitulasi_presensi/rekapitulasi_mahasiswa/{id_absen}', [AdminController::class, 'rekap_mhs'])->name('rekap_mhs_admin');
Route::get('/admin/rekapitulasi_presensi/rekapitulasi_mahasiswa/verifikasi/{id_absen}/{id_mhs}', [AdminController::class, 'verif_absen'])->name('verif_absen');
Route::get('/admin/rekapitulasi_presensi/rekapitulasi_mahasiswa/filter/{id_absen}', [AdminController::class, 'filterStatusAbsen'])->name('filter_absen');
Route::get('/admin/rekapitulasi_presensi/rekapitulasi_mahasiswa/verifikasi_seluruh_presensi/{id_absen}', [AdminController::class, 'verifiedAllAbsen'])->name('verifiedAllAbsen');

Route::get('/admin/skl_mahasiswa', [AdminController::class, 'viewSKL'])->middleware('only_admin')->name('skl_mhs');
Route::get('/admin/skl_mahasiswa/lihat_nilai/{id_mhs}', [AdminController::class, 'viewNilai'])->name('lihat_nilai');
Route::post('/tambah_skl/{id_mhs}', [AdminController::class, 'tambahSKL'])->name('tambah_skl');
Route::post('/update_skl/{id_mhs}', [AdminController::class, 'updateSKL'])->name('update_skl');
// Route::match(['get', 'post'], '/delete_skl/{id_mhs}', [AdminController::class, 'deleteSKL'])->name('delete_skl');
Route::delete('/delete_skl/{id_mhs}', [AdminController::class, 'deleteSKL'])->name('delete_skl');

Route::get('/admin/berita_acara', [AdminController::class, 'viewBerita'])->middleware('only_admin')->name('view_berita');
Route::post('/tambah_berita', [AdminController::class, 'tambahBerita'])->name('tambah_berita');
Route::post('/update_berita/{id_berita}', [AdminController::class, 'updateBerita'])->name('update_berita');
Route::delete('/delete_berita/{id_berita}', [AdminController::class, 'deleteBerita'])->name('delete_berita');

Route::get('/admin/daftar_mahasiswa/presensi/{id_mhs}', [AdminController::class, 'viewPresensi'])->name('view_presensi_admin');
Route::get('/admin/daftar_mahasiswa/presensi/filter/sesi/{id_mhs}', [AdminController::class, 'filterSesiAbsen'])->name('filterSesiAbsen_admin');
Route::get('/admin/daftar_mahasiswa/presensi/filter/status/{id_mhs}', [AdminController::class, 'filterViewPresensi'])->name('filterViewPresensi');
Route::get('/admin/daftar_mahasiswa/presensi/filter/keterangan/{id_mhs}', [AdminController::class, 'filterKetAbsen'])->name('filterKetAbsen_admin');

Route::get('/admin/daftar_mahasiswa/progress/{id_mhs}', [AdminController::class, 'viewProgress'])->name('view_progress_admin');
Route::get('/admin/daftar_mahasiswa/progress/filter/status/{id_mhs}', [AdminController::class, 'filterStatusProgress2'])->name('filterStatusProgress2_admin');

/* Mentor */
Route::get('/mentor/dashboard', [MentorController::class, 'index'])->middleware('only_mentor')->name('dashboard_mentor');
Route::get('/mentor/daftar_mahasiswa', [MentorController::class, 'viewDaftarMhs'])->middleware('only_mentor')->name('daftar_mhs_mentor');

Route::get('/mentor/daftar_mahasiswa/filter/status', [MentorController::class, 'filterByStatusMentor'])->name('filter_mhs_mentor');
Route::get('/mentor/daftar_mahasiswa/presensi/{id_mhs}', [MentorController::class, 'viewPresensi'])->name('view_presensi_mentor');
Route::get('/mentor/daftar_mahasiswa/progress/{id_mhs}', [MentorController::class, 'viewProgress'])->name('view_progress_mentor');
Route::get('/mentor/profile', [MentorController::class, 'viewProfile'])->middleware('only_mentor')->name('view_profil_mentor');
Route::get('/mentor/profile/edit', [MentorController::class, 'viewEditProfile'])->middleware('only_mentor')->name('edit_profil_mentor');
Route::post('/mentor/profile/edit', [MentorController::class, 'update'])->name('edit_profil_mentor');
Route::get('/mentor/daftar_mahasiswa/add_nilai/{id_mhs}', [MentorController::class, 'viewNilai'])->name('view_nilai_mentor');
Route::post('/store_nilai/{id_mhs}', [MentorController::class, 'storeNilai'])->name('store_nilai');
Route::get('/mentor/daftar_mahasiswa/nilai/{id_mhs}', [MentorController::class, 'viewEditNilai'])->name('edit_nilai_mentor');
Route::post('/mentor/daftar_mahasiswa/nilai/edit/{id_mhs}', [MentorController::class, 'viewEditNilai2'])->name('edit_nilai_mentor_access');
Route::post('/mentor/daftar_mahasiswa/nilai/{id_mhs}', [MentorController::class, 'storeNilai1'])->name('edit_nilai_mentor');
Route::match(['get', 'post'], '/delete_nilai/{id_mhs}', [MentorController::class, 'deleteNilai'])->name('delete_nilai');

Route::get('/mentor/generate_progress', [MentorController::class, 'viewTambahProgress'])->name('tambah_progress');
Route::post('/store_progress', [MentorController::class, 'storeProgress'])->name('store_progress');

Route::post('/change_password_mentor', [MentorController::class, 'change_password'])->name('password_mentor');

Route::get('/mentor/rekapitulasi_progress', [MentorController::class, 'viewRekapProgress'])->name('rekap_progress');
Route::get('/mentor/rekapitulasi_progress/edit/{id_progress}', [MentorController::class, 'edit_progress'])->name('edit_progress');
Route::post('/update_progress/{id_progress}', [MentorController::class, 'update_progress'])->name('update_progress');
Route::post('/delete_progress/{id_progress}', [MentorController::class, 'delete_progress'])->name('delete_progress');

Route::get('/mentor/rekapitulasi_progress/rekapitulasi_mahasiswa/{id_progress}', [MentorController::class, 'rekap_mhs_mentor'])->name('rekap_mhs_mentor');
Route::get('/verif_progress/{id_progress}/{id_mhs}', [MentorController::class, 'verif_progress'])->name('verif_progress');

Route::get('/mentor/rekapitulasi_progress/rekapitulasi_mahasiswa/filter/{id_progress}', [MentorController::class, 'filterStatusProgress'])->name('filter_progress');
Route::get('/filter_nilai', [MentorController::class, 'filterByNilai'])->name('filter_nilai');
Route::get('/dashboard_mentor_filter', [MentorController::class, 'filterDashboard'])->name('dashboard_mentor_filter');
Route::get('/verified_all_progress/{id_progress}', [MentorController::class, 'verifiedAllProgress'])->name('verifiedAllProgress');

Route::get('/mentor/daftar_mahasiswa/presensi/filter/sesi/{id_mhs}', [MentorController::class, 'filterSesiAbsen'])->name('filterSesiAbsen');
Route::get('/mentor/daftar_mahasiswa/presensi/filter/status/{id_mhs}', [MentorController::class, 'filterStatusAbsen'])->name('filterStatusAbsen');
Route::get('/mentor/daftar_mahasiswa/presensi/filter/keterangan/{id_mhs}', [MentorController::class, 'filterKetAbsen'])->name('filterKetAbsen');
Route::get('/mentor/daftar_mahasiswa/progress/filter/status/{id_mhs}', [MentorController::class, 'filterStatusProgress2'])->name('filterStatusProgress2');