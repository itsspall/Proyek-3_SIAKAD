<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\UsersModel;
use App\Models\StudentsModel;

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

    public function store (Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|max:50',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,student',
            'full_name' => 'required|max:100',
            'email' => 'nullable|email|max:100',
            'phone_number' => 'nullable|max:20',
        ]);

        $user = new UsersModel();
        $user->user_id = $request->user_id;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->status = 'active';
        $user->save();

        return redirect()->route('users')->with('success', 'User created successfully.');
    }
    
    // public function edit($id)
    // {
    //     $user = UsersModel::findOrFail($id);
    //     return view('admin.users.edit', compact('user'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'username' => 'required|max:50|unique:users,username,' . $id . ',user_id',
    //         'password' => 'nullable|min:6',
    //         'role' => 'required|in:admin,student',
    //         'full_name' => 'required|max:100',
    //         'email' => 'nullable|email|max:100',
    //         'phone_number' => 'nullable|max:20',
    //         'status' => 'required|in:active,inactive',
    //     ]);

    //     $user = UsersModel::findOrFail($id);
    //     $user->username = $request->username;
    //     if ($request->filled('password')) {
    //         $user->password = Hash::make($request->password);
    //     }
    //     $user->role = $request->role;
    //     $user->full_name = $request->full_name;
    //     $user->email = $request->email;
    //     $user->phone_number = $request->phone_number;
    //     $user->status = $request->status;
    //     $user->save();

    //     return redirect()->route('users.index')->with('success', 'User updated successfully.');
    // }

    public function destroy($id)
    {
        $user = UsersModel::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
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
        $user = Auth::user();

        $student = StudentsModel::where('student_id', $user->user_id)->first();

        return view('student.profile', [
            'user' => $user,
            'student' => $student,
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logout berhasil']);
    }
}
