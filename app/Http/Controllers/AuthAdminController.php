<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Proposal;
use App\Models\Peserta;
use App\Models\Panitia;
use App\Models\Divisi;
use App\Models\Admin;
use RealRashid\SweetAlert\Facades\Alert;

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
        ],[
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email harus benar!',
            'password.required' => 'Password harus diisi!',
        ]);

        
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        Alert::toast('Email atau Password anda salah!', 'error');
        return back();
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
        // Alert::alert('Register berhasil', 'Silakan Login Sekarang!', 'success');
        return view('auth.admin.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
        ],[
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $admin = Admin::create([
            'nama_admin' => $data['nama_admin'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Auth::guard('admin')->login($admin);

        // Alert::alert('Register berhasil', 'Silakan Login Sekarang!', 'success');
        return redirect()->route('admin.loginForm');
    }

    public function dashboard()
    {
        $user = auth('admin')->user();
        
        $totalProposal = Proposal::count();
        $totalPeserta = Peserta::count();
        $totalPanitia = Panitia::count();
        $totalDivisi = Divisi::count();
        $totalAdmin = Admin::count();
        return view('auth.admin.dashboard', compact(
            'user',
            'totalProposal',
            'totalPeserta',
            'totalPanitia',
            'totalDivisi',
            'totalAdmin'
        ));
    }

}
