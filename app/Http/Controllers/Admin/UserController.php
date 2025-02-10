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
            'users' => User::latest('id')->with('role')->paginate(10),
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

        return redirect()
            ->route('admin.users.index')
            ->with('message', 'Пользователь успешно создан!');
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

        return redirect()
            ->route('admin.users.index')
            ->with('message', 'Пользователь успешно обновлен!');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('message', 'Пользователь успешно удален!');
    }
}
