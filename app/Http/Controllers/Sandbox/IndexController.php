<?php

namespace App\Http\Controllers\Sandbox;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return inertia('Sandbox/Main');
    }
}
