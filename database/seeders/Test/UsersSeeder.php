<?php

namespace Database\Seeders\Test;

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(10);
    }
}
