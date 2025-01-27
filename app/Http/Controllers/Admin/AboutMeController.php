<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Http\Requests\Admin\AboutMe\UpdateRequest;

class AboutMeController extends Controller
{
    public function index(): Response
    {
        $data = AboutMe::firstOrFail();
        return Inertia::render('Admin/AboutMe', $data);
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('images/resume', 'public');
        }

        $aboutMe = AboutMe::find(AboutMe::DOC_ID);
        $aboutMe->update($validated);

        return back()->with('message', 'Данные обновлены.');
    }
}
