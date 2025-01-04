<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::orderByDesc('created_at')->with('role')->paginate(5),
        ]);
    }

    public function create()
    {
        $roles = UserRole::pluck('title', 'id');

        return Inertia::render('Users/Create', [
            'roles' => $roles,
            'defaultRoleId' => $roles->search('user'),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'login' => $validated['login'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'desc' => $validated['desc'],
        ]);

        session()->flash('message', 'Пользователь успешно создан!');

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => UserRole::pluck('title', 'id'),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        session()->flash('message', 'Пользователь успешно обновлен!');

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('message', 'Пользователь успешно удален!');

        return redirect()->route('users.index');
    }
}
