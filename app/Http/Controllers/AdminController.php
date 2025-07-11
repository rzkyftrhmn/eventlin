<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule as ValidationRule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(5);
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',        // Huruf kecil
                'regex:/[A-Z]/',        // Huruf besar
                'regex:/[0-9]/',        // Angka
                'confirmed'             // Harus cocok dengan password_confirmation
            ],
        ]);
    
        Admin::create([
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    
        return redirect()->route('admins.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admins.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::where('id_admin', $id)->firstOrFail();
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                ValidationRule::unique('admins', 'email')->ignore($admin->id_admin, 'id_admin'),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ]);
        $admin->nama_admin = $request->nama_admin;
        $admin->email = $request->email;
    
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
    
        $admin->save();
    
        return redirect()->route('admins.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Admin berhasil dihapus.');
    }
}
