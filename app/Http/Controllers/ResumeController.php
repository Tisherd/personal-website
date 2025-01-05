<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Resume\WorkExperience;

class ResumeController extends Controller
{
    public function index()
    {
        $aboutMe = [
            'full_name' => 'Иванов Андрей Борисович',
            'date_of_birth' => '1997-03-16',
            'photo' => asset('storage/images/avatar.jpg'), // путь к изображению
            'education' => '-',
            'about_me' => 'Я опытный разработчик с более чем 5-летним стажем работы в области веб-разработки.',
            'email' => 'ivan.ivanov@example.com',
            'phone' => '+7 (900) 123-45-67',
        ];

        $workExperience = WorkExperience::all();

        return Inertia::render('Resume/Main', [
            'aboutMe' => $aboutMe,
            'workExperience' => [
                'experience' => WorkExperience::withPeriodAttribute($workExperience)->toArray(),
                'count' => $workExperience->count(),
                'totalPeriodInMonth' => WorkExperience::calculateTotalPeriod($workExperience),
            ],
        ]);
    }
}
