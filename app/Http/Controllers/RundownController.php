<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Rundown;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
            'tanggal_kegiatan' => [
                'required',
                'date',
                'after_or_equal:' . Proposal::find($request->id_proposal)?->tanggal_acara ?? today(),
            ],
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
            Alert::alert('Sukses', 'Data Berhasil Ditambahkan!', 'success');
            return redirect()->route('proposals.show', $request->id_proposal)->with('success', 'Rundown berhasil ditambahkan.');
        } elseif (auth('panitia')->check()) {
            return redirect()->route('proposal.superpanitia.show', $request->id_proposal)->with('success', 'Rundown berhasil ditambahkan.');
        }
    }

    public function show(Request $request, string $id)
    {
        $rundown = Rundown::with('proposal')->findOrFail($id);

        $query = $rundown->detailRundowns()->with('divisi');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_rundown', 'like', "%$search%")
                ->orWhere('detail_kegiatan', 'like', "%$search%");
            });
        }

        $detailRundowns = $query->paginate(10)->withQueryString();

        return view('rundowns.show', compact('rundown', 'detailRundowns'));
    }

    public function exportPdf($id)
    {
        $rundown = Rundown::with(['proposal', 'detailRundowns.divisi'])->findOrFail($id);
        $pdf = PDF::loadView('rundowns.pdf', compact('rundown'));
        return $pdf->download('rundown_' . $rundown->judul_rundown . '.pdf');
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
            'tanggal_kegiatan' => [
                'required',
                'date',
                'after_or_equal:' . Proposal::find($request->id_proposal)?->tanggal_acara ?? today(),
            ],
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
            Alert::alert('Sukses', 'Data Berhasil Diupdate!', 'success');
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
            Alert::alert('Sukses', 'Data Berhasil Dihapus!', 'success');
            return redirect()->route('proposals.show', $rundown->id_proposal)->with('success', 'Rundown berhasil ditambahkan.');
        } elseif (auth('panitia')->check()) {
            return redirect()->route('proposal.superpanitia.show', $rundown->id_proposal)->with('success', 'Rundown berhasil ditambahkan.');
        };
    }
}
