<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();
    }
}
