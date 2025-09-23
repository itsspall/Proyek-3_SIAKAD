<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UsersModel as User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function student_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create([
            'role' => 'student',
            'password' => bcrypt('password123'),
        ]);

        $token = auth()->login($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->get('/dashboard/admin');

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_access_admin_dashboard()
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        $token = auth()->login($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->get('/dashboard/admin');

        $response->assertStatus(200)
                 ->assertSee('Admin Dashboard');
    }
}
