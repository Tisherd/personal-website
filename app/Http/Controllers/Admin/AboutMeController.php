<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutMe;

class AboutMeController extends Controller
{
    public function index()
    {
        $data = AboutMe::firstOrFail();
        return inertia('Admin/AboutMe', ['aboutMe' => $data]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'photo' => 'nullable|image|max:2048',
            'about_me' => 'required|string',
            'contacts' => 'required|string',
        ]);

        $aboutMe = AboutMe::firstOrFail();
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo_path'] = $path;
        }

        $aboutMe->update([
            'full_name' => $validated['fullName'],
            'birth_date' => $validated['birthDate'],
            'photo_path' => $validated['photo_path'] ?? $aboutMe->photo_path,
            'about_me' => $validated['aboutMe'],
            'contacts' => $validated['contacts'],
        ]);

        return back()->with('message', 'Данные обновлены.');
    }
}
