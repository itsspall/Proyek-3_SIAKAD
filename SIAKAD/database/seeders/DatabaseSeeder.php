<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\CoursesSeeder;
use Database\Seeders\StudentsSeeder;
use Database\Seeders\TakesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in order: users -> courses -> students -> takes
        $this->call([
            UsersSeeder::class,
            CoursesSeeder::class,
            StudentsSeeder::class,
            TakesSeeder::class,
        ]);
    }
}
