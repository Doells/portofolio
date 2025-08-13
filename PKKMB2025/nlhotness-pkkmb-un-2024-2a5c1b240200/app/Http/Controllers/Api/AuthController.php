<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // <-- TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // <-- TAMBAHKAN INI
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        Log::info('Mencoba login dengan data:', $request->all());
        
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 1. Cari user berdasarkan NIM
        $user = User::where('nim', $request->nim)->first();

        // 2. Cek apakah user ada DAN password-nya cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Jika user tidak ada ATAU password salah
            return response()->json([
                'status' => 'error',
                'message' => 'NIM atau password salah',
            ], 401);
        }

        // Jika user ada dan password cocok, buat token untuk API
        $token = $user->createToken('auth_token')->plainTextToken;

        // Berikan respons sukses beserta token
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user,
        ], 200);
    }

    public function logout(Request $request)
    {
        // ... (kode logout Anda sudah benar) ...
        Auth::logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return response()->json([
            'message' => 'Logout berhasil.',
        ], 200);
    }
}