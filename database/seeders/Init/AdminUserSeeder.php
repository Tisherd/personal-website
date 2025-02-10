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
                'login' => env('ADMIN_USER_LOGIN'),
            ],
            [
                'name' => env('ADMIN_USER_NAME'),
                'password' => env('ADMIN_USER_PASSWORD'),
                'role_id' => UserRole::where('title', UserRole::ADMIN)->first()->id,
                'desc' => "It's me"
            ]
        );
    }
}
