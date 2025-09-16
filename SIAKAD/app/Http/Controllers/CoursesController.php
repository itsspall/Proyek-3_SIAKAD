<?php

namespace App\Http\Controllers;

use App\Models\CoursesModel;
use App\Models\StudentsModel;
use App\Models\TakesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $student = StudentsModel::where('student_id', $user->user_id)->firstOrFail();
            $courses = CoursesModel::all();
            $enrolled = TakesModel::where('student_id', $student->student_id)->pluck('course_id')->toArray();

            return view('student.courses.index', compact('courses', 'enrolled', 'student'));
        }

        abort(403, 'Unauthorized');
    }

    public function enroll($id)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            abort(403, 'Unauthorized');
        }

        $student = StudentsModel::where('student_id', $user->user_id)->firstOrFail();
        $course = CoursesModel::findOrFail($id);

        if ($student->semester != $course->semester_offered) {
            return redirect()->back()->with('error', 'Semester tidak sesuai untuk mengambil mata kuliah ini.');
        }

        $already = TakesModel::where('student_id', $student->student_id)
            ->where('course_id', $course->course_id)
            ->exists();

        if ($already) {
            return redirect()->back()->with('error', 'Anda sudah mengambil course ini.');
        }

        TakesModel::create([
            'student_id' => $student->student_id,
            'course_id' => $course->course_id,
            'enroll_date' => now(),
            'status' => 'ongoing',
            'attendance' => 0,
        ]);

        return redirect()->route('student.courses.index')->with('success', 'Berhasil mengambil mata kuliah.');
    }

    public function drop($courseId)
    {
        $student = auth()->user()->student;

        $take = TakesModel::where('student_id', $student->student_id)
            ->where('course_id', $courseId)
            ->where('status', 'ongoing')
            ->first();

        if (!$take) {
            return redirect()->back()->with('error', 'Course tidak ditemukan atau sudah tidak ongoing.');
        }

        // update langsung via query builder, hindari save()
        TakesModel::where('student_id', $student->student_id)
            ->where('course_id', $courseId)
            ->update(['status' => 'dropped']);

        return redirect()->route('courses.index')->with('success', 'Course berhasil di-drop.');
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
