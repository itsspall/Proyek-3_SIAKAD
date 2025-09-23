<?php
use Tests\TestCase;
use App\Models\UsersModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function student_sees_student_navigation()
    {
        $student = UsersModel::factory()->create([
            'role' => 'student',
            'password' => bcrypt('password123'),
        ]);

        $this->actingAs($student);
        session(['role' => 'student']);

        $response = $this->get('/home');
        $response->assertSee('Courses');
        $response->assertSee('Profile');
    }

    #[Test]
    public function admin_sees_admin_navigation()
    {
        $admin = UsersModel::factory()->create([
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        $this->actingAs($admin);
        session(['role' => 'admin']);

        $response = $this->get('/home');
        $response->assertSee('Users');
        $response->assertSee('Courses');
    }
}
