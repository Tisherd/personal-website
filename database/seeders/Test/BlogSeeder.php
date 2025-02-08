<?php

namespace Database\Seeders\Test;

use Illuminate\Database\Seeder;

use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::factory(10)->randomTime()->create();
    }
}
