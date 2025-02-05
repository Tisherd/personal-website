<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class StoreController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Blog::create([
            'message' => $request->message,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
