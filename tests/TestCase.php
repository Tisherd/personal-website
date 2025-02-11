<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Models\User;
use Database\Seeders\Init\AboutMeBaseStructureSeeder;
use Database\Seeders\Init\UserRolesSeeder;

abstract class TestCase extends BaseTestCase
{
    protected User $simpleUser;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(UserRolesSeeder::class);
        $this->seed(AboutMeBaseStructureSeeder::class);

        $this->simpleUser = User::factory()->create();
        $this->adminUser = User::factory()->admin()->create();
    }
}
