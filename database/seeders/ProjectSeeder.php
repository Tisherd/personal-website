<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()->create([
            'title' => 'Personal Website',
            'description' => 'A personal website built with Laravel, Inertia.js, and Vue 3 to showcase my resume and projects.',
            'github_url' => "https://github.com/Tisherd/personal-website",
            'live_url' => "https://tisherd.info"
        ]);
    }
}
