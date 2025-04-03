<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\Skill;
use App\Models\SkillGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resume\SkillRequest;

class SkillController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Skills/Index', [
            'skills' => Skill::with('group')->orderByDesc('sort')->paginate(5),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Skills/Create', [
            'skill_groups' => SkillGroup::pluck('name', 'id'),
        ]);
    }

    public function store(SkillRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Skill::create($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('message', 'Проект успешно создан!');
    }

    public function edit(Skill $skill): Response
    {
        return Inertia::render('Admin/Skill/Edit', [
            'skill' => $skill,
            'skill_groups' => SkillGroup::pluck('name', 'id'),
        ]);
    }

    public function update(SkillRequest $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validated();

        $skill->update($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('message', 'Проект успешно обновлен!');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('message', 'Проект успешно удален!');
    }
}
