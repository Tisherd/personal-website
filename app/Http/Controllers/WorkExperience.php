<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkExperience extends Controller
{
    public function index()
    {
        return Inertia::render('WorkExperience', [
            'title' => 'Work Experience',
        ]);
    }
}
