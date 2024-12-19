<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkExperienceController extends Controller
{
    public function index()
    {
        $experience = [
            [
                'id' => 1,
                'company_name' => 'Company 1',
                'start_date' => '2023-05-15',
                'end_date' => '2023-09-25',
                'position' => 'прогер',
                'technology_stack' => ['PHP', 'Mysql'],
                'desc' => 'Была такая история',
            ],
            [
                'id' => 2,
                'company_name' => 'Company 2',
                'start_date' => '2024-03-12',
                'end_date' => '2024-12-10',
                'position' => 'прогер',
                'technology_stack' => ['PHP', 'Laravel'],
                'desc' => 'Все началось с одного случая',
            ],

        ];
        return Inertia::render('WorkExperience', ['experience' => $experience]);
    }
}
