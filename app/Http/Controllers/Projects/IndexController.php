<?php

namespace App\Http\Controllers\Projects;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\Project;

class IndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Projects/Main', [
            'projects' => Project::all(),
        ]);
    }
}
