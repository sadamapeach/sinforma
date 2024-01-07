<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        if (!$user) {
            return back()->with('loginError', 'Username tidak ditemukan');
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->with('loginError', 'Password salah');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = $request->user();

            if ($user->idrole === 1) {
                return redirect()->intended('/dashboard_admin');
            } else if ($user->idrole === 2) {
                return redirect()->intended('/dashboard_mentor');
            } else if ($user->idrole === 3) {
                if ($user->profile_completed === 0) {
                    return redirect()->route('mahasiswa.dashboard')->with('error', 'Harap lengkapi data diri terlebih dahulu.');
                }
                return redirect()->intended('/dashboard_mahasiswa');
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

