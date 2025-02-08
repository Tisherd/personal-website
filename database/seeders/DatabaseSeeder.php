<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\Init;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Init\UserRolesSeeder::class,
            Init\AdminUserSeeder::class,
            Init\AboutMeBaseStructureSeeder::class,
            Init\ThisProjectSeeder::class,
        ]);
    }
}
