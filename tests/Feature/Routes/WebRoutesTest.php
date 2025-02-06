<?php

namespace Tests\Feature\Routes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

use Tests\TestCase;

class WebRoutesTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function check_login_route(): void
    {
        $this->get(route('login'))->assertStatus(200);

        $this->actingAs($this->simpleUser);

        $this->get(route('login'))->assertRedirect('/');
    }

    #[Test]
    public function check_user_routes(): void
    {
        $routes = [
            route('resume.about_me.index'),
            route('resume.work_experiences.index'),
            route('resume.skills.index'),
            route('resume.questions.index'),
            route('projects.index'),
            route('sandbox.index'),
            route('blogs.index'),
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertRedirect(route('login'));
        }

        $this->actingAs($this->simpleUser);

        foreach ($routes as $route) {
            $this->get($route)->assertStatus(200);
        }
    }

    #[Test]
    public function check_admin_routes(): void
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
