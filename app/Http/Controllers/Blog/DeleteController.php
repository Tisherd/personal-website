<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class DeleteController extends Controller
{
    public function __invoke(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->back();
    }
}
