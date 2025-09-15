<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (! $token = JWTAuth::attempt($credentials)) {
            // Kalau gagal login → redirect ke login dengan pesan error
            return redirect()->back()->with('error', 'Username atau password salah!');
        }

        // Simpan token di session
        session(['jwt_token' => $token]);

        return redirect()->route('home')->with('success', 'Login berhasil, selamat datang ' . auth()->user()->username);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logout berhasil']);
    }
}
