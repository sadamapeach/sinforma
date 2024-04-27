<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                
                switch ($user->id_role) {
                    case 1:
                        return redirect('/dashboard_admin');
                    case 2:
                        return redirect('/dashboard_mentor');
                    case 3:
                        if ($user->mahasiswa->check_profil === 0) {
                            return redirect()->route('form_mahasiswa')->with('error', 'Harap lengkapi data diri terlebih dahulu.');
                        }
                        return redirect('/dashboard_mahasiswa');
                        // return redirect('/reset_password/{token}');
                    default:
                        return back()->with('loginError', 'Role tidak valid');
                }
            }
        }

        return $next($request);
    }

    protected function redirectTo($request): Response
    {
        
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (Auth::user()->id_role == 1) {
            return redirect()->route('dashboard_admin');
        } elseif (Auth::user()->id_role == 2) {
            return redirect()->route('dashboard_mentor');
        } elseif (Auth::user()->id_role == 3) {
            return redirect()->route('dashboard_mahasiswa');
        }

        return redirect()->route('welcome');
    }
}
