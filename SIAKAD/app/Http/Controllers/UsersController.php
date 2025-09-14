<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        // Cari user berdasarkan username
        $user = DB::table('users')->where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Simpan data ke session
            $request->session()->put('user_id', $user->user_id);
            $request->session()->put('role', $user->role);
            $request->session()->put('full_name', $user->full_name);

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error', 'Username atau password salah!');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush(); // hapus semua session
        return redirect()->route('login');
    }
}
