<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'tester', 'user'];

        foreach ($roles as $role) {
            UserRole::firstOrCreate(['title' => $role]);
        }
    }
}
