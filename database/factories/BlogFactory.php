<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Carbon\Carbon;

use App\Models\Blog;
use App\Models\User;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->text(),
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }

    public function withRandomTimestamps(): static
    {
        return $this->state(function (array $attributes) {
            $createdAt = $this->generateRandomTimestamps();
            return [
                'created_at' => $createdAt,
                'updated_at' => $this->generateRandomTimestamps($createdAt),
            ];
        });
    }

    private function generateRandomTimestamps(?Carbon $after = null): Carbon
    {
        $date = Carbon::now()->subDays(rand(1, 365));

        $date->setHour(rand(0, 23))
            ->setMinute(rand(0, 59))
            ->setSecond(rand(0, 59));

        return $after ? $date->max($after) : $date;
    }
}
