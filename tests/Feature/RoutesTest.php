<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use App\Models\User;
use Database\Seeders\UserRolesSeeder;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(UserRolesSeeder::class);
    }

    /**
     * Test guest routes.
     */
    public function test_guest_can_access_login_page(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200); // Проверка, что страница доступна
    }

    public function test_guest_cannot_access_protected_routes(): void
    {
        $response = $this->get(route('resume.about_me.index'));
        $response->assertRedirect(route('login')); // Проверка, что перенаправляется на страницу логина
    }

    /**
     * Test authenticated routes.
     */
    public function test_authenticated_user_can_access_resume_routes(): void
    {
        $user = User::factory()->create(); // Создание тестового пользователя

        $this->actingAs($user); // Авторизация пользователя

        $response = $this->get(route('resume.about_me.index'));
        $response->assertStatus(200); // Проверка доступа к маршруту
    }

    public function test_authenticated_user_can_access_projects_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('projects.index'));
        $response->assertStatus(200);
    }

    /**
     * Test admin routes.
     */
    public function test_admin_can_access_admin_routes(): void
    {
        $admin = User::factory()->create(['role' => 'admin']); // Создание администратора

        $this->actingAs($admin);

        $response = $this->get(route('admin.about_me.index'));
        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('admin.about_me.index'));
        $response->assertForbidden(); // Проверка, что доступ запрещён
    }

    /**
     * Test redirects.
     */
    public function test_root_redirects_to_resume_about_me(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/');
        $response->assertRedirect(route('resume.about_me.index'));
    }
}
