<?php

namespace App\Http\Controllers;

use App\Models\KuotaPendaftaran;
use App\Models\Proposal;
use Illuminate\Http\Request;

class KuotaPendaftaranController extends Controller
{
    public function index()
    {
        $kuotas = KuotaPendaftaran::with('proposal')->get();
        return view('kuota.index', compact('kuotas'));
    }


   public function edit($id)
    {
        $kuota = KuotaPendaftaran::findOrFail($id);
        return view('kuota.edit', compact('kuota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'total_kuota' => 'required|integer|min:1',
            'status_pendaftaran' => 'required|in:Buka,Tutup',
        ]);

        $kuota = KuotaPendaftaran::findOrFail($id);
        $kuota->update([
            'total_kuota' => $request->total_kuota,
            'status_pendaftaran' => $request->status_pendaftaran,
        ]);

        return redirect()->route('proposals.show', $kuota->id_proposal)->with('success', 'Kuota berhasil diperbarui.');
    }

}
