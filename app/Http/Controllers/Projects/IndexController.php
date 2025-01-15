<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return inertia('Projects/Main');
    }
}
