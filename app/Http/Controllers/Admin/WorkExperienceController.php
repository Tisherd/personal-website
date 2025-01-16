<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use App\Http\Requests\StoreWorkExperienceRequest;
use App\Http\Requests\UpdateWorkExperienceRequest;

class WorkExperienceController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/WorkExperiences/Index', [
            'workExperiences' => WorkExperience::paginate(5),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/WorkExperiences/Create', []);
    }

    public function store(StoreWorkExperienceRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        WorkExperience::create($validated);

        session()->flash('message', 'Опыт работы успешно создан!');

        return redirect()->route('admin.work_experiences.index');
    }

    public function edit(WorkExperience $workExperience): Response
    {
        return Inertia::render('Admin/WorkExperiences/Edit', [
            'workExperience' => $workExperience,
        ]);
    }

    public function update(UpdateWorkExperienceRequest $request, WorkExperience $workExperience): RedirectResponse
    {
        $validated = $request->validated();

        $workExperience->update($validated);

        session()->flash('message', 'Опыт работы успешно обновлен!');

        return redirect()->route('admin.work_experiences.index');
    }

    public function destroy(WorkExperience $workExperience): RedirectResponse
    {
        $workExperience->delete();

        session()->flash('message', 'Опыт работы успешно удален!');

        return redirect()->route('admin.work_experiences.index');
    }
}
