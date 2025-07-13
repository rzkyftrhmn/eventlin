<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.loginForm');
    }

    public function showRegisterForm()
    {
        return view('auth.admin.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'nama_admin' => $data['nama_admin'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        return "<h2>Halo Admin " . auth('admin')->user()->nama_admin . "</h2>
        <form method='POST' action='" . route('admin.logout') . "'>" . csrf_field() . "
            <button type='submit'>Logout</button>
        </form>";
    }
}
