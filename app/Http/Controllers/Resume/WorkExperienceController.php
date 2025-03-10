<?php

namespace App\Http\Controllers\Resume;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\WorkExperience;
use App\Http\Controllers\Controller;

class WorkExperienceController extends Controller
{
    public function index(): Response
    {
        $workExperience = WorkExperience::all();
        return Inertia::render('Resume/WorkExperience', [
            'workExperiences' => $workExperience,
            'activeMonths' => WorkExperience::calculateActiveMonths($workExperience),
        ]);
    }
}
