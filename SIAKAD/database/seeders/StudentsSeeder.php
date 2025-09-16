<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudentsModel;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;

class StudentsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = UsersModel::where('username', 'student1')->first();
        if (! $user1) {
            $this->command->info('User with username "student1" not found. Skipping student1 creation.');
        } else {
            StudentsModel::create([
                'student_id' => $user1->user_id ?? $user1->id,
                'entry_year' => 2024,
                'major' => 'Informatics Engineering',
                'semester' => 3,
                'dob' => '2005-10-24',
                'gender' => 'female',
                // 'user_id' => $user1->user_id ?? $user1->id,
            ]);
        }

        $user2 = UsersModel::where('username', 'student2')->first();
        if (! $user2) {
            $this->command->info('User with username "student2" not found. Skipping student2 creation.');
        } else {
            StudentsModel::create([
                'student_id' => $user2->user_id ?? $user2->id,
                'entry_year' => 2024,
                'major' => 'Informatics Engineering',
                'semester' => 3,
                'dob' => '2006-05-15',
                'gender' => 'male',
                // 'user_id' => $user2->user_id ?? $user2->id,
            ]);
        }
    }
}
