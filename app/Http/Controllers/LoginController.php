<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $credentials['username'])->first();
        $mhs = Mahasiswa::where('id_mhs', $request->id_mhs)->first();

        if (!$user) {
            return back()->with('loginError', 'Username tidak ditemukan');
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->with('loginError', 'Password salah');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            
            $user = $request->user();
            $mhs = $user->mahasiswa;
        
            switch ($user->id_role) {
                case 1:
                    return redirect()->intended('/dashboard_admin');
                case 2:
                    return redirect()->intended('/dashboard_mentor');
                case 3:
                    if ($mhs->check_profil === 0) {
                        return redirect()->route('form_mahasiswa')->with('error', 'Harap lengkapi data diri terlebih dahulu.');
                    }
                    return redirect()->intended('/dashboard_mahasiswa');
                default:
                    return back()->with('loginError', 'Role tidak valid');
            }
        }

        return back()->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('logoutSuccess', 'Logout successfully!');
    }
}

