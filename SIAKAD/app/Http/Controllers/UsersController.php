<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\UsersModel;

class UsersController extends Controller
{
    public function index()
    {
        $allUsers = UsersModel::all();
        $admins = UsersModel::where('role', 'admin')->get();
        $students = UsersModel::where('role', 'student')->with('student')->get();

        return view('admin.users.index', compact('allUsers', 'admins', 'students'));
    }



    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (! $token = JWTAuth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Username atau password salah!');
        }
        
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
