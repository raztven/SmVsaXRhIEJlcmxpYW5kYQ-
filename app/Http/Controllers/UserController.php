<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index()
    {
        $user = User::all();
        return view('admin.user.user', compact('user'));
    }

    function create()
    {
        return view('admin.user.create');
    }

    function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:3',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect('/admin/user');
    }


    function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $request->validate(['password' => 'required|min:3']);
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect('/admin/user')->with('success', 'User updated successfully');
    }

    function destroy($id)
    {
        $user = User::findOrFail($id);
        $name = $user->name;

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('eror', 'tidak bisa menghapus akun sendiri');
        }

        $user->delete();
        return redirect('/admin/user');
    }
}
