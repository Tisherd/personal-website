<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Http\Requests\Admin\AboutMe\UpdateRequest;

class AboutMeController extends Controller
{
    public function index()
    {
        $data = AboutMe::firstOrFail();
        return inertia('Admin/AboutMe', ['aboutMe' => $data]);
    }

    public function update(UpdateRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('images/resume', 'public');
        }

        $aboutMe = AboutMe::firstOrFail();
        $aboutMe->update($validated);

        return back()->with('message', 'Данные обновлены.');
    }
}
