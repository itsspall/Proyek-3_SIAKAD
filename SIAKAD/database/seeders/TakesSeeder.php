<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TakesModel;
use App\Models\StudentsModel;
use App\Models\CoursesModel;

class TakesSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //     // Lookup users created by UsersSeeder and use their user_id to find student records
    //     $user1 = \App\Models\User::where('username', 'student1')->first();
    //     $user2 = \App\Models\User::where('username', 'student2')->first();

    //     $course_cs101 = CoursesModel::where('course_code', 'CS101')->first();
    //     $course_cs102 = CoursesModel::where('course_code', 'CS102')->first();
    //     $course_cs201 = CoursesModel::where('course_code', 'CS201')->first();

    //     if ($user1) {
    //         $student1 = StudentsModel::where('student_id', $user1->user_id ?? $user1->id)->first();
    //         if ($student1 && $course_cs101) {
    //             TakesModel::create([
    //                 'student_id' => $student1->student_id,
    //                 'course_id' => $course_cs101->course_id ?? $course_cs101->id,
    //             ]);
    //         }
    //         if ($student1 && $course_cs102) {
    //             TakesModel::create([
    //                 'student_id' => $student1->student_id,
    //                 'course_id' => $course_cs102->course_id ?? $course_cs102->id,
    //             ]);
    //         }
    //     } else {
    //         $this->command->info('User student1 not found; skipping enrollments for student1.');
    //     }

    //     if ($user2) {
    //         $student2 = StudentsModel::where('student_id', $user2->user_id ?? $user2->id)->first();
    //         if ($student2 && $course_cs201) {
    //             TakesModel::create([
    //                 'student_id' => $student2->student_id,
    //                 'course_id' => $course_cs201->course_id ?? $course_cs201->id,
    //             ]);
    //         }
    //     } else {
    //         $this->command->info('User student2 not found; skipping enrollments for student2.');
    //     }
    }
}
