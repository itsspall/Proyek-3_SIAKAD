<?php

namespace App\Http\Controllers;

use App\Models\CoursesModel;
use App\Models\StudentsModel;
use App\Models\TakesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CoursesController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Bagian untuk Admin
        if ($user->role !== 'student') {
            $courses = CoursesModel::orderBy('semester_offered')->orderBy('course_code')->get();
            return view('admin.courses.index', compact('courses'));
        }

        // Bagian untuk Student
        try {
            $student = StudentsModel::where('student_id', $user->user_id)->firstOrFail();
            $courses = CoursesModel::orderBy('semester_offered')->orderBy('course_code')->get();

            $enrolled = TakesModel::where('student_id', $student->student_id)
                ->select('course_id', 'status')
                ->get();

            return view('student.courses.index', compact('courses', 'enrolled', 'student'));

        } catch (\Exception $e) {
            Log::error('Student data not found for user_id: ' . $user->user_id);
            return redirect()->route('login')->with('error', 'Student profile not found.');
        }
    }

    public function enroll(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->role !== 'student') return response()->json(['error' => 'Unauthorized'], 403);

        $student = \App\Models\StudentsModel::where('student_id', $user->user_id)->firstOrFail();
        $course = \App\Models\CoursesModel::findOrFail($id);

        if ($student->semester != $course->semester_offered) {
            return response()->json(['error' => 'Semester mata kuliah tidak sesuai dengan semester Anda'], 422);
        }
        
        $enrollment = \App\Models\TakesModel::where('student_id', $student->student_id)
            ->where('course_id', $course->course_id)
            ->first();

        if (!$enrollment) {
            \App\Models\TakesModel::create([
                'student_id' => $student->student_id,
                'course_id'  => $course->course_id,
                'enroll_date' => now(),
                'status' => 'ongoing',
                'attendance' => 0,
            ]);
        }
        else if ($enrollment->status === 'dropped') {
            \App\Models\TakesModel::where('student_id', $student->student_id)
                ->where('course_id', $course->course_id)
                ->update([
                    'status' => 'ongoing',
                    'enroll_date' => now(),
                ]);
        }
        else {
            return response()->json(['error' => 'Anda sudah terdaftar pada mata kuliah ini'], 409);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Enrolled successfully',
            'inserted'  => ['course_id' => (int)$id, 'status' => 'ongoing']
        ]);
    }

    public function enrollBulk(Request $request)
    {
        try {
            $user = auth()->user();
            $student = \App\Models\StudentsModel::where('student_id', $user->user_id)->firstOrFail();
            $courseIds = $request->input('course_ids', []);

            if (!is_array($courseIds) || empty($courseIds)) {
                return response()->json(['error' => 'Tidak ada mata kuliah yang dipilih'], 400);
            }
            
            $inserted = [];
            foreach ($courseIds as $cid) {
                $enrollment = \App\Models\TakesModel::where('student_id', $student->student_id)
                    ->where('course_id', $cid)
                    ->first();

                if (!$enrollment) {
                    \App\Models\TakesModel::create([
                        'student_id' => $student->student_id,
                        'course_id'  => $cid,
                        'status'     => 'ongoing',
                        'enroll_date'=> now()
                    ]);
                    $inserted[] = ['course_id' => $cid, 'status' => 'ongoing'];
                }
                else if ($enrollment->status === 'dropped') {
                    \App\Models\TakesModel::where('student_id', $student->student_id)
                        ->where('course_id', $cid)
                        ->update(['status' => 'ongoing', 'enroll_date' => now()]);
                    $inserted[] = ['course_id' => $cid, 'status' => 'ongoing'];
                }
            }
            return response()->json(['status' => 'success', 'inserted' => $inserted], 200);

        } catch (\Throwable $e) {
            \Log::error('Enroll bulk error: '.$e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }
    
    public function drop(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->role !== 'student') return response()->json(['error' => 'Unauthorized'], 403);

        $student = \App\Models\StudentsModel::where('student_id', $user->user_id)->firstOrFail();

        $affectedRows = \App\Models\TakesModel::where('student_id', $student->student_id)
            ->where('course_id', $id)
            ->where('status', 'ongoing')
            ->update(['status' => 'dropped', 'updated_at' => now()]);
        
        if ($affectedRows > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Course dropped',
                'updated' => [
                    'course_id' => (int)$id,
                    'status'    => 'dropped'
                ]
            ]);
        }

        return response()->json(['error' => 'Mata kuliah tidak ditemukan atau statusnya tidak "ongoing"'], 404);
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
        return redirect()->route('admin.courses.index')->with('success', 'Course added successfully.');
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
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }
    public function destroy($id, Request $request)
    {
        $course = CoursesModel::findOrFail($id);
        $course->delete();
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted!');
    }
}