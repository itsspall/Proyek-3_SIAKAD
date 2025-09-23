<?php

namespace Database\Factories;

use App\Models\UsersModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsersModel>
 */
class UsersModelFactory extends Factory
{
    protected $model = UsersModel::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(100000, 999999),
            'username' => $this->faker->unique()->userName(),
            'password' => bcrypt('password123'), // default password
            'role' => $this->faker->randomElement(['admin', 'student']),
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'status' => 'active',
            'last_login' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State khusus admin
     */
    public function admin(): static
    {
        return $this->state(fn () => [
            'role' => 'admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
        ]);
    }

    /**
     * State khusus student
     */
    public function student(): static
    {
        return $this->state(fn () => [
            'role' => 'student',
            'username' => 'student',
            'email' => 'student@example.com',
        ]);
    }
}
