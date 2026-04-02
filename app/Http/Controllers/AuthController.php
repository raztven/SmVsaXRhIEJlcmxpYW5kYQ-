<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            LogAktivitas::record('Login', 'User ' . $user->name . ' berhasil login.');

            if ($user->role === 'admin') {
                return redirect()->intended('/admin');
            } elseif ($user->role === 'petugas') {
                return redirect()->intended('/petugas');
            } elseif ($user->role === 'peminjam') {
                return redirect()->intended('/peminjam');
            } else {
                return redirect()->back()->with('gagal', 'role tidak di temukan');
            }
        }
        return redirect()->back()->with('gagal', 'email atau password salah');
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
