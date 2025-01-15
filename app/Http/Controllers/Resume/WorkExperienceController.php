<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;

class WorkExperienceController extends Controller
{
    public function index()
    {
        return inertia('Resume/WorkExperience', [
            'workExperiences' => WorkExperience::all(),
        ]);
    }
}
