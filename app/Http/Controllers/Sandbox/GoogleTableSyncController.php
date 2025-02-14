<?php

namespace App\Http\Controllers\Sandbox;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;

class GoogleTableSyncController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Sandbox/GoogleTableSync', []);
    }
}
