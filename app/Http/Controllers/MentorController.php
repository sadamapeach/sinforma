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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MentorController extends Controller
{
    public function index() 
    {
        if(auth()->check()) {
            $user = Auth::user();
            $mentor = Mentor::where('id_user', $user->id)->first();

            return view('mentor.dashboard', ['mentor' => $mentor]);
        }

        return redirect()->route('login');
    }

    public function viewDaftarMhs()
    {
        $user = Auth::user();
        $mentor = Mentor::where('id_user', $user->id)->first();
        $mhsData = Mahasiswa::with('nilai')->where('nip_mentor', $mentor->nip)->get();

        return view('mentor.daftar_mhs', ['mhsData' => $mhsData]);
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

         return view('mentor.daftar_mhs', ['mhsData' => $mhsData]);
    }

    public function filterByStatus(Request $request)
    {
        $status = $request->input('status');

        if (!empty($status)) {
            $mhsData = Mahasiswa::where('status', $status)->get();
        } else {
            $mhsData = Mahasiswa::all();
        }

        return view('mentor.daftar_mhs', ['mhsData' => $mhsData]);
    }

    public function viewPresensi(string $id_mhs)
    {
        $mahasiswa = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mahasiswa->id_user)->first()->getImageURL();
        $PresensiData = Absen::where('id_mhs', $id_mhs)
                            ->where('status', 'Verified')
                            ->first();

        return view('mentor.view_presensi', compact('PresensiData', 'foto', 'mahasiswa'));
    }

    public function viewProgress(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
        $progressMagang = Progress::where('id_mhs', $mhs->id_mhs)->get();

        return view('mentor.view_progress', [
            'mahasiswa' => $mhs,
            'foto' => $foto,
            'progressMagang' => $progressMagang,
        ]);
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
            
            $mentor->nama = $request->nama;
            $mentor->alamat = $request->alamat;
            $mentor->no_telepon = $request->no_telepon;
            $user->username = $request->username;
            
            $mentor->save();

            $user->update([
                'username' => $request->username
            ]);
            
            return redirect()->route('view_profil_mentor')->with('success', 'Data mentor berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('view_profil_mentor')->with('error', 'Terjadi kesalahan saat memperbarui data mentor.');
        }
    }

    public function viewNilai(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
        $tambahNilai = Nilai::where('id_mhs', $mhs->id_mhs)->get();
        
        return view('mentor.nilai', [
            'mahasiswa' => $mhs,
            'foto' => $foto,
            'tambahNilai' => $tambahNilai,
        ]);
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
        ]);

        return redirect()->route('daftar_mhs_mentor')->with('success', 'Penilaian berhasil ditambahkan.');
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

    public function viewEditNilai2(string $id_mhs)
    {
        $mhs = Mahasiswa::where('id_mhs', $id_mhs)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
        $nilai = Nilai::where('id_mhs', $id_mhs)->first();
       
        return view('mentor.edit_nilai', [
            'mahasiswa' => $mhs,
            'foto' => $foto,
            'nilai' => $nilai]);
    }

    public function storeNilai1(Request $request, $id_mhs)
    {
        try {
            $mahasiswa = Mahasiswa::find($id_mhs);
            $nilai = Nilai::where('id_mhs', $id_mhs)->first();

            if (!$mahasiswa || !$nilai) {
                return redirect()->route('daftar_mhs_mentor')->with('error', 'Mahasiswa atau Nilai tidak ditemukan');
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
            $nilai->save();

            return redirect()->route('daftar_mhs_mentor')->with('success', 'Nilai mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('daftar_mhs_mentor')->with('error', 'Terjadi kesalahan saat memperbarui nilai mahasiswa.');
        }
    }

}
