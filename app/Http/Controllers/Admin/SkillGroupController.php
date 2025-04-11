<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\SkillGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resume\SkillGroupRequest;

class SkillGroupController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/SkillGroups/Index', [
            'skill_groups' => SkillGroup::orderBy('sort')->paginate(5),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/SkillGroups/Create', []);
    }

    public function store(SkillGroupRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        SkillGroup::create($validated);

        return redirect()
            ->route('admin.skill_groups.index')
            ->with('message', 'Проект успешно создан!');
    }

    public function edit(SkillGroup $skillGroup): Response
    {
        return Inertia::render('Admin/SkillGroups/Edit', [
            'skill_group' => $skillGroup,
        ]);
    }

    public function update(SkillGroupRequest $request, SkillGroup $skillGroup): RedirectResponse
    {
        $validated = $request->validated();

        $skillGroup->update($validated);

        return redirect()
            ->route('admin.skill_groups.index')
            ->with('message', 'Проект успешно обновлен!');
    }

    public function destroy(SkillGroup $skillGroup): RedirectResponse
    {
        $skillGroup->delete();

        return redirect()
            ->route('admin.skill_groups.index')
            ->with('message', 'Проект успешно удален!');
    }
}
