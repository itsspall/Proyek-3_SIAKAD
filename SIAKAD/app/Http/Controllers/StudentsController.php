<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentsModel;
use App\Models\UsersModel;

class StudentsController extends Controller
{
    public function index(){
        $data = StudentsModel::all();
        return view('admin.students.index', compact('data'));
    }

    public function create(){
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'username'   => 'required|unique:users,username',
            'password'   => 'required|min:6',
            'full_name'  => 'required|string|max:100',
            'entry_year' => 'required|integer',
            'major'      => 'required|string|max:100',
            'dob'        => 'required|date',
            'gender' => 'required|in:male,female',
            'email'      => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user = new UsersModel;
        $user->user_id   = $request->student_id;
        $user->username  = $request->username;
        $user->password  = bcrypt($request->password);
        $user->role      = 'student';
        $user->full_name = $request->full_name;
        $user->email     = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

        $student = new StudentsModel;
        $student->student_id = $request->student_id;
        $student->entry_year = $request->entry_year;
        $student->major      = $request->major;
        $student->dob        = $request->dob;
        $student->gender     = $request->gender;
        $student->save();

        return redirect()->route('students')->with('success', 'Student created successfully.');
    }

}
