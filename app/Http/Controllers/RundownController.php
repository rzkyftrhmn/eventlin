<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Rundown;
use Illuminate\Http\Request;

class RundownController extends Controller
{
    public function index()
    {
   
    }

    public function createRundown($id_proposal)
    {
        $proposal = Proposal::findOrFail($id_proposal);
        return view('rundowns.create', compact('proposal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proposal' => 'required|exists:proposals,id_proposal',
            'judul_rundown' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
        ]);
    
        Rundown::create($request->all());
    
        if (auth('admin')->check()) {
            return redirect()->route('proposals.show', $request->id_proposal)->with('success', 'Rundown berhasil ditambahkan.');
        } elseif (auth('panitia')->check()) {
            return redirect()->route('proposal.superpanitia.show', $request->id_proposal)->with('success', 'Rundown berhasil ditambahkan.');
        }


    }

    public function show(string $id)
    {
        $rundown = Rundown::with(['proposal', 'detailRundowns.divisi'])->findOrFail($id);
        return view('rundowns.show', compact('rundown'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rundown = Rundown::findOrFail($id);
        return view('rundowns.edit', compact('rundown'));
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul_rundown' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
        ]);
    
        $rundown = Rundown::findOrFail($id);
        $rundown->update([
            'judul_rundown' => $request->judul_rundown,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
        ]);
    
        if (auth('admin')->check()) {
            return redirect()->route('proposals.show', $rundown->id_proposal)->with('success', 'Rundown berhasil diperbarui.');
        } elseif (auth('panitia')->check()) {
            return redirect()->route('proposal.superpanitia.show', $rundown->id_proposal)->with('success', 'Rundown berhasil diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rundown = Rundown::findOrFail($id);
        $rundown->delete();
    
        if (auth('admin')->check()) {
            return redirect()->route('proposals.show', $rundown->id_proposal)->with('success', 'Rundown berhasil ditambahkan.');
        } elseif (auth('panitia')->check()) {
            return redirect()->route('proposal.superpanitia.show', $rundown->id_proposal)->with('success', 'Rundown berhasil ditambahkan.');
        };
    }
}
