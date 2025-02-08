<?php

namespace Database\Seeders\Init;

use Illuminate\Database\Seeder;

use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->firstOrCreate([
            'login' => env('ADMIN_USER_LOGIN'),
            'name' => env('ADMIN_USER_NAME'),
            'password' => env('ADMIN_USER_PASSWORD'),
            'desc' => "It's me"
        ]);
    }
}
