<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthPanitiaController extends Controller
{
     public function showLoginForm()
    {
        return view('auth.panitia.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->filled('remember');

        if (Auth::guard('panitia')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('panitia.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('panitia')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login/panitia');
    }

    public function dashboard()
    {
        $nama = auth()->guard('panitia')->user()->nama_panitia;

        return '
            <h2>Halo Panitia ' . $nama . '</h2>
            <form action="' . route('panitia.logout') . '" method="POST" style="margin-top: 20px;">
                ' . csrf_field() . '
                <button type="submit">Logout</button>
            </form>
        ';
    }
}
