<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('web-token')->plainTextToken;
            return response()->json(['token' => $token]);
        }
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush(); // hapus semua session
        return redirect()->route('login');
    }
}
