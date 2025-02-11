<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\AboutMe;

class AboutMeFactory extends Factory
{
    protected $model = AboutMe::class;

    public function definition()
    {
        return [
            'full_name' => fake()->name(),
            'birth_date' => fake()->date('Y-m-d'),
            'photo_path' => null,
            'description' => fake()->text(),
            'contacts' => [
                'email' => fake()->email(),
                'telegram' => 'https://t.me/' . fake()->userName(),
            ],
        ];
    }
}
