<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\StoreRequest;
use App\Http\Requests\Admin\Project\UpdateRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Projects/Index', [
            'projects' => Project::orderByDesc('created_at')->paginate(5),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Projects/Create', []);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Project::create($validated);

        session()->flash('message', 'Проект успешно создан!');

        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project): Response
    {
        return Inertia::render('Admin/Projects/Edit', [
            'project' => $project,
        ]);
    }

    public function update(UpdateRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();

        $project->update($validated);

        session()->flash('message', 'Проект успешно обновлен!');

        return redirect()->route('admin.projects.index');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        session()->flash('message', 'Проект успешно удален!');

        return redirect()->route('admin.projects.index');
    }
}
