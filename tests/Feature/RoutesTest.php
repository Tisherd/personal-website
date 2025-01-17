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

    public function test_guest_cannot_access_protected_routes(): void
    {
        $response = $this->get(route('resume.about_me.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test authenticated routes.
     */
    public function test_authenticated_user_can_access_resume_routes(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('resume.about_me.index'));
        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_access_projects_page(): void
    {
        /** @var \App\Models\User $user */
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
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin);

        $response = $this->get(route('admin.about_me.index'));
        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_routes(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('admin.about_me.index'));
        $response->assertNotFound();
    }

    /**
     * Test redirects.
     */
    public function test_root_redirects_to_resume_about_me(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/');
        $response->assertRedirect(route('resume.about_me.index'));
    }
}
