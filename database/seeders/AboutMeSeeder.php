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
            ['id' => 1], // Предполагаем, что запись всегда имеет id = 1
            [
                'full_name' => 'Иван Иванов',
                'birth_date' => '2000-01-01',
                'photo_path' => null,
                'about_me' => 'Это описание обо мне.',
                'contacts' => 'example@mail.com',
            ]
        );
    }
}
