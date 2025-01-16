<?php

namespace App\Http\Controllers\Resume;

use Illuminate\Support\Facades\Cache;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\AboutMe;
use App\Http\Controllers\Controller;

class AboutMeController extends Controller
{
    public function index(): Response
    {
        $data = Cache::remember('about_me_data', 60, function () {
            $aboutMe = AboutMe::firstOrFail();
    
            return [
                'photoUrl' => $aboutMe->photo_url,
                'fullName' => $aboutMe->full_name,
                'birthdateFormatted' => $aboutMe->birthdate_formatted,
                'fullAge' => $aboutMe->full_age,
            ];
        });

        return Inertia::render('Resume/AboutMe', $data);
    }
}
