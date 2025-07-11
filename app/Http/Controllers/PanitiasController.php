<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Panitia;
use App\Models\Proposal;
use Illuminate\Http\Request;

class PanitiasController extends Controller
{
    public function index($id_proposal)
    {
        $proposal = Proposal::with('panitia.divisi')->findOrFail($id_proposal);
        return view('panitia.index', compact('proposal'));
    }
    
    public function create($id_proposal)
    {
        $proposal = Proposal::findOrFail($id_proposal);
        $divisis = Divisi::all();
        return view('panitia.create', compact('proposal', 'divisis'));
    }
    
    public function store(Request $request, $id_proposal)
    {
        $request->validate([
            'nama_panitia' => 'required|string|max:255',
            'jabatan_panitia' => 'required|in:Ketua,Sekretaris,Bendahara,Panitia',
            'id_divisi' => 'nullable|required_if:jabatan_panitia,Panitia',
        ]);
    
        Panitia::create([
            'id_proposal' => $id_proposal,
            'id_divisi' => $request->jabatan_panitia === 'Panitia' ? $request->id_divisi : null,
            'nama_panitia' => $request->nama_panitia,
            'jabatan_panitia' => $request->jabatan_panitia,
        ]);
    
        return redirect()->route('panitia.index', $id_proposal)->with('success', 'Panitia berhasil ditambahkan.');
    }
    
    public function edit($id_panitia)
    {
        $panitia = Panitia::findOrFail($id_panitia);
        $divisis = Divisi::all();
        return view('panitia.edit', compact('panitia', 'divisis'));
    }
    
    public function update(Request $request, $id_panitia)
    {
        $panitia = Panitia::findOrFail($id_panitia);
    
        $request->validate([
            'nama_panitia' => 'required|string|max:255',
            'jabatan_panitia' => 'required|in:Ketua,Sekretaris,Bendahara,Panitia',
            'id_divisi' => 'nullable|required_if:jabatan_panitia,Panitia',
        ]);
    
        $panitia->update([
            'nama_panitia' => $request->nama_panitia,
            'jabatan_panitia' => $request->jabatan_panitia,
            'id_divisi' => $request->jabatan_panitia === 'Panitia' ? $request->id_divisi : null,
        ]);
    
        return redirect()->route('panitia.index', $panitia->id_proposal)->with('success', 'Data panitia berhasil diperbarui.');
    }
    
    public function destroy($id_panitia)
    {
        $panitia = Panitia::findOrFail($id_panitia);
        $proposalId = $panitia->id_proposal;
        $panitia->delete();
    
        return redirect()->route('panitia.index', $proposalId)->with('success', 'Panitia berhasil dihapus.');
    }
    
}
