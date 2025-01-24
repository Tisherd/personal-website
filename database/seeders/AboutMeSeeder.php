<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutMe;

class AboutMeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutMe::firstOrCreate(
            ['_id' => AboutMe::DOC_ID],
            [
                'full_name' => null,
                'birth_date' => null,
                'photo_path' => null,
                'description' => null,

                'contacts' => [
                    'email' => null,
                    'phone' => null,
                    'telegram' => null,
                ],
            ]
        );
    }
}
