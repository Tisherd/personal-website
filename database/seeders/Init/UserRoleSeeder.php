<?php

namespace Database\Seeders\Init;

use Illuminate\Database\Seeder;

use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
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
