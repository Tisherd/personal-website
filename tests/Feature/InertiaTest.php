<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InertiaTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_users_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get('/users')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Users/Index')
            );
    }

    public function test_guest_is_redirected_to_login_page(): void
    {
        $this->get('/users')
            ->assertRedirect('/login'); // Проверяем редирект на страницу входа
    }
}
