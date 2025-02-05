<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Blog;
use App\Models\UserRole;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'message' => fake()->text(),
            'user_id' => UserRole::firstWhere('title', UserRole::ADMIN)->users()->first()->id,
        ];
    }
}
