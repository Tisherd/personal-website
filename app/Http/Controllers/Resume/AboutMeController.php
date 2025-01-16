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
            return AboutMe::firstOrFail();
        });

        /*
            TODO: photo_url, birthdate_formatted и full_age - атрибуты, которые вычисляются, а не получаются из бд
            Т.е их тоже есть смысл закинуть в кэширование
        */

        return Inertia::render('Resume/AboutMe', [
            'photoUrl' => $data->photo_url,
            'fullName' => $data->full_name,
            'birthdateFormatted'=>$data->birthdate_formatted,
            'fullAge' => $data->full_age,
        ]);
    }
}
