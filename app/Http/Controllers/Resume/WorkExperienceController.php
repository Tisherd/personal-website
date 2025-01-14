<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;

class WorkExperienceController extends Controller
{
    public function index()
    {
        $workExperience = WorkExperience::all();

        return inertia('Resume/WorkExperience', [
            'workExperience' => [
                'experience' => WorkExperience::withPeriodAttribute($workExperience)->toArray(),
                'count' => $workExperience->count(),
                'totalPeriodInMonth' => WorkExperience::calculateTotalPeriod($workExperience),
            ],
        ]);
    }
}
