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
            Init\UserRoleSeeder::class,
            Init\AdminUserSeeder::class,
            Init\AboutMeSeeder::class,
            Init\ProjectSeeder::class,
        ]);
    }
}
