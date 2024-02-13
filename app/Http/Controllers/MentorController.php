<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\OnlyMentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Mentor;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Progress;
use App\Models\Absen;
use App\Models\Nilai;
use App\Models\Skl;
use App\Models\GeneratedAccount;
use App\Models\GeneratedProgress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MentorController extends Controller
{
    public function index(Request $request) 
    {
        if(auth()->check()) {
            $user = Auth::user();
            $mentor = Mentor::where('id_user', $user->id)->first();
            $nipMentor = $mentor->nip;

            $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('nip_mentor', $nipMentor)
                ->select(
                    'mahasiswa.id_mhs',
                    'mahasiswa.nama',
                    'mahasiswa.status',
                    'users.foto as foto',
                )
                ->get();

            $mhsAbsen = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('mahasiswa.nip_mentor', $nipMentor)
                ->where('absen.status', 'Verified')
                ->get();

            $mhsProgress = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('mahasiswa.nip_mentor', $nipMentor)
                ->where('progress.status', 'Verified')
                ->get();

            $nilai1 = Nilai::join('mahasiswa', 'nilai.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('nilai.nip_mentor', $nipMentor)
                ->get();

            $nilai2 = Mahasiswa::leftJoin('nilai', 'mahasiswa.id_mhs', '=', 'nilai.id_mhs')
                ->where('mahasiswa.nip_mentor', $nipMentor)
                ->whereNull('nilai.id_mhs') 
                ->where('mahasiswa.status', 'Aktif')
                ->get();

            $progress = Progress::join('generate_progress', 'progress.id_progress', '=', 'generate_progress.id_progress')
                ->where('generate_progress.nip_mentor', $nipMentor)
                ->where('progress.status', 'Unverified')
                ->get();

            $totalMahasiswa = Mahasiswa::where('nip_mentor', $nipMentor)->count();

            $totalAktif = Mahasiswa::where('nip_mentor', $nipMentor)
                ->where('status', 'Aktif')
                ->count();

            $totalNonAktif = Mahasiswa::where('nip_mentor', $nipMentor)
                ->where('status', 'Tidak Aktif')
                ->count();

            $totalLulus = Mahasiswa::where('nip_mentor', $nipMentor)
                ->where('status', 'Lulus')
                ->count();

            return view('mentor.dashboard', compact('totalMahasiswa', 'totalAktif', 'totalNonAktif', 'totalLulus', 'mentor', 'mahasiswa', 'nilai1', 'nilai2', 'progress', 'mhsProgress', 'mhsAbsen'));
        }

        return redirect()->route('login');
    }

    public function filterDashboard(Request $request)
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();

        $nipMentor = $mentor->nip;
        
        $status = $request->input('status');

        if (!empty($status)) {
            $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('status', $status)
                ->where('nip_mentor', $nipMentor)
                ->select(
                    'mahasiswa.id_mhs',
                    'mahasiswa.nama',
                    'mahasiswa.status',
                    'users.foto as foto',
                )
                ->get();
        } else {
            $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('nip_mentor', $nipMentor)
            ->select(
                'mahasiswa.id_mhs',
                'mahasiswa.nama',
                'mahasiswa.status',
                'users.foto as foto',
            )
            ->get();
        }

        $mhsAbsen = Absen::join('mahasiswa', 'absen.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_mentor', $nipMentor)
            ->where('absen.status', 'Verified')
            ->get();

        $mhsProgress = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_mentor', $nipMentor)
            ->where('progress.status', 'Verified')
            ->get();

        $nilai1 = Nilai::join('mahasiswa', 'nilai.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('nilai.nip_mentor', $nipMentor)
            ->get();

        $nilai2 = Mahasiswa::leftJoin('nilai', 'mahasiswa.id_mhs', '=', 'nilai.id_mhs')
            ->where('mahasiswa.nip_mentor', $nipMentor)
            ->whereNull('nilai.id_mhs') 
            ->where('mahasiswa.status', 'Aktif')
            ->get();

        $progress = Progress::join('generate_progress', 'progress.id_progress', '=', 'generate_progress.id_progress')
            ->where('generate_progress.nip_mentor', $nipMentor)
            ->where('progress.status', 'Unverified')
            ->get();

        $totalMahasiswa = Mahasiswa::where('nip_mentor', $nipMentor)->count();

        $totalAktif = Mahasiswa::where('nip_mentor', $nipMentor)
            ->where('status', 'Aktif')
            ->count();

        $totalNonAktif = Mahasiswa::where('nip_mentor', $nipMentor)
            ->where('status', 'Tidak Aktif')
            ->count();

        $totalLulus = Mahasiswa::where('nip_mentor', $nipMentor)
            ->where('status', 'Lulus')
            ->count();

        return view('mentor.dashboard', compact('totalMahasiswa', 'totalAktif', 'totalNonAktif', 'totalLulus', 'mentor', 'mahasiswa', 'mhsAbsen', 'mhsProgress', 'nilai1', 'nilai2', 'progress'));
    }

    public function viewDaftarMhs()
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();

        $nipMentor = $mentor->nip;

        $mhsData = Mahasiswa::with('nilai')
            ->join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('nip_mentor', $mentor->nip)
            ->select(
                'mahasiswa.id_mhs',
                'mahasiswa.nama',
                'mahasiswa.jurusan',
                'mahasiswa.instansi',
                'mahasiswa.status',
                'users.foto as foto',
            )
            ->get();

        $nilai1 = Nilai::join('mahasiswa', 'nilai.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('nilai.nip_mentor', $mentor->nip)
            ->get();

        $nilai2 = Mahasiswa::leftJoin('nilai', 'mahasiswa.id_mhs', '=', 'nilai.id_mhs')
            ->where('mahasiswa.nip_mentor', $mentor->nip)
            ->whereNull('nilai.id_mhs') 
            ->where('mahasiswa.status', 'Aktif')
            ->get();
        
        $totalMahasiswa = Mahasiswa::where('nip_mentor', $nipMentor)->count();
    
        return view('mentor.daftar_mhs', compact('mhsData', 'nilai1', 'nilai2', 'totalMahasiswa'));
    }

    public function filterByStatus(Request $request)
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();

        $nipMentor = $mentor->nip;
        
        $status = $request->input('status');

        if (!empty($status)) {
            $mhsData = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('status', $status)
                ->where('nip_mentor', $nipMentor)
                ->select(
                    'mahasiswa.id_mhs',
                    'mahasiswa.nama',
                    'mahasiswa.jurusan',
                    'mahasiswa.instansi',
                    'mahasiswa.status',
                    'users.foto as foto',                    
                )
                ->get();
        } else {
            $mhsData = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->where('nip_mentor', $nipMentor)
                ->select(
                    'mahasiswa.id_mhs',
                    'mahasiswa.nama',
                    'mahasiswa.jurusan',
                    'mahasiswa.instansi',
                    'mahasiswa.status',
                    'users.foto as foto',                    
                )
                ->get();
        }

        $nilai1 = Nilai::join('mahasiswa', 'nilai.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('nilai.nip_mentor', $mentor->nip)
            ->get();

        $nilai2 = Mahasiswa::leftJoin('nilai', 'mahasiswa.id_mhs', '=', 'nilai.id_mhs')
            ->where('mahasiswa.nip_mentor', $mentor->nip)
            ->whereNull('nilai.id_mhs') 
            ->where('mahasiswa.status', 'Aktif')
            ->get();
        
        $totalMahasiswa = Mahasiswa::where('nip_mentor', $nipMentor)->count();

        return view('mentor.daftar_mhs', compact('mhsData', 'nilai1', 'nilai2', 'totalMahasiswa'));
    }

    public function viewPresensi(string $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();
        $PresensiData = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
            ->where('absen.id_mhs', $id_mhs)
            ->select(
                'generate_absen.sesi as sesi',
                'absen.tanggal',
                'absen.keterangan',
                'absen.foto',
                'absen.status',
            )
            ->get();

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

        return view('mentor.view_presensi', compact('PresensiData', 'foto', 'mahasiswa', 'id_mhs', 'absenPagi', 'absenSore'));
    }

    public function filterStatusAbsen(Request $request, $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();

        $status = $request->input('status');

        if (!empty($status)) {
            $PresensiData = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
                ->where('absen.id_mhs', $id_mhs)
                ->where('absen.status', $status)
                ->select(
                    'generate_absen.sesi as sesi',
                    'absen.tanggal',
                    'absen.keterangan',
                    'absen.foto',
                    'absen.status',                  
                )
                ->get();
        } else {
            $PresensiData = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
                ->where('absen.id_mhs', $id_mhs)
                ->select(
                    'generate_absen.sesi as sesi',
                    'absen.tanggal',
                    'absen.keterangan',
                    'absen.foto',
                    'absen.status',                  
                )
                ->get();
        }

        return view('mentor.view_presensi', compact('PresensiData', 'foto', 'mahasiswa', 'id_mhs'));
    }

    public function filterSesiAbsen(Request $request, $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();

        $sesi = $request->input('sesi');

        if (!empty($sesi)) {
            $PresensiData = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
                ->where('absen.id_mhs', $id_mhs)
                ->where('generate_absen.sesi', $sesi)
                ->select(
                    'generate_absen.sesi as sesi',
                    'absen.tanggal',
                    'absen.keterangan',
                    'absen.foto',
                    'absen.status',                  
                )
                ->get();
        } else {
            $PresensiData = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
                ->where('absen.id_mhs', $id_mhs)
                ->select(
                    'generate_absen.sesi as sesi',
                    'absen.tanggal',
                    'absen.keterangan',
                    'absen.foto',
                    'absen.status',                  
                )
                ->get();
        }

        return view('mentor.view_presensi', compact('PresensiData', 'mahasiswa', 'foto', 'id_mhs'));
    }

    public function filterKetAbsen(Request $request, $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();

        $keterangan = $request->input('keterangan');

        if (!empty($keterangan)) {
            $PresensiData = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
                ->where('absen.id_mhs', $id_mhs)
                ->where('absen.keterangan', $keterangan)
                ->select(
                    'generate_absen.sesi as sesi',
                    'absen.tanggal',
                    'absen.keterangan',
                    'absen.foto',
                    'absen.status',                  
                )
                ->get();
        } else {
            $PresensiData = Absen::join('generate_absen', 'absen.id_absen', '=', 'generate_absen.id_absen')
                ->where('absen.id_mhs', $id_mhs)
                ->select(
                    'generate_absen.sesi as sesi',
                    'absen.tanggal',
                    'absen.keterangan',
                    'absen.foto',
                    'absen.status',                  
                )
                ->get();
        }

        return view('mentor.view_presensi', compact('PresensiData', 'mahasiswa', 'foto', 'id_mhs'));
    }

    public function viewProgress(string $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();
        $progressMagang = Progress::where('id_mhs', $mahasiswa->id_mhs)->get();

        $progVer = Progress::where('id_mhs', $mahasiswa->id_mhs)
            ->where('progress.status', 'Verified')
            ->get();

        $progUnver = Progress::where('id_mhs', $mahasiswa->id_mhs)
            ->where('progress.status', 'Unverified')
            ->get();

        return view('mentor.view_progress', compact('mahasiswa', 'foto', 'progressMagang', 'id_mhs', 'progVer', 'progUnver'));
    }

    public function filterStatusProgress2(Request $request, $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();

        $status = $request->input('status');

        if (!empty($status)) {
            $progressMagang = Progress::where('id_mhs', $mahasiswa->id_mhs)
                ->where('progress.status', $status)
                ->get();
        } else {
            $progressMagang = Progress::where('id_mhs', $mahasiswa->id_mhs)->get();      
        }

        $progVer = Progress::where('id_mhs', $mahasiswa->id_mhs)
            ->where('progress.status', 'Verified')
            ->get();

        $progUnver = Progress::where('id_mhs', $mahasiswa->id_mhs)
            ->where('progress.status', 'Unverified')
            ->get();

        return view('mentor.view_progress', compact('mahasiswa', 'foto', 'progressMagang', 'id_mhs', 'progVer', 'progUnver'));
    }

    public function viewProfile()
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();

        return view('mentor.profile', ['mentor' => $mentor]);
    }

    public function viewEditProfile()
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();

        return view('mentor.edit_profile', ["mentor" =>  $mentor]);
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            $mentor = Mentor::where('id_user', $user->id)->first();

            $validated = $request->validate([
                // 'nama' => 'required',
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
            
            // $mentor->nama = $request->nama;
            $mentor->alamat = $request->alamat;
            $mentor->no_telepon = $request->no_telepon;
            $mentor->email = $request->email;
            $user->username = $request->username;
            
            $mentor->save();

            $user->update([
                'username' => $request->username
            ]);
            
            return redirect()->route('view_profil_mentor')->with('success', 'Data mentor berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('view_profil_mentor')->with('error', 'Terjadi kesalahan saat memperbarui data mentor: ' . $e->getMessage());
        }
    }

    public function viewNilai(string $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();
        $tambahNilai = Nilai::where('id_mhs', $mahasiswa->id_mhs)->get();

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
        
        return view('mentor.nilai', compact('mahasiswa', 'foto', 'tambahNilai', 'absenPagi', 'absenSore', 'progVer'));
    } 
    
    public function storeNilai(Request $request, string $id_mhs)
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $validatedData = $request->validate([
            'nilai' => 'required|array|min:4',
        
        ]);

    
        $nilai_avg = array_sum($validatedData['nilai']) / count($validatedData['nilai']);

        Nilai::create([
            'id_mhs' => $mhs->id_mhs,
            'nip_mentor'=> $mentor->nip,
            'nilai1' => $validatedData['nilai'][0],
            'nilai2' => $validatedData['nilai'][1],
            'nilai3' => $validatedData['nilai'][2],
            'nilai4' => $validatedData['nilai'][3],
            'nilai_avg' => $nilai_avg,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('daftar_mhs_mentor')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function viewEditNilai(string $id_mhs)
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
       
        return view('mentor.view_edit_nilai', compact('mahasiswa', 'foto', 'nilai', 'absenPagi', 'absenSore', 'progVer'));
    }

    public function viewEditNilai2(string $id_mhs)
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
       
        return view('mentor.edit_nilai', compact('mahasiswa', 'foto', 'nilai', 'absenPagi', 'absenSore', 'progVer'));
    }

    public function storeNilai1(Request $request, $id_mhs)
    {
        try {
            $mahasiswa = Mahasiswa::find($id_mhs);
            $nilai = Nilai::where('id_mhs', $id_mhs)->first();

            if (!$mahasiswa || !$nilai) {
                return redirect()->route('daftar_mhs_mentor')->with('error', 'Mahasiswa atau penilaian tidak ditemukan');
            }

            $validated = $request->validate([
                'nilai1' => 'required|numeric',
                'nilai2' => 'required|numeric',
                'nilai3' => 'required|numeric',
                'nilai4' => 'required|numeric',
            ]);

            $nilai->nilai1 = $request->nilai1;
            $nilai->nilai2 = $request->nilai2;
            $nilai->nilai3 = $request->nilai3;
            $nilai->nilai4 = $request->nilai4;
            $nilai->nilai_avg = ($request->nilai1 + $request->nilai2 + $request->nilai3 + $request->nilai4) / 4;
            $nilai->updated_at = now();
            $nilai->save();

            return redirect()->route('daftar_mhs_mentor')->with('success', 'Penilaian mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('daftar_mhs_mentor')->with('error', 'Terjadi kesalahan saat memperbarui penilaian mahasiswa.');
        }
    }

    public function deleteNilai(string $id_mhs)
    {
        try {
            $nilai = Nilai::where('id_mhs', $id_mhs)->first();

            if (!$nilai) {
                return redirect()->route('daftar_mhs_mentor')->with('error', 'Penilaian mahasiswa tidak ditemukan.');
            }

            $nilai->delete();

            return redirect()->route('daftar_mhs_mentor')->with('success', 'Penilaian mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('daftar_mhs_mentor')->with('error', 'Terjadi kesalahan saat menghapus penilaian mahasiswa.');
        }
    }

    public function viewTambahProgress() 
    {
        $tambahProgress = DB::table('generate_progress')
            ->join('progress', 'progress.id_progress', '=', 'generate_progress.id_progress')
            ->select('generate_progress.*')
            ->get();
        
        return view('mentor.tambah_progress', compact('tambahProgress'));
    }

    public function storeProgress(Request $request)
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();

        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'mulai_submit' => 'required|date',
            'selesai_submit' => 'required|date',
        ]);

        if ($request->submit === 'generate') {
            DB::beginTransaction();

            try {
                $created_at = $request->input('created_at');

                $generateProgress = GeneratedProgress::create([
                    'nip_mentor' => $mentor->nip,
                    'judul' => $request->judul,
                    'deskripsi' => $request->deskripsi,
                    'mulai_submit' => $request->mulai_submit,
                    'selesai_submit' => $request->selesai_submit,
                    'created_at' => $created_at,
                ]);

                if (!$generateProgress) {
                    DB::rollback();
                    return redirect()->route('tambah_progress')->with('error', 'Gagal men-generate progress!');
                }

                DB::commit();

                return redirect()->route('tambah_progress')->with('success', 'Berhasil menambahkan progress!');
            } catch (\Exception $e) {
                dd($e->getMessage());
                DB::rollback();
                return redirect()->route('tambah_progress')->with('error', 'Gagal menambahkan progress!');
            }
        }
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

    // public function viewRekapProgress()
    // {
    //     $user = Auth::user();
    //     $mentor = Mentor::where('id_user', $user->id)->first();

    //     $nipMentor = $mentor->nip;

    //     $generate_progress = GeneratedProgress::where('nip_mentor', $nipMentor)
    //         ->orderBy('id_progress', 'desc')
    //         ->get();

    //     return view('mentor.rekap_progress', compact('generate_progress'));
    // }

    public function viewRekapProgress()
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();

        $nipMentor = $mentor->nip;

        $generate_progress = Progress::rightJoin('generate_progress', 'progress.id_progress', '=', 'generate_progress.id_progress')
            ->where('generate_progress.nip_mentor', $nipMentor)
            ->groupBy(
                'generate_progress.id_progress', 
                'generate_progress.judul', 
                'generate_progress.deskripsi', 
                'generate_progress.mulai_submit', 
                'generate_progress.selesai_submit'
            )
            ->select(
                'generate_progress.id_progress as id_progress',
                'generate_progress.judul as judul',
                'generate_progress.deskripsi as deskripsi',
                'generate_progress.mulai_submit as mulai_submit',
                'generate_progress.selesai_submit as selesai_submit',
                DB::raw('MAX(progress.status) as status'),
                DB::raw('SUM(CASE WHEN progress.status = "Unverified" THEN 1 ELSE 0 END) as unverified_count')
            )
            ->orderBy('generate_progress.id_progress', 'desc')
            ->get();

        return view('mentor.rekap_progress', compact('generate_progress'));
    }

    public function edit_progress($id_progress)
    {
        $generate_progress = GeneratedProgress::where('id_progress', $id_progress)
            ->select(
                'generate_progress.judul',
                'generate_progress.deskripsi',
                'generate_progress.mulai_submit',
                'generate_progress.selesai_submit',
            )
            ->first();
        
        return view('mentor.edit_progress', compact('generate_progress', 'id_progress'));
    }

    public function update_progress(Request $request, $id_progress)
    {
        $generate_progress = GeneratedProgress::where('id_progress', $id_progress)->first();
    
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'mulai_submit' => 'required|date',
            'selesai_submit' => 'required|date',
        ]);
    
        $generate_progress->judul = $request->judul;
        $generate_progress->deskripsi = $request->deskripsi;
        $generate_progress->mulai_submit = $request->mulai_submit;
        $generate_progress->selesai_submit = $request->selesai_submit;

        $updated_at = $request->input('updated_at');
        $generate_progress->updated_at = $updated_at;
    
        $progressChanged = $generate_progress->isDirty(); 
    
        if ($generate_progress->save()) {
            if ($progressChanged) {
                return redirect()->back()->with(['success' => 'Personal information updated successfully!'] + compact('generate_progress', 'id_progress'));
            } else {
                return redirect()->back()->with(['info' => 'No changes made.'] + compact('generate_progress', 'id_progress'));
            }
        } else {
            return redirect()->back()->with(['info' => 'Failed to update personal information.'] + compact('generate_progress', 'id_progress'));
        }   
    }

    public function delete_progress($id_progress)
    {
        try {
            $generate_progress = GeneratedProgress::where('id_progress', $id_progress)->first();

            $generate_progress->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus record progress!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus record progress.');
        }
    }   

    public function rekap_mhs($id_progress)
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();
        $nipMentor = $mentor->nip;

        $rekapMhs = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
            ->join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('mahasiswa.nip_mentor', $nipMentor)
            ->where('id_progress', $id_progress)
            ->select(
                'progress.id_progress as id_progress',
                'progress.id_mhs as id_mhs',
                'progress.tanggal as tanggal',
                'progress.status as status',
                'progress.scan_file as file',
                'mahasiswa.nama as nama',
                'mahasiswa.jurusan as jurusan',
                'mahasiswa.instansi as instansi',
                'users.foto as foto',
            )
            ->get();

        $generate_progress = GeneratedProgress::where('id_progress', $id_progress)
            ->select(
                'generate_progress.judul',
                'generate_progress.mulai_submit',
                'generate_progress.selesai_submit',
            )
            ->first();

        $status_progress = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_mentor', $nipMentor)
            ->where('id_progress', $id_progress)
            ->select(
                'progress.status as status',
            )
            ->get();

        $mahasiswa = Mahasiswa::where('nip_mentor', $nipMentor)
            ->select(
                'mahasiswa.status as status_mhs',
            )
            ->get();

        return view('mentor.rekap_mahasiswa', compact('rekapMhs', 'generate_progress', 'id_progress', 'status_progress', 'mahasiswa'));
    }

    public function verif_progress($id_progress, $id_mhs)
    {
        $progress = Progress::where('id_progress', $id_progress)
            ->where('id_mhs', $id_mhs)
            ->first();

        if ($progress) {
            if ($progress->status === 'Unverified') {
                $progress->status = 'Verified';

                $progress->save();

                return redirect()->back()->with('success', 'Progress berhasil diverifikasi!');
            }
        } else {
            return redirect()->back()->with('erorr', 'Progress tidak ditemukan!');
        }
    }
    
    public function filterStatusProgress(Request $request, $id_progress)
    {        
        $status = $request->input('status');
    
        if (!empty($status)) {
            $rekapMhs = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('progress.status', $status)
                ->where('id_progress', $id_progress)
                ->select(
                    'progress.id_progress as id_progress',
                    'progress.id_mhs as id_mhs',
                    'progress.tanggal as tanggal',
                    'progress.status as status',
                    'progress.scan_file as file',
                    'mahasiswa.nama as nama',
                    'mahasiswa.jurusan as jurusan',
                    'mahasiswa.instansi as instansi',
                    'mahasiswa.foto as foto',
                )
                ->get();
        } else {
            $rekapMhs = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('id_progress', $id_progress)
                ->select(
                    'progress.id_progress as id_progress',
                    'progress.id_mhs as id_mhs',
                    'progress.tanggal as tanggal',
                    'progress.status as status',
                    'progress.scan_file as file',
                    'mahasiswa.nama as nama',
                    'mahasiswa.jurusan as jurusan',
                    'mahasiswa.instansi as instansi',
                    'mahasiswa.foto as foto',
                )
                ->get();
        }

        $generate_progress = GeneratedProgress::where('id_progress', $id_progress)
        ->select(
            'generate_progress.judul',
            'generate_progress.mulai_submit',
            'generate_progress.selesai_submit',
        )
        ->first();

        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();
        $nipMentor = $mentor->nip;

        $status_progress = Progress::join('mahasiswa', 'progress.id_mhs', '=', 'mahasiswa.id_mhs')
            ->where('mahasiswa.nip_mentor', $nipMentor)
            ->where('id_progress', $id_progress)
            ->select(
                'progress.status as status',
            )
            ->get();

        $mahasiswa = Mahasiswa::where('nip_mentor', $nipMentor)
            ->select(
                'mahasiswa.status as status_mhs',
            )
            ->get();
    
        return view('mentor.rekap_mahasiswa', compact('rekapMhs', 'generate_progress', 'id_progress', 'status_progress', 'mahasiswa'));
    } 

    public function verifiedAllProgress($id_progress) {
        $progresses = Progress::where('id_progress', $id_progress)
            ->where('status', 'Unverified')
            ->get();
    
        if ($progresses->isNotEmpty()) {
            foreach ($progresses as $progress) {
                $progress->status = 'Verified';
                $progress->save();
            }
    
            return redirect()->back()->with('success', 'Semua progress berhasil diverifikasi!');
        } else {
            return redirect()->back()->with('error', 'Semua progress sudah diverifikasi atau tidak ditemukan!');
        }
    }
}