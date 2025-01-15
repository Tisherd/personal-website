<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return inertia('Blog/Main');
    }
}
