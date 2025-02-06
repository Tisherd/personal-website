<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Carbon\Carbon;

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

    public function randomTime(): static
    {
        return $this->state(function () {
            $createdAt = $this->randomDateTime();

            return [
                'created_at' => $createdAt,
                'updated_at' => $this->randomDateTime($createdAt),
            ];
        });
    }

    private function randomDateTime(?Carbon $after = null): Carbon
    {
        $date = Carbon::now()->subDays(rand(1, 365));

        $date->setHour(rand(0, 23))
            ->setMinute(rand(0, 59))
            ->setSecond(rand(0, 59));

        return $after ? $date->max($after) : $date;
    }
}
