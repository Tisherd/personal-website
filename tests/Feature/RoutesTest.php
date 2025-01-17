<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use App\Models\User;
use Database\Seeders\AboutMeSeeder;
use Database\Seeders\UserRolesSeeder;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    protected User $simpleUser;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(UserRolesSeeder::class);
        $this->seed(AboutMeSeeder::class);

        $this->simpleUser = User::factory()->create();
        $this->adminUser = User::factory()->admin()->create();
    }

    public function test_login_route(): void
    {
        $this->get(route('login'))->assertStatus(200);

        $this->actingAs($this->simpleUser);

        $this->get(route('login'))->assertRedirect(route('resume.about_me.index'));

        $this->get(route('projects.index'))->assertRedirect(route('login'));
        $this->get(route('sandbox.index'))->assertRedirect(route('login'));
        $this->get(route('blog.index'))->assertRedirect(route('login'));
    }

    public function test_resume_routes(): void
    {
        $routes = [
            route('resume.about_me.index'),
            route('resume.work_experiences.index'),
            route('resume.skills.index'),
            route('resume.questions.index'),
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertRedirect(route('login'));
        }

        $this->actingAs($this->simpleUser);

        foreach ($routes as $route) {
            $this->get($route)->assertStatus(200);
        }
    }

    public function test_admin_routes(): void
    {
        $routes = [
            route('admin.about_me.index'),
            route('admin.work_experiences.index'),
            route('admin.projects.index'),
            route('admin.users.index'),
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertNotFound();
        }

        $this->actingAs($this->simpleUser);

        foreach ($routes as $route) {
            $this->get($route)->assertNotFound();
        }

        $this->actingAs($this->adminUser);

        foreach ($routes as $route) {
            $this->get($route)->assertStatus(200);
        }
    }
}
