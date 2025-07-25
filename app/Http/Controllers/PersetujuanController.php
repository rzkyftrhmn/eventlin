<?php

namespace App\Http\Controllers;

use App\Models\Persetujuan;
use App\Models\Proposal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PersetujuanController extends Controller
{
   
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $proposals = Proposal::where('status_proposal', 'Diajukan')
                ->where(function ($query) use ($search) {
                    $query->where('nama_acara', 'like', "%{$search}%")
                          ->orWhere('judul_proposal', 'like', "%{$search}%");
                })
                ->paginate(5);
        } else {
            $proposals = Proposal::where('status_proposal', 'Diajukan')->paginate(5);
        }

        return view('persetujuans.index', compact('proposals', 'search'));
    }



    public function edit($id_proposal)
    {
        $proposal = Proposal::where('id_proposal', $id_proposal)->firstOrFail();
        return view('persetujuans.edit', compact('proposal'));
    }

    public function update(Request $request, $id_proposal)
    {
        $proposal = Proposal::where('id_proposal', $id_proposal)->firstOrFail();
        $request->validate([
            'status_proposal' => 'required|in:Disetujui,Ditolak',
        ]);

        $proposal->status_proposal = $request->status_proposal;
        $proposal->save();
        $userName=auth()->user()->nama_panitia;
        if ($request->status_proposal == 'Disetujui') {
            // Cek apakah sudah ada persetujuan sebelumnya
            if (!$proposal->persetujuan) {
                Persetujuan::create([
                    'id_proposal' => $proposal->id_proposal,
                    'pihak_penyetuju' => $userName,
                    'status_persetujuan' => null,
                    'tanggal_persetujuan' => now(),
                ]);
            }
        }
        Alert::alert('Sukses', 'Data Berhasil Diupdate!', 'success');
        return redirect()->route('persetujuans.indexAkademik')->with('success', 'Status proposal berhasil diperbarui.');
    }

    public function editStatus($id)
    {
        $persetujuan = Persetujuan::with('proposal')->where('id_persetujuan', $id)->firstOrFail();
        return view('persetujuans.edit_status', compact('persetujuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        
        $persetujuan = Persetujuan::findOrFail($id);

        $request->validate([
            'status_persetujuan' => 'required|in:Disetujui,Ditolak',
        ]);
    
        $persetujuan->status_persetujuan = $request->status_persetujuan;
        $persetujuan->save();
    
       if (auth('admin')->check()) {
            Alert::alert('Sukses', 'Data Berhasil Diupdate!', 'success');
            return redirect()->route('proposals.index')->with('success', 'Panitia berhasil dihapus.');
        } elseif (auth('panitia')->check()) {
            Alert::alert('Sukses', 'Data Berhasil Diupdate!', 'success');
            return redirect()->route('proposal.panitia.show')->with('success', 'Panitia berhasil dihapus.');
        }

    }
   
}
