<?php

namespace Database\Factories;

use App\Models\GoogleTableSync;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoogleTableSync>
 */
class GoogleTableSyncFactory extends Factory
{
    protected $model = GoogleTableSync::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'value' => $this->faker->numberBetween(1, 1000),
            'status' => $this->faker->randomElement([
                GoogleTableSync::ALLOWED_STATUS,
                GoogleTableSync::PROHIBITED_STATUS
            ]),
        ];
    }
}
