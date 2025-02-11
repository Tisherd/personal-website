<?php

namespace Database\Seeders\Init;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserRole;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            [
                'login' => config('services.main_admin_user.login'),
            ],
            [
                'name' => config('services.main_admin_user.name'),
                'password' => config('services.main_admin_user.password'),
                'role_id' => UserRole::where('title', UserRole::ADMIN)->first()->id,
                'desc' => "It's me"
            ]
        );
    }
}
