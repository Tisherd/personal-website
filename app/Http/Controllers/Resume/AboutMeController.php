<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;

class AboutMeController extends Controller
{
    public function index()
    {
        $data = AboutMe::firstOrFail();

        return inertia('Resume/AboutMe', [
            'photoUrl' => $data->photo_url,
            'fullName' => $data->full_name,
            'birthdateFormatted'=>$data->birthdate_formatted,
            'fullAge' => $data->full_age,
        ]);
    }
}
