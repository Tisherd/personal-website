<?php

namespace App\Http\Controllers\Blog;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class IndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Blog/Main', [
            'blogs' => Blog::orderByDesc('created_at')->with('user')->paginate(10),
        ]);
    }
}
