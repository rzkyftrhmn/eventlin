<?php

namespace App\Http\Controllers;

use App\Models\PembayaranTiket;
use App\Models\Peserta;
use App\Models\Proposal;
use Illuminate\Http\Request;

class PembayaranTiketController extends Controller
{
    // Tampilkan daftar pembayaran berdasarkan proposal
    public function index($id_proposal)
    {
        $pembayarans = PembayaranTiket::with('peserta')
            ->where('id_proposal', $id_proposal)
            ->get();

        $proposal = Proposal::findOrFail($id_proposal);

        return view('pembayaran.index', compact('pembayarans', 'proposal'));
    }


    public function uploudForm($id){
        $peserta = Peserta::with('proposal','pembayaran')->findOrFail($id);

        if (auth()->guard('peserta')->id() !=
        $peserta->nim) {
            abort(403);
        }
        
        return view('pembayaran.uploud',compact('peserta'));
    }

    // Simpan pembayaran baru dari peserta
    public function store(Request $request, $id_proposal)
    {
        $request->validate([
            'nim' => 'required|exists:pesertas,nim',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        PembayaranTiket::create([
            'nim' => $request->nim,
            'id_proposal' => $id_proposal,
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'Menunggu',
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi.');
    }

    // Admin update status pembayaran
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:Diterima,Ditolak',
        ]);

        $pembayaran = PembayaranTiket::findOrFail($id);
        $pembayaran->update([
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
