<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;

use Illuminate\Support\Str;

class InertiaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_authenticated_user_can_access_users_page(): void
    {
        // Найти или создать пользователя
        $user = User::firstOrCreate(
            [
                'login' => 'Test User 18'
            ],
            [
                'login' => 'Test User 18',
                'password' => Hash::make(Str::random(20)),
                'role' => 'test',
                'desc' => 'User for testing',
            ]
        );

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
