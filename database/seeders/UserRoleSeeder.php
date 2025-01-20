<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
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
