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
        dump(config('services.main_admin_user.login'));
        dump('s');
        $data = Cache::remember(AboutMe::CACHE_KEY, 60, function () {
            return AboutMe::find(AboutMe::DOC_ID)
                ->append([
                    'photo_url',
                    'birthdate_formatted',
                    'full_age',
                ])->toArray();
        });

        return Inertia::render('Resume/AboutMe', $data);
    }
}
