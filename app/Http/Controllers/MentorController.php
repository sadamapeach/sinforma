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
        $mhsData = Mahasiswa::where('nip_mentor', $mentor->nip)->get();

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
}
