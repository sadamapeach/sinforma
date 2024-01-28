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


class AdminController extends Controller
{
    public function index() 
    {
        if(auth()->check()) {
            $user = Auth::user();
            $admin = Admin::where('id_user', $user->id)->first();

            return view('admin.dashboard', ['admin' => $admin]);
        }

        return redirect()->route('login');
    }

    public function viewProfile()
    {
        $user = Auth::user();
        $admin = Admin::where('id_user', $user->id)->first();

        return view('admin.profile', ['admin' => $admin]);
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
                'nama' => 'required',
                'alamat' => 'required',
                'no_telepon' => 'required',
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
            
            $admin->nama = $request->nama;
            $admin->alamat = $request->alamat;
            $admin->no_telepon = $request->no_telepon;
            $user->username = $request->username;
            
            $admin->save();

            $user->update([
                'username' => $request->username
            ]);
            
            return redirect()->route('view_profil')->with('success', 'Data admin berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('view_profil')->with('error', 'Terjadi kesalahan saat memperbarui data admin.');
        }
    }

    public function viewDaftarMhs()
    {
        $user = Auth::user();
        $mhsData = Mahasiswa::all();

        return view('admin.daftar_mhs', ['mhsData' => $mhsData]);
    }

    public function searchMahasiswa(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $mhsData = Mahasiswa::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('instansi', 'like', '%' . $search . '%')
                    ->orWhere('jurusan', 'like', '%' . $search . '%');
            })->get();
        } 

         return view('admin.daftar_mhs', ['mhsData' => $mhsData]);
    }

    public function filterByStatus(Request $request)
    {
        $status = $request->input('status');

        if (!empty($status)) {
            $mhsData = Mahasiswa::where('status', $status)->get();
        } else {
            $mhsData = Mahasiswa::all();
        }

        return view('admin.daftar_mhs', ['mhsData' => $mhsData]);
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
  
        return view('admin.daftar_akun', ["accounts" => $accounts]);
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
        $mhsData = Mahasiswa::whereHas('nilai')->get();

        return view('admin.daftar_skl', ['mhsData' => $mhsData]);
    }

    public function viewNilai(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
        $nilai = Nilai::where('id_mhs', $id_mhs)->first();
       
        return view('admin.lihat_nilai', [
            'mahasiswa' => $mhs,
            'foto' => $foto,
            'nilai' => $nilai]);
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


}
