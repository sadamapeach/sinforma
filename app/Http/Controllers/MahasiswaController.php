<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\User;

class MahasiswaController extends Controller
{
    public function index() {
        return view('mahasiswa.dashboard');
    }

    public function form(Request $request) {
        $user = Auth::user();
        $id_mhs = $request->user()->mahasiswa->id_mhs;
        $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                        ->where('id_mhs', $id_mhs)
                        ->select('mahasiswa.nama', 'mahasiswa.id_mhs', 'mahasiswa.jurusan', 'mahasiswa.instansi')
                        ->first();
        return view('mahasiswa.form', compact('mahasiswa', 'user'));
    }

    public function store(Request $request) {
        $user = $request->user();

        $validated = $request->validate([
            'alamat' => 'required',
            'noHP' => 'required|numeric',
            'email' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            if($request->has('image')) {
                $imageName = $request->file('image')->store('images', 'public');
                $validated['image'] = $imageName;

                $user->update([
                    'image' => $validated['image']
                ]);
            }

            // Update data mahasiswa
            Mahasiswa::where('id_user', $user->id)->update([
                'alamat' => $validated['alamat'],
                'noHP' => $validated['noHP'],
                'email' => $validated['email'],
            ]);

            Mahasiswa::where('id_user', $user->id)->update([
                'check_profil'=>1,
            ]);

            DB::commit();

            dd('aaa');

            return redirect()->route('dashboard_mahasiswa')->with('success', 'Data berhasil diinputkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('form_mahasiswa')->with('error', 'Gagal mengupdate data!');
        }
    }

    public function profile() {
        return view('mahasiswa.profile');
    }

    public function presensi() {
        return view('mahasiswa.presensi');
    }

    public function progress() {
        return view('mahasiswa.progress');
    }
}
