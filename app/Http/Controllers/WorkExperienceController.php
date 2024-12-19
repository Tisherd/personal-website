<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Resume\WorkExperience;

class WorkExperienceController extends Controller
{
    public function index()
    {
        $workExperience = WorkExperience::all();

        return Inertia::render('WorkExperience', [
            'experience' => WorkExperience::withPeriodAttribute($workExperience)->toArray(),
            'count' => $workExperience->count(),
            'total_period_in_month' => WorkExperience::calculateTotalPeriod($workExperience),
        ]);
    }
}
