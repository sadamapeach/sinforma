<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signout() {
        Auth::signout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login')->with('signoutSuccess', 'Logout successfully!');
    }
}
