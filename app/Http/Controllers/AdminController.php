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

        return view('daftar_mhs', ['mhsData' => $mhsData]);
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
    $foto = User::where('id', $mhs->id_user)->first()->getImageURL();

    return view('admin.edit_status', [
        "mahasiswa" => $mhs,
        'foto' => $foto
    ]);
    }

}
