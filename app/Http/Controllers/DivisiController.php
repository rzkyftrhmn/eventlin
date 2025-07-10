<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $divisis = Divisi::paginate(5);
        return view('divisis.index', compact('divisis'));
    }

    public function create()
    {
        return view('divisis.create');
    }

    public function show($id_divisi)
{
    $divisi = Divisi::findOrFail($id_divisi);
    return view('divisis.show', compact('divisi'));
}


    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:255',
            'list_tugas_divisi' => 'nullable|string',
        ]);

        Divisi::create($request->only('nama_divisi','list_tugas_divisi'));
        return redirect()->route('divisis.index')->with('success', 'Divisi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $divisi = Divisi::findOrFail($id);
        return view('divisis.edit', compact('divisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:255',
            'list_tugas_divisi' => 'nullable|string',
        ]);

        $divisi = Divisi::findOrFail($id);
        $divisi->update($request->only('nama_divisi', 'list_tugas_divisi'));
        return redirect()->route('divisis.index')->with('success', 'Divisi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $divisi = Divisi::findOrFail($id);
        $divisi->delete();
        return redirect()->route('divisis.index')->with('success', 'Divisi berhasil dihapus!');
    }
}
