<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::orderByDesc('created_at')->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|unique:users,login',
            'password' => 'required|min:6',
            'role' => 'required',
            'desc' => 'nullable',
        ]);

        User::create([
            'login' => $validated['login'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'desc' => $validated['desc'],
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'login' => 'required|unique:users,login,' . $user->id,
            'role' => 'required',
            'desc' => 'nullable',
        ]);

        $user->update($validated);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
