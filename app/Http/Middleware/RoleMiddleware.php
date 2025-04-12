<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Harap login terlebih dahulu');
        }

        $user = Auth::user();

        if (!in_array($user->peran, $roles)) {
            // Redirect ke dashboard sesuai role
            $redirectUrl = $user->peran === 'admin' ? '/admin/dashboard' : '/pengguna/dashboard';

            return redirect($redirectUrl)->with('error', 'Kamu tidak punya akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
