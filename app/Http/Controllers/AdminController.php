<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Progress;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function viewDaftarMhs()
    {
        $user = Auth::user();
        // $admin = Admin::where('iduser', $user->id)->first();
        $mhsData = Mahasiswa::all();

        return view('admin.daftar_mhs', ['mhsData' => $mhsData]);
    }

    public function searchMahasiswa(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $mhsData = Mahasiswa::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('instansi', 'like', '%' . $search . '%');
            })->get();
        } 

         return view('admin.daftar_mhs', ['mhsData' => $mhsData]);
    }

    public function viewProgress(string $nim)
    {
        $mhs = Mahasiswa::where('nim', $nim)->first();
        $foto = User::where('id', $mhs->id_user)->first()->getImageURL();
        $progressMagang = Progress::where('nim', $mhs->nim)->get();

        return view('admin.progress', [
            'mahasiswa' => $mhs,
            'foto' => $foto,
            'progressMagang' => $progressMagang,
        ]);
    }

    public function viewEditStatus(string $nim)
    {
        $mhs = Mahasiswa::where('nim', $nim)->first();

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


    public function delete2($nim)
    {
        try {
            $mhs = Mahasiswa::where('nim', $nim)->first();
            
            $mhs->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus data mahasiswa.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data mahasiswa.');
        }
    }

    public function update2(Request $request, string $nim)
    {
        try {
            $mhs = Mahasiswa::where('nim', $nim)->first();

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
            return redirect()->route('daftar_mhs')->with('error', 'Terjadi kesalahan saat memperbarui profil mahasiswa.');
        }
    }



}
