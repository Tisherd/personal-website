<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::factory(5)->create();
    }
}
