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
            'full_name' => $this->faker->name,
            'birth_date' => $this->faker->date('Y-m-d'),
            'photo_path' => null,
            'description' => $this->faker->text,
            'contacts' => [
                'email' => $this->faker->email,
                'telegram' => 'https://t.me/' . $this->faker->userName,
            ],
        ];
    }
}
