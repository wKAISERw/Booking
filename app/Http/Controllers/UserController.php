<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Отримуємо всіх користувачів, крім себе (щоб випадково не зняти з себе адмінку)
        $users = User::where('id', '!=', auth()->id())->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "Role for {$user->name} updated to {$user->role}!");
    }
}
