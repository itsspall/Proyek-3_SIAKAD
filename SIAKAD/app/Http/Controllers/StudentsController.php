<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentsModel;

class StudentsController extends Controller
{
    public function index(){
        $data = StudentsModel::all();
        return view('admin.students.index', compact('data'));
    }

    public function create(){
        return view('admin.students.create');
    }

    // public function store(Request $request){
    //     $request->validate([
    //         'student_id' => 'required|unique:students,student_id',
    //         'entry_year' => 'required|integer',
    //         'major' => 'required|string|max:100',
    //         'semester' => 'required|integer',
    //         'dob' => 'required|date',
    //         'gender' => 'required|in:M,F',
    //         'user_id' => 'required|unique:students,user_id',
    //     ]);

    //     $student = new StudentsModel();
    //     $student->name = $request->name;
    //     $student->email = $request->email;
    //     $student->password = bcrypt($request->password);
    //     $student->save();

    //     return redirect()->route('students.index')->with('success', 'Student created successfully.');
    // }
}
