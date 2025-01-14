<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AboutMeController extends Controller
{
    public function index()
    {
        return Inertia::render('Resume/AboutMe', []);
    }
}
