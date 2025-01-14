<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use Illuminate\Support\Facades\Storage;

class AboutMeController extends Controller
{
    public function index()
    {
        $data = AboutMe::firstOrFail();
        dump($data->toArray());
        return inertia('Resume/AboutMe', ['aboutMe' => $data]);
    }
}
