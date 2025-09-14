<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CoursesModel;

class CoursesSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursesModel::create([
            'course_code' => 'CS101',
            'course_name' => 'Introduction to Computer Science',
            'credits' => 3,
            'semester_offered' => 1,
            'description' => 'Basic concepts of computer science, including algorithms, data structures, and programming principles.',
            'room' => 'Room 101',
            'lecturer' => 'Dr. Smith',
        ]);

        CoursesModel::create([
            'course_code' => 'CS102',
            'course_name' => 'Data Structures',
            'credits' => 3,
            'semester_offered' => 2,
            'description' => 'Study of data structures such as arrays, linked lists, stacks, queues, trees, and graphs.',
            'room' => 'Room 102',
            'lecturer' => 'Prof. Johnson',
        ]);

        CoursesModel::create([
            'course_code' => 'CS201',
            'course_name' => 'Database Systems',
            'credits' => 3,
            'semester_offered' => 3,
            'description' => 'Introduction to database concepts, relational models, SQL, and database design.',
            'room' => 'Room 201',
            'lecturer' => 'Dr. Williams',
        ]);

        CoursesModel::create([
            'course_code' => 'CS202',
            'course_name' => 'Operating Systems',
            'credits' => 3,
            'semester_offered' => 4,
            'semester_offered' => 3,
            'description' => 'Study of operating system concepts, including process management, memory management, and file systems.',
            'room' => 'Room 202',
            'lecturer' => 'Prof. Brown',
        ]);
    }
}
