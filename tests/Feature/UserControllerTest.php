<?php

namespace Tests\Feature;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use PHPUnit\Framework\Attributes\Test;

use Tests\TestCase;

use App\Models\User;
use App\Models\UserRole;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(ValidateCsrfToken::class);
        $this->actingAs($this->adminUser);
    }

    #[Test]
    public function it_can_display_the_users_index_page()
    {
        $this->get(route('admin.users.index'))
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('Admin/Users/Index')
                    ->has('users')
            );
    }

    #[Test]
    public function it_can_display_the_create_user_page()
    {
        $this->get(route('admin.users.create'))
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('Admin/Users/Create')
                    ->has('roles')
                    ->has('defaultRoleId')
            );
    }

    #[Test]
    public function it_can_create_a_new_user()
    {
        $this->from(route('admin.users.create'));

        $response = $this->post(route('admin.users.store'), [
            'login' => 'testuser',
            'name' => 'user_name',
            'password' => 'password',
            'role_id' => UserRole::where('title', UserRole::USER)->first()->id,
            'desc' => 'Test description',
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['login' => 'testuser']);
    }

    #[Test]
    public function it_can_display_the_edit_user_page()
    {
        $user = User::factory()->create();

        $this->get(route('admin.users.edit', $user))
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('Admin/Users/Edit')
                    ->has('user')
                    ->has('roles')
            );
    }

    #[Test]
    public function it_can_update_an_existing_user()
    {
        $user = User::factory()->create([
            'login' => 'oldlogin',
            'desc' => 'Old description',
        ]);

        $response = $this->put(route('admin.users.update', ['user' => $user]), [
            'login' => 'newlogin',
            'name' => $user->name,
            'role_id' => $user->role_id,
            'desc' => 'Updated description',
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['login' => 'newlogin', 'desc' => 'Updated description']);
    }

    #[Test]
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('admin.users.destroy', $user));

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
