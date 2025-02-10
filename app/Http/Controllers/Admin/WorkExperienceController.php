<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\WorkExperience;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkExperience\StoreRequest;
use App\Http\Requests\Admin\WorkExperience\UpdateRequest;

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

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        WorkExperience::create($validated);

        return redirect()
            ->route('admin.work_experiences.index')
            ->with('message', 'Опыт работы успешно создан!');
    }

    public function edit(WorkExperience $workExperience): Response
    {
        return Inertia::render('Admin/WorkExperiences/Edit', [
            'workExperience' => $workExperience,
        ]);
    }

    public function update(UpdateRequest $request, WorkExperience $workExperience): RedirectResponse
    {
        $validated = $request->validated();

        $workExperience->update($validated);

        return redirect()
            ->route('admin.work_experiences.index')
            ->with('message', 'Опыт работы успешно обновлен!');
    }

    public function destroy(WorkExperience $workExperience): RedirectResponse
    {
        $workExperience->delete();

        return redirect()
            ->route('admin.work_experiences.index')
            ->with('message', 'Опыт работы успешно удален!');
    }
}
