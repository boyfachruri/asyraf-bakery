<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            return $next($request);
        }

        // Jika belum login, redirect ke halaman login
        return redirect('/');
    }
}
