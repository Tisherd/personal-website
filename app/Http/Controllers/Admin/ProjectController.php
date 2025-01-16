<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;

use Inertia\Inertia;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Projects/Index', [
            'projects' => Project::orderByDesc('created_at')->paginate(5),
        ]);
    }

    public function create()
    {
        return inertia('Admin/Projects/Create', []);
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        Project::create($validated);

        session()->flash('message', 'Проект успешно создан!');

        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Admin/Projects/Edit', [
            'project' => $project,
        ]);
    }

    public function update(UpdateRequest $request, Project $project)
    {
        $validated = $request->validated();

        $project->update($validated);

        session()->flash('message', 'Проект успешно обновлен!');

        return redirect()->route('admin.projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        session()->flash('message', 'Проект успешно удален!');

        return redirect()->route('admin.projects.index');
    }
}
