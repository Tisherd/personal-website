<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Blog;

class BlogsSeeder extends Seeder
{
    public function run(): void
    {
        Blog::factory(10)->withRandomTimestamps()->create();
    }
}
