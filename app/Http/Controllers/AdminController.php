<?php

namespace App\Http\Controllers;

use App\Http\Middleware\OnlyAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Mentor;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Progress;
use App\Models\Absen;
use App\Models\Skl;
use App\Models\Nilai;
use App\Models\Berita;
use App\Models\GeneratedAccount;
use App\Models\GeneratedAbsen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index(Request $request) 
    {
        if (auth()->check()) {
            $user = Auth::user();
            $admin = Admin::where('id_user', $user->id)->first();
            $nipAdmin = $admin->nip;

            $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('mahasiswa.nip_admin', $nipAdmin)
                ->select(
                    'mahasiswa.id_mhs',
                    'mahasiswa.nama',
                    'mahasiswa.status',
                    'users.foto as foto',
                )
                ->get();

            $skl1 = Skl::join('mahasiswa', 'skl.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('skl.nip_admin', $nipAdmin)
                ->get();

            $skl2 = Mahasiswa::leftJoin('skl', 'mahasiswa.id_mhs', '=', 'skl.id_mhs')
                ->where('mahasiswa.nip_admin', $nipAdmin)
                ->whereNull('skl.id_mhs') 
                ->get();
            
            $mahasiswaVerifikasiPresensi = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('mahasiswa.nip_admin', $nipAdmin)
                ->where('absen.status', '=', 'Unverified')
                ->get();

            $mhsAbsen = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('mahasiswa.nip_admin', $nipAdmin)
                ->where('absen.status', 'Verified')
                ->get();

            $mhsProgress = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('mahasiswa.nip_admin', $nipAdmin)
                ->where('progress.status', 'Verified')
                ->get();

            $totalMahasiswa = Mahasiswa::where('nip_admin', $nipAdmin)->count();

            $totalAktif = Mahasiswa::where('nip_admin', $nipAdmin)
                ->where('status', 'Aktif')
                ->count();

            $totalNonAktif = Mahasiswa::where('nip_admin', $nipAdmin)
                ->where('status', 'Tidak Aktif')
                ->count();

            $totalLulus = Mahasiswa::where('nip_admin', $nipAdmin)
                ->where('status', 'Lulus')
                ->count();

            $berita = Berita::all();

            return view('admin.dashboard', compact('berita', 'totalMahasiswa', 'totalAktif', 'totalNonAktif', 'totalLulus', 'admin', 'mahasiswa', 'skl1', 'skl2', 'mahasiswaVerifikasiPresensi', 'mhsAbsen', 'mhsProgress'));
        }

        return redirect()->route('login');
    }

    public function filterDashboard(Request $request)
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();

        $nipAdmin = $admin->nip;
        
        $status = $request->input('status');

        if (!empty($status)) {
            $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('status', $status)
                ->where('nip_admin', $nipAdmin)
                ->select(
                    'mahasiswa.id_mhs',
                    'mahasiswa.nama',
                    'mahasiswa.status',
                    'users.foto as foto',
                )
                ->get();
        } else {
            $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('nip_admin', $nipAdmin)
            ->select(
                'mahasiswa.id_mhs',
                'mahasiswa.nama',
                'mahasiswa.status',
                'users.foto as foto',
            )
            ->get();
        }

        $mhsAbsen = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->where('absen.status', 'Verified')
            ->get();

        $mhsProgress = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->where('progress.status', 'Verified')
            ->get();

        $skl1 = Skl::join('mahasiswa', 'skl.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('skl.nip_admin', $nipAdmin)
            ->get();

        $skl2 = Mahasiswa::leftJoin('skl', 'mahasiswa.id_mhs', '=', 'skl.id_mhs')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->whereNull('skl.id_mhs') 
            ->get();

        $mahasiswaVerifikasiPresensi = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->where('absen.status', '=', 'Unverified')
            ->get();

        $totalMahasiswa = Mahasiswa::where('nip_admin', $nipAdmin)->count();

        $totalAktif = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Aktif')
            ->count();

        $totalNonAktif = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Tidak Aktif')
            ->count();

        $totalLulus = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Lulus')
            ->count();

        return view('admin.dashboard', compact('totalMahasiswa', 'totalAktif', 'totalNonAktif', 'totalLulus', 'admin', 'mahasiswa', 'mhsAbsen', 'mhsProgress', 'skl1', 'skl2', 'mahasiswaVerifikasiPresensi'));
    }

    public function viewProfile()
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();

        return view('admin.profile', ['admin' => $admin]);
    }

    public function change_password(Request $request)
    {
        // Check old password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error1', 'Password lama salah!');
        }

        // Check new password and configuration
        if ($request->new_password != $request->config_password) {
            return back()->with('error2', 'Konfigurasi password salah!');
        }

        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', 'Password berhasil diperbarui!');
    }

    public function viewEditProfile()
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();

        return view('admin.edit_profile', ["admin" =>  $admin]);
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            $admin = Admin::where('id_user', $user->id)->first();

            $validated = $request->validate([
                'alamat' => 'required',
                'no_telepon' => 'required',
                'email' => 'required',
                'username' => 'required',
                'foto' => 'nullable|image|max:10240',
            ]);
        
            if ($request->has('foto')) {
                $fotoPath = $request->file('foto')->store('profile', 'public');
                
                $validated['foto'] = $fotoPath;

                $user->update([
                    'foto' => $validated['foto'],
                ]);
            }
            
            $admin->alamat = $request->alamat;
            $admin->no_telepon = $request->no_telepon;
            $admin->email = $request->email;
            $user->username = $request->username;
            
            $admin->save();

            $user->update([
                'username' => $request->username
            ]);
            
            return redirect()->route('view_profil')->with('success', 'Data admin berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('view_profil')->with('error', 'Terjadi kesalahan saat memperbarui data admin: ' . $e->getMessage());
        }
    }

    public function viewDaftarMhs()
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();

        $nipAdmin = $admin->nip;

        $mhsData = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->join('mentor', 'mahasiswa.nip_mentor', '=', 'mentor.nip')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->select(
                'mahasiswa.id_mhs',
                'mahasiswa.nama',
                'mahasiswa.jurusan',
                'mahasiswa.instansi',
                'mahasiswa.status',
                'users.foto as foto',
                'mentor.nama as mentor',
            )
            ->get();

        $totalMahasiswa = Mahasiswa::where('nip_admin', $nipAdmin)->count();

        $totalAktif = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Aktif')
            ->count();

        $totalNonAktif = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Tidak Aktif')
            ->count();

        $totalLulus = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Lulus')
            ->count();

        return view('admin.daftar_mhs', compact('mhsData', 'totalMahasiswa', 'totalAktif', 'totalNonAktif', 'totalLulus'));
    }

    public function filterByStatusAdmin(Request $request)
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();

        $nipAdmin = $admin->nip;

        $status = $request->input('status');

        if (!empty($status)) {
            $mhsData = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('status', $status)
            ->join('mentor', 'mahasiswa.nip_mentor', '=', 'mentor.nip')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->select(
                'mahasiswa.id_mhs',
                'mahasiswa.nama',
                'mahasiswa.jurusan',
                'mahasiswa.instansi',
                'mahasiswa.status',
                'users.foto as foto',
                'mentor.nama as mentor',
            )
            ->get();
        } else {
            $mhsData = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->join('mentor', 'mahasiswa.nip_mentor', '=', 'mentor.nip')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->select(
                'mahasiswa.id_mhs',
                'mahasiswa.nama',
                'mahasiswa.jurusan',
                'mahasiswa.instansi',
                'mahasiswa.status',
                'users.foto as foto',
                'mentor.nama as mentor',
            )
            ->get();
        }

        $totalMahasiswa = Mahasiswa::where('nip_admin', $nipAdmin)->count();

        $totalAktif = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Aktif')
            ->count();

        $totalNonAktif = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Tidak Aktif')
            ->count();

        $totalLulus = Mahasiswa::where('nip_admin', $nipAdmin)
            ->where('status', 'Lulus')
            ->count();

        return view('admin.daftar_mhs', compact('mhsData', 'totalMahasiswa', 'totalAktif', 'totalNonAktif', 'totalLulus'));
    }


    public function viewProgress(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
        $progressMagang = Progress::where('id_mhs', $mhs->id_mhs)->get();

        return view('admin.progress', [
            'mahasiswa' => $mhs,
            'foto' => $foto,
            'progressMagang' => $progressMagang,
        ]);
    }

    public function viewEditStatus(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();

        if (!$mhs) {
            return redirect()->route('daftar_mhs')->with('error', 'Mahasiswa tidak ditemukan');
        }

        $user = User::find($mhs->id_user);

        if (!$user) {
            return redirect()->route('daftar_mhs')->with('error', 'User tidak ditemukan');
        }

        $foto = $user->getImageURL();

        return view('admin.edit_status', [
            'mahasiswa' => $mhs,
            'foto' => $foto
        ]);
    }


    public function delete2($id_mhs)
    {
        try {
            $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();

            if (!$mhs) {
                return redirect()->back()->with('error', 'Mahasiswa not found.');
            }

            $akun = GeneratedAccount::where('id_mhs', $id_mhs)->first();

            if ($akun) {
                $akun->delete();
            }

            $mhs->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus data mahasiswa.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data mahasiswa.');
        }
    }

    public function update2(Request $request, string $id_mhs)
    {
        try {
            $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();

            if (!$mhs) {
                return redirect()->route('daftar_mhs')->with('error', 'Mahasiswa tidak ditemukan');
            }

            $user = User::find($mhs->id_user);

            $validated = $request->validate([
                'nama' => 'required',
                'instansi' => 'nullable',
                'jurusan' => 'nullable',
                'alamat' => 'nullable',
                'no_telepon' => 'nullable|numeric',
                'email' => 'nullable|email',
                'status' => 'required|in:Aktif,Tidak Aktif,Lulus',
                'username' => 'required|unique:users,username,' . $mhs->id_user,
                'foto' => 'nullable|image|max:10240',
            ]);

            // Update User
            if ($request->has('foto')) {
                $fotoPath = $request->file('foto')->store('profile', 'public');
                $user->foto = $fotoPath;
            }

            $user->username = $request->username;
            $user->save();

            // Update Mahasiswa
            $mhs->nama = $request->nama;
            $mhs->instansi = $request->instansi;
            $mhs->jurusan = $request->jurusan;
            $mhs->alamat = $request->alamat;
            $mhs->no_telepon = $request->no_telepon;
            $mhs->email = $request->email;
            $mhs->status = $request->status;
            $mhs->save();

            return redirect()->route('daftar_mhs')->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('daftar_mhs')->with('error', 'Terjadi kesalahan saat memperbarui data mahasiswa.');
        }
    }

    public function showEntryMhs()
    {
        $admin = Admin::all();
        $mentor = Mentor::all();

        return view('admin.entry_mhs', ['admin' => $admin, 'mentor' => $mentor]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_mhs' => 'required|unique:mahasiswa,id_mhs|max:14',
            'nama' => 'required|max:255',
            'instansi' => 'required|max:255',
            'jurusan' => 'required|max:255',
            'mentor' => 'required',
        ]);

        if ($request->submit === 'generate') {
            DB::beginTransaction();

            try {
                $username = Str::slug($request->nama, '') . Str::random(4);
                $password = Str::random(10);

                $user = User::create([
                    'name' => $request->nama,
                    'username' => $username,
                    'password' => Hash::make($password),
                    'id_role' => 3,
                ]);

                if (!$user) {
                    DB::rollback();
                    return redirect()->route('entry_mhs')->with('error', 'Gagal membuat pengguna.');
                }

                $mahasiswa = new Mahasiswa();
                $mahasiswa->id_mhs = $request->id_mhs;
                $mahasiswa->nama = $request->nama;
                $mahasiswa->instansi = $request->instansi;
                $mahasiswa->jurusan = $request->jurusan;
                $mahasiswa->mulai_magang = $request->mulai_magang;
                $mahasiswa->selesai_magang = $request->selesai_magang;
                $mahasiswa->nip_mentor = $request->mentor;
                $mahasiswa->id_user = $user->id;

                $mahasiswa->save();

                GeneratedAccount::create([
                    'nama' => $mahasiswa->nama,
                    'id_mhs' => $mahasiswa->id_mhs,
                    'username' => $username,
                    'password' => $password,
                ]);

                DB::commit();

                return redirect()->route('entry_mhs')
                    ->with('success', 'Data dan akun berhasil ditambahkan. Username: ' . $username . ' dan password: ' . $password)->withInput();
            } catch (\Exception $e) {

                DB::rollback();
                return redirect()->route('entry_mhs')
                    ->with('error', 'Gagal menambahkan data dan akun.');
            }
        }
    }

    public function viewAccount()
    {
        $accounts = DB::table('generate_account')
            ->join('mahasiswa', 'mahasiswa.id_mhs', '=', 'generate_account.id_mhs')
            ->where('mahasiswa.check_profil', '=', 0)
            ->select('generate_account.*')
            ->get();
  
        return view('admin.daftar_akun', compact('accounts'));
    }

    public function cetakDaftarAkun()
    {
        $accounts = GeneratedAccount::all();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.daftar_akun_pdf', ['accounts' => $accounts]);
        return $pdf->stream('daftar_akun.pdf');
    }

    public function viewPresensi()
    {
        $verifikasiPresensiData = Absen::with('mahasiswa')->get();
        return view('admin.verifikasi_presensi', compact('verifikasiPresensiData'));
    }

    public function filterPresensi(Request $request)
    {
        $filter = $request->input('filter');

        $query = Absen::query();

        if ($filter && $filter !== 'all') {
            $query->where('status', $filter);
        }

        $verifikasiPresensiData = $query->get();

        return view('admin.verifikasi_presensi', compact('verifikasiPresensiData'));
    }

    public function searchPresensi(Request $request)
    {
        $search = $request->input('search');

        $query = Absen::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id_mhs', 'like', "%$search%")
                    ->orWhere('nama', 'like', "%$search%")
                    ->orWhere('instansi', 'like', "%$search%")
                    ->orWhere('jurusan', 'like', "%$search%");
            });
        }

        $verifikasiPresensiData = $query->get();

        return view('admin.verifikasi_presensi', compact('verifikasiPresensiData'));
    }

    public function verifyPresensi($id_mhs)
    {
        $presensi = Absen::where('id_mhs', $id_mhs)->first();

        if ($presensi) {
            if ($presensi->status === 'Unverified') {
                $presensi->status = 'Verified';
                $presensi->save();

                return redirect()->route('view_presensi')->with('success', 'Presensi berhasil diverifikasi.');
            }
        } else {
            return redirect()->route('view_presensi')->with('error', 'Presensi tidak ditemukan.');
        }
    }
    
    public function viewSKL()
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();
        $nipAdmin = $admin->nip;

        $mhsData = Mahasiswa::whereHas('nilai')
            ->join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('nip_admin', $nipAdmin)
            ->select(
                'mahasiswa.id_mhs',
                'mahasiswa.nama',
                'mahasiswa.jurusan',
                'mahasiswa.instansi',
                'users.foto as foto',
            )
            ->get();

        $skl1 = Skl::join('mahasiswa', 'skl.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('skl.nip_admin', $nipAdmin)
            ->get();

        $skl2 = Mahasiswa::leftJoin('skl', 'mahasiswa.id_mhs', '=', 'skl.id_mhs')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->whereNull('skl.id_mhs') 
            ->get();

        $totalMahasiswa = Mahasiswa::where('nip_admin', $nipAdmin)->count();

        return view('admin.daftar_skl', compact('mhsData', 'skl1', 'skl2', 'totalMahasiswa'));
    }

    public function filterSKL(Request $request)
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();
        $nipAdmin = $admin->nip;

        $status = $request->input('status');

        if (!empty($status)) {
            $mhsData = Mahasiswa::whereHas('nilai')
                ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->whereHas('skl')
                ->where('nip_admin', $nipAdmin)
                ->select(
                    'mahasiswa.id_mhs',
                    'mahasiswa.nama',
                    'mahasiswa.jurusan',
                    'mahasiswa.instansi',
                    'users.foto as foto',
                )
                ->get();
        } else {
            $mhsData = Mahasiswa::whereHas('nilai')
                ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('nip_admin', $nipAdmin)
                ->select(
                    'mahasiswa.id_mhs',
                    'mahasiswa.nama',
                    'mahasiswa.jurusan',
                    'mahasiswa.instansi',
                    'users.foto as foto',
                )
                ->get();
        }

        $skl1 = Skl::join('mahasiswa', 'skl.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('skl.nip_admin', $nipAdmin)
            ->get();

        $skl2 = Mahasiswa::leftJoin('skl', 'mahasiswa.id_mhs', '=', 'skl.id_mhs')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->whereNull('skl.id_mhs') 
            ->get();

        $totalMahasiswa = Mahasiswa::where('nip_admin', $nipAdmin)->count();

        return view('admin.daftar_skl', compact('mhsData', 'skl1', 'skl2', 'totalMahasiswa'));
    }

    public function viewNilai(string $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();
        $nilai = Nilai::where('id_mhs', $id_mhs)->first();

        $absenPagi = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
            ->where('absen.status', 'Verified')
            ->where('generate_absen.sesi', 'Pagi')
            ->where('absen.id_mhs', $id_mhs)
            ->get();

        $absenSore = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
            ->where('absen.status', 'Verified')
            ->where('generate_absen.sesi', 'Sore')
            ->where('absen.id_mhs', $id_mhs)
            ->get();

        $progVer = Progress::where('id_mhs', $mahasiswa->id_mhs)
            ->where('progress.status', 'Verified')
            ->get();
       
        return view('admin.lihat_nilai', compact('mahasiswa', 'foto', 'nilai', 'absenPagi', 'absenSore', 'progVer'));
    }

    public function viewTambahSKL(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
       
        return view('admin.tambah_skl', [
            'mahasiswa' => $mhs,
            'foto' => $foto]);
    }

    public function tambahSKL(Request $request, $id_mhs)
    {
        $request->validate([
            'file_skl' => 'required|mimes:pdf|max:2048',
        ]);
    
        try {
            $fileSklPath = $request->file_skl->store('skl', 'public');
            $user = Auth::user();
            $admin = Admin::where('id_user', $user->id)->first();
    
            $skl = new Skl();
            $skl->id_mhs = $request->id_mhs;
            $skl->nip_admin = $admin->nip;
            $skl->file_skl = $fileSklPath;
            $skl->save();
    
            $mahasiswa = Mahasiswa::find($id_mhs);
            $mahasiswa->status = 'Lulus';
            $mahasiswa->save();
    
            return redirect()->route('skl_mhs')->with('success', 'SKL berhasil ditambahkan. Mahasiswa atas nama ' . $mahasiswa->nama . ' dinyatakan LULUS.');
        } catch (\Exception $e) {
            return redirect()->route('skl_mhs')->with('error', 'Terjadi kesalahan saat menambah SKL.');
        }
    }    

    public function viewEditSKL(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
        return view('admin.edit_skl', [
            'mahasiswa' => $mhs,
            'foto' => $foto]);
    }

    public function viewEditNilai(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
        $nilai = Nilai::where('id_mhs', $id_mhs)->first();
       
        return view('mentor.view_edit_nilai', [
            'mahasiswa' => $mhs,
            'foto' => $foto,
            'nilai' => $nilai]);
    }

    public function updateSKL(Request $request, $id_mhs)
    {
        $request->validate([
            'file_skl' => 'required|mimes:pdf|max:2048',
        ]);

        try {
            $skl = Skl::where('id_mhs', $id_mhs)->first();

            if (!$skl) {
                return redirect()->route('skl_mhs')->with('error', 'SKL tidak ditemukan.');
            }

            Storage::disk('public')->delete($skl->file_skl);

            $fileSklPath = $request->file_skl->store('skl', 'public');

            $skl->file_skl = $fileSklPath;
            $skl->save();

            return redirect()->route('skl_mhs')->with('success', 'SKL berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('skl_mhs')->with('error', 'Terjadi kesalahan saat memperbarui SKL.');
        }
    }


    public function deleteSKL(string $id_mhs)
    {
        try {
            $skl = SKL::where('id_mhs', $id_mhs)->first();

            if (!$skl) {
                return redirect()->route('daftar_skl')->with('error', 'SKL mahasiswa tidak ditemukan.');
            }

            $mahasiswa = Mahasiswa::find($skl->id_mhs);
            $mahasiswa->status = 'Aktif';
            $mahasiswa->save();

            $skl->delete();

            return redirect()->route('skl_mhs')->with('success', 'SKL mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('skl_mhs')->with('error', 'Terjadi kesalahan saat menghapus SKL mahasiswa.');
        }
    }


    public function viewTambahAbsen() 
    {
        $tambahAbsen = DB::table('generate_absen')
            ->join('absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
            ->select('generate_absen.*')
            ->get();
        
        return view('admin.tambah_absen', ["tambahAbsen" => $tambahAbsen]);
    }

    public function storeAbsen(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'mulai_absen' => 'required|date',
            'selesai_absen' => 'required|date',
            'sesi' => 'required',
        ]);

        if ($request->submit === 'generate') {
            DB::beginTransaction();

            try {
                $generateAbsen = GeneratedAbsen::create([
                    'judul' => $request->judul,
                    'deskripsi' => $request->deskripsi,
                    'mulai_absen' => $request->mulai_absen,
                    'selesai_absen' => $request->selesai_absen,
                    'sesi' => $request->sesi,
                ]);

                if (!$generateAbsen) {
                    DB::rollback();
                    return redirect()->route('tambah_absen')->with('error', 'Gagal men-generate presensi!');
                }

                DB::commit();

                return redirect()->route('tambah_absen')->with('success', 'Berhasil menambahkan presensi!');
            } catch (\Exception $e) {
                // dd($e->getMessage());
                DB::rollback();
                return redirect()->route('tambah_absen')->with('error', 'Gagal menambahkan presensi!');
            }
        } 
    }

    public function viewBerita()
    {
        $berita = Berita::all();

        return view('admin.daftar_berita', ['berita' => $berita]);
    }

    public function viewTambahBerita()
    {
        return view('admin.tambah_berita');
    }

    public function tambahBerita(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();
        
        try {
            $berita = Berita::create([
                'nip_admin' => $admin->nip,
                'nama' => $request->nama,
            ]);

            $gambar = $request->gambar->store('berita', 'public');

            $berita->gambar = $gambar;
            $berita->save();

            return redirect()->route('view_berita')->with('success', 'Event berhasil ditambahkan.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('view_berita')->with('error', 'Terjadi kesalahan saat menambahkan event.');
        }
    }

    public function deleteBerita($id_berita)
    {
        try {
            $berita = Berita::where('id_berita', $id_berita)->first();
            
            $berita->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus event.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus event.');
        }
    }

    public function viewEditBerita($id_berita)
    {
        $berita = Berita::where('id_berita', $id_berita)->first();
       
        return view('admin.view_edit_berita', ['berita' => $berita]);
    }

    public function updateBerita(Request $request, $id_berita)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        try {
            $berita = Berita::findOrFail($id_berita);

            $berita->nama = $request->nama;

            if ($request->hasFile('gambar')) {
                if ($berita->gambar && Storage::exists($berita->gambar)) {
                    Storage::delete($berita->gambar);
                }

                $gambarPath = $request->file('gambar')->store('berita', 'public');
                $berita->gambar = $gambarPath;
            }

            $berita->save();

            return redirect()->route('view_berita')->with('success', 'Event berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->route('view_berita')->with('error', 'Terjadi kesalahan saat mengubah event.');
        }
    }

    public function viewRekapPresensi()
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();

        $nipAdmin = $admin->nip;

        $generate_absen = Absen::rightJoin('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
            ->groupBy(
                'generate_absen.id_absen', 
                'generate_absen.judul', 
                'generate_absen.deskripsi', 
                'generate_absen.sesi', 
                'generate_absen.mulai_absen', 
                'generate_absen.selesai_absen'
            )
            ->select(
                'generate_absen.id_absen as id_absen',
                'generate_absen.judul as judul',
                'generate_absen.deskripsi as deskripsi',
                'generate_absen.sesi',
                'generate_absen.mulai_absen as mulai_absen',
                'generate_absen.selesai_absen as selesai_absen',
                DB::raw('MAX(absen.status) as status'),
                DB::raw('SUM(CASE WHEN absen.status = "Unverified" THEN 1 ELSE 0 END) as unverified_count')
            )
            ->orderBy('generate_absen.id_absen', 'desc')
            ->get();

        return view('admin.rekap_presensi', compact('generate_absen'));
    }

    public function edit_absen($id_absen)
    {
        $generate_absen = GeneratedAbsen::where('id_absen', $id_absen)
            ->select(
                'generate_absen.judul',
                'generate_absen.deskripsi',
                'generate_absen.sesi',
                'generate_absen.mulai_absen',
                'generate_absen.selesai_absen',
            )
            ->first();
        
        return view('admin.edit_absen', compact('generate_absen', 'id_absen'));
    }

    public function update_absen(Request $request, $id_absen)
    {
        $generate_absen = GeneratedAbsen::where('id_absen', $id_absen)->first();
    
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'sesi' => 'required',
            'mulai_absen' => 'required|date',
            'selesai_absen' => 'required|date',
        ]);
    
        $generate_absen->judul = $request->judul;
        $generate_absen->deskripsi = $request->deskripsi;
        $generate_absen->sesi = $request->sesi;
        $generate_absen->mulai_absen = $request->mulai_absen;
        $generate_absen->selesai_absen = $request->selesai_absen;

        // $updated_at = $request->input('updated_at');
        // $generate_absen->updated_at = $updated_at;
    
        $absenChanged = $generate_absen->isDirty(); 
    
        if ($generate_absen->save()) {
            if ($absenChanged) {
                return redirect()->back()->with(['success' => 'Personal information updated successfully!'] + compact('generate_absen', 'id_absen'));
            } else {
                return redirect()->back()->with(['info' => 'No changes made.'] + compact('generate_absen', 'id_absen'));
            }
        } else {
            return redirect()->back()->with(['info' => 'Failed to update personal information.'] + compact('generate_absen', 'id_absen'));
        }   
    }

    public function delete_absen($id_absen)
    {
        try {
            $generate_absen = GeneratedAbsen::where('id_absen', $id_absen)->first();

            $generate_absen->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus record absen!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus record absen.');
        }
    }  

    public function rekap_mhs($id_absen)
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();
        $nipAdmin = $admin->nip;

        $rekapMhs = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
            ->join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->where('id_absen', $id_absen)
            ->select(
                'absen.id_absen as id_absen',
                'absen.id_mhs as id_mhs',
                'absen.tanggal as tanggal',
                'absen.status as status',
                'absen.foto as foto_absen',
                'mahasiswa.nama as nama',
                'mahasiswa.jurusan as jurusan',
                'mahasiswa.instansi as instansi',
                'users.foto as foto',
            )
            ->get();

        $generate_absen = GeneratedAbsen::where('id_absen', $id_absen)
            ->select(
                'generate_absen.judul',
                'generate_absen.sesi',
                'generate_absen.mulai_absen',
                'generate_absen.selesai_absen',
            )
            ->first();

        $status_absen = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->where('id_absen', $id_absen)
            ->select(
                'absen.status as status',
            )
            ->get();

        $mahasiswa = Mahasiswa::where('nip_admin', $nipAdmin)
            ->select(
                'mahasiswa.status as status_mhs',
            )
            ->get();

        return view('admin.rekap_mahasiswa', compact('rekapMhs', 'generate_absen', 'id_absen', 'status_absen', 'mahasiswa'));
    }

    public function verif_absen($id_absen, $id_mhs)
    {
        $absen = Absen::where('id_absen', $id_absen)
            ->where('id_mhs', $id_mhs)
            ->first();

        if ($absen) {
            if ($absen->status === 'Unverified') {
                $absen->status = 'Verified';

                $absen->save();

                return redirect()->back()->with('success', 'Absen berhasil diverifikasi!');
            }
        } else {
            return redirect()->back()->with('erorr', 'Absen tidak ditemukan!');
        }
    }
    
    public function filterStatusAbsen(Request $request, $id_absen)
    {        
        $status = $request->input('status');
    
        if (!empty($status)) {
            $rekapMhs = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
                ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('absen.status', $status)
                ->where('id_absen', $id_absen)
                ->select(
                    'absen.id_absen as id_absen',
                    'absen.id_mhs as id_mhs',
                    'absen.tanggal as tanggal',
                    'absen.status as status',
                    'absen.foto as foto_absen',
                    'mahasiswa.nama as nama',
                    'mahasiswa.jurusan as jurusan',
                    'mahasiswa.instansi as instansi',
                    'users.foto as foto',
                )
                ->get();
        } else {
            $rekapMhs = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
                ->join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('id_absen', $id_absen)
                ->select(
                    'absen.id_absen as id_absen',
                    'absen.id_mhs as id_mhs',
                    'absen.tanggal as tanggal',
                    'absen.status as status',
                    'absen.foto as foto_absen',
                    'mahasiswa.nama as nama',
                    'mahasiswa.jurusan as jurusan',
                    'mahasiswa.instansi as instansi',
                    'users.foto as foto',
                )
                ->get();
        }

        $generate_absen = GeneratedAbsen::where('id_absen', $id_absen)
        ->select(
            'generate_absen.judul',
            'generate_absen.sesi',
            'generate_absen.mulai_absen',
            'generate_absen.selesai_absen',
        )
        ->first();

        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();
        $nipAdmin = $admin->nip;

        $status_absen = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_admin', $nipAdmin)
            ->where('id_absen', $id_absen)
            ->select(
                'absen.status as status',
            )
            ->get();

        $mahasiswa = Mahasiswa::where('nip_admin', $nipAdmin)
            ->select(
                'mahasiswa.status as status_mhs',
            )
            ->get();
    
        return view('admin.rekap_mahasiswa', compact('rekapMhs', 'generate_absen', 'id_absen', 'status_absen', 'mahasiswa'));
    } 

    public function verifiedAllAbsen($id_absen) {
        $absens = Absen::where('id_absen', $id_absen)
            ->where('status', 'Unverified')
            ->get();
    
        if ($absens->isNotEmpty()) {
            foreach ($absens as $absen) {
                $absen->status = 'Verified';
                $absen->save();
            }
    
            return redirect()->back()->with('success', 'Semua absen berhasil diverifikasi!');
        } else {
            return redirect()->back()->with('error', 'Semua absen sudah diverifikasi atau tidak ditemukan!');
        }
    }
}
