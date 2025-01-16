<?php

namespace App\Http\Controllers\Resume;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Resume/Questions', []);
    }
}
