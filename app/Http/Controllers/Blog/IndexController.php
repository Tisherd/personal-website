<?php

namespace App\Http\Controllers\Blog;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Blog/Main');
    }
}
