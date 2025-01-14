<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class QuestionsController extends Controller
{
    public function index()
    {
        return Inertia::render('Resume/Questions', []);
    }
}
