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
            'tanggal_kegiatan' => 'required|date|after_or_equal:today',
        ]);

        // Cek tanggal sudah dipakai oleh rundown lain pada proposal yang sama
        $sudahAda = Rundown::where('id_proposal', $request->id_proposal)
            ->where('tanggal_kegiatan', $request->tanggal_kegiatan)
            ->exists();

        if ($sudahAda) {
            return back()->withInput()->withErrors([
                'tanggal_kegiatan' => 'Tanggal ini sudah digunakan untuk rundown pada proposal ini.',
            ]);
        }

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
            'tanggal_kegiatan' => 'required|date|after_or_equal:today',
        ]);

        $rundown = Rundown::findOrFail($id);

        // Cek jika tanggal dipakai oleh rundown lain di proposal yang sama
        $sudahAda = Rundown::where('id_proposal', $rundown->id_proposal)
            ->where('tanggal_kegiatan', $request->tanggal_kegiatan)
            ->where('id_rundown', '!=', $rundown->id_rundown) // hindari dirinya sendiri
            ->exists();

        if ($sudahAda) {
            return back()->withInput()->withErrors([
                'tanggal_kegiatan' => 'Tanggal ini sudah digunakan oleh rundown lain di proposal ini.',
            ]);
        }

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
