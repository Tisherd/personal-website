<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Http\Requests\Admin\UpdateAboutMeRequest;

class AboutMeController extends Controller
{
    public function index()
    {
        $data = AboutMe::firstOrFail();
        return inertia('Admin/AboutMe', ['aboutMe' => $data]);
    }

    public function update(UpdateAboutMeRequest $request)
    {
        $validated = $request->validated();

        $aboutMe = AboutMe::firstOrFail();
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo_path'] = $path;
        }

        $aboutMe->update($validated);

        return back()->with('message', 'Данные обновлены.');
    }
}
