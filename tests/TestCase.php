<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Models\User;
use Database\Seeders\AboutMeSeeder;
use Database\Seeders\UserRoleSeeder;

abstract class TestCase extends BaseTestCase
{
    protected User $simpleUser;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(UserRoleSeeder::class);
        $this->seed(AboutMeSeeder::class);

        $this->simpleUser = User::factory()->create();
        $this->adminUser = User::factory()->admin()->create();
    }
}
