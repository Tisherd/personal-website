<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkExperienceRequest;
use App\Http\Requests\UpdateWorkExperienceRequest;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\WorkExperience;

class WorkExperienceController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/WorkExperiences/Index', [
            'workExperiences' => WorkExperience::paginate(5),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/WorkExperiences/Create', []);
    }

    public function store(StoreWorkExperienceRequest $request)
    {
        $validated = $request->validated();
        dd($validated);

        WorkExperience::create([
            'login' => $validated['login'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'desc' => $validated['desc'],
        ]);

        session()->flash('message', 'Опыт работы успешно создан!');

        return redirect()->route('admin.work_experiences.index');
    }

    public function edit(WorkExperience $workExperience)
    {
        return Inertia::render('Admin/WorkExperiences/Edit', [
            'user' => $workExperience,
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
