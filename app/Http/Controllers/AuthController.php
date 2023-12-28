<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $credentials = $request->only('email', 'password');
    
        // Query Builder: Ambil data pengguna dari tabel users
        $user = DB::table('users')
            ->where('email', $credentials['email'])
            ->first();
    
        // Jika pengguna ditemukan dan password sesuai
        if ($user && password_verify($credentials['password'], $user->password)) {
            // Lakukan login
            Auth::loginUsingId($user->id);
    
            // Redirect ke halaman setelah login
            return redirect()->intended('/dashboard');
        }
    
        // Jika autentikasi gagal, kembalikan dengan pesan error
        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah'])
            ->withInput();
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
