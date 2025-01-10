<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
{
    $this->middleware(['auth', 'is.admin']);
}
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    notify()->success('User created successfully');
    return redirect()->route('users.index');
}

public function update(Request $request, User $user)
{
    if ($user->name != 'Admin') {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        notify()->success('User updated successfully');
        return redirect()->route('users.index');
    }
}

public function destroy(User $user)
{
    if ($user->name != 'Admin') {
        $user->delete();
        notify()->success('User deleted successfully');
        return redirect()->route('users.index');
    }
}
}
