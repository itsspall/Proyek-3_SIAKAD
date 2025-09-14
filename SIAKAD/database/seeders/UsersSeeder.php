<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_id' => 005524101,
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'full_name' => 'Administrator',
            'email' => 'adminexample@gmail.com',
            'phone_number' => '081234567890',
            'status' => 'active',
        ]);
        User::create([
            'user_id' => 241511053,
            'username' => 'student1',
            'password' => Hash::make('student123'),
            'role' => 'student',
            'full_name' => 'Student One',
            'email' => 'student1example@gmail.com',
            'phone_number' => '081298765432',
            'status' => 'active',
        ]);
        User::create([
            'user_id' => 241511054,
            'username' => 'student2',
            'password' => Hash::make('student123'),
            'role' => 'student',
            'full_name' => 'Student Two',
            'email' => 'student2example@gmail.com',
            'phone_number' => '081298765433',
            'status' => 'active',
        ]);
    }
}
