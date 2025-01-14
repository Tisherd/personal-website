<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkExperienceRequest;
use App\Http\Requests\UpdateWorkExperienceRequest;
use App\Models\WorkExperience;

class WorkExperienceController extends Controller
{
    public function index()
    {
        return inertia('Admin/WorkExperiences/Index', [
            'workExperiences' => WorkExperience::paginate(5),
        ]);
    }

    public function create()
    {
        return inertia('Admin/WorkExperiences/Create', []);
    }

    public function store(StoreWorkExperienceRequest $request)
    {
        $validated = $request->validated();

        WorkExperience::create($validated);

        session()->flash('message', 'Опыт работы успешно создан!');

        return redirect()->route('admin.work_experiences.index');
    }

    public function edit(WorkExperience $workExperience)
    {
        return inertia('Admin/WorkExperiences/Edit', [
            'workExperience' => $workExperience,
        ]);
    }

    public function update(UpdateWorkExperienceRequest $request, WorkExperience $workExperience)
    {
        $validated = $request->validated();

        $workExperience->update($validated);

        session()->flash('message', 'Опыт работы успешно обновлен!');

        return redirect()->route('admin.work_experiences.index');
    }

    public function destroy(WorkExperience $workExperience)
    {
        $workExperience->delete();

        session()->flash('message', 'Опыт работы успешно удален!');

        return redirect()->route('admin.work_experiences.index');
    }
}
