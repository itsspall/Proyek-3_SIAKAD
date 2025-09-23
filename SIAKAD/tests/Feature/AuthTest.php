<?php

use Tests\TestCase;
use App\Models\UsersModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_can_login_and_be_redirected()
    {
        $admin = UsersModel::factory()->create([
            'username' => 'admin',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        $response = $this->post(route('login.post'), [
            'username' => 'admin',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.courses.index'));
        $this->assertEquals('admin', session('role'));
    }

    #[Test]
    public function login_fails_with_invalid_credentials()
    {
        $response = $this->post(route('login.post'), [
            'username' => 'wronguser',
            'password' => 'wrongpass',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors();
    }
}
