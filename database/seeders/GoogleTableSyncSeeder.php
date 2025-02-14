<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\GoogleTableSync;

class GoogleTableSyncSeeder extends Seeder
{
    public function run(): void
    {
        GoogleTableSync::factory(100)->create();
    }
}
