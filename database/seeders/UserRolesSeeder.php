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
        $roles = [
            UserRole::ADMIN,
            UserRole::USER,
        ];

        foreach ($roles as $role) {
            UserRole::firstOrCreate(['title' => $role]);
        }
    }
}
