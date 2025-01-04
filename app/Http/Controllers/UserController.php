<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|unique:users,login',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:user_roles,id',
            'desc' => 'nullable|string',
        ]);

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

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'login' => 'required|unique:users,login,' . $user->id,
            'role_id' => 'required|exists:user_roles,id',
            'desc' => 'nullable|string',
        ]);

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
