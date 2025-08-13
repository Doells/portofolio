<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Pesan sukses jika berhasil login
            return redirect()->intended('/dashboard')->with('loginSuccess', 'Login berhasil! Silahkan masuk.');
        }

        // Pesan error jika login gagal
        return back()->with('loginError', 'Login gagal! Silahkan periksa NIM dan Password anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

