<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\User;
use App\Models\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;

class UserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Users/Index', [
            'users' => User::orderByDesc('created_at')->with('role')->paginate(5),
        ]);
    }

    public function create(): Response
    {
        $roles = UserRole::pluck('title', 'id');

        return Inertia::render('Admin/Users/Create', [
            'roles' => $roles,
            'defaultRoleId' => $roles->search(UserRole::USER),
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        User::create([
            'login' => $validated['login'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'desc' => $validated['desc'],
        ]);

        session()->flash('message', 'Пользователь успешно создан!');

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'roles' => UserRole::pluck('title', 'id'),
        ]);
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $user->update($validated);

        session()->flash('message', 'Пользователь успешно обновлен!');

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        session()->flash('message', 'Пользователь успешно удален!');

        return redirect()->route('admin.users.index');
    }
}
