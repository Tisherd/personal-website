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

    /**
     * Test guest routes.
     */
    public function test_guest_routes(): void
    {
        $this->get(route('login'))->assertStatus(200);

        $this->get(route('resume.about_me.index'))->assertRedirect(route('login'));
        $this->get(route('resume.work_experiences.index'))->assertRedirect(route('login'));
        $this->get(route('resume.skills.index'))->assertRedirect(route('login'));
        $this->get(route('resume.questions.index'))->assertRedirect(route('login'));

        $this->get(route('projects.index'))->assertRedirect(route('login'));
        $this->get(route('sandbox.index'))->assertRedirect(route('login'));
        $this->get(route('blog.index'))->assertRedirect(route('login'));

        $this->get(route('admin.about_me.index'))->assertRedirect(route('login'));
        $this->get(route('admin.work_experiences.index'))->assertRedirect(route('login'));
        $this->get(route('admin.projects.index'))->assertRedirect(route('login'));
        $this->get(route('admin.users.index'))->assertRedirect(route('login'));

        $this->get('/telescope')->assertNotFound();
    }

    public function test_telescope_route(): void
    {
        $this->get('/telescope')->assertNotFound();
        $this->actingAs($this->simpleUser)->get('/telescope')->assertNotFound();
        $this->actingAs($this->adminUser)->get('/telescope')->assertStatus(200);
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
