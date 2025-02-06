<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class LoadMoreController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $blogs = Blog::latest()->with('user')->paginate(20);

        return response()->json([
            'data' => $blogs->items(),
            'next_page_url' => $blogs->nextPageUrl(),
        ]);
    }
}
