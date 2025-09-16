<?php

namespace App\Http\Controllers;

use App\Models\CoursesModel;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            // tampilkan daftar semua courses (CRUD)
            $courses = CoursesModel::all();
            return view('admin.courses.index', compact('courses'));
        }

        if ($user->role === 'student') {
            // tampilkan daftar course yg bisa diambil student
            $courses = CoursesModel::all();
            return view('student.courses.index', compact('courses'));
        }

        abort(403, 'Unauthorized');
    }


    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name'      => 'required|string|max:100',
            'course_code'      => 'required|string|max:20|unique:courses,course_code',
            'credits'          => 'required|integer|min:1|max:10',
            'semester_offered' => 'required|integer|min:1|max:14',
            'description'      => 'nullable|string',
            'room'             => 'required|string|max:50',
            'lecturer'         => 'required|string|max:100',
        ]);

        CoursesModel::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Course added successfully.');
    }

    public function edit($id)
    {
        $course = CoursesModel::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = CoursesModel::findOrFail($id);

        $request->validate([
            'course_name'      => 'required|string|max:100',
            'course_code'      => 'required|string|max:20|unique:courses,course_code,' . $id . ',course_id',
            'credits'          => 'required|integer|min:1|max:10',
            'semester_offered' => 'required|integer|min:1|max:14',
            'description'      => 'nullable|string',
            'room'             => 'required|string|max:50',
            'lecturer'         => 'required|string|max:100',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = CoursesModel::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
