<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->create([
            'login' => env('ADMIN_USER_LOGIN'),
            'name' => env('ADMIN_USER_NAME'),
            'password' => env('ADMIN_USER_PASSWORD'),
            'desc' => "It's me"
        ]);
    }
}
