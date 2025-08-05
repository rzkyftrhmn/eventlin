<?php

namespace App\Http\Controllers;

use App\Models\Panitia;
use App\Models\PembayaranTiket;
use App\Models\Peserta;
use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class PembayaranTiketController extends Controller
{
    // Tampilkan daftar pembayaran berdasarkan proposal
    public function index($id_proposal)
    {
        $pembayarans = PembayaranTiket::with('peserta')
            ->where('id_proposal', $id_proposal)
            ->get();

        $proposal = Proposal::findOrFail($id_proposal);

        return view('pembayaran.verifikasi', compact('pembayarans', 'proposal'));
    }


    public function konfirmasi($id)
    {   
        $peserta = Peserta::with('proposal', 'pembayaranTiket')->findOrFail($id);
        // Validasi: hanya peserta itu sendiri yang bisa akses
        if (auth()->guard('peserta')->user()->nim != $peserta->nim) {
            abort(403);
        }

        return view('pembayaran.konfirmasi', compact('peserta'));
    }


    public function uploudForm($id){
        $peserta = Peserta::with('proposal','pembayaranTiket')->findOrFail($id);

        if (auth()->guard('peserta')->id() !=
        $peserta->nim) {
            abort(403);
        }
        
        return view('pembayaran.upload',compact('peserta'));
    }

    // Simpan pembayaran baru dari peserta
    public function store(Request $request, $id_proposal)
    {
        $request->validate([
            'nim' => 'required|exists:pesertas,nim',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        $existing = PembayaranTiket::where('nim', $request->nim)
            ->where('id_proposal', $id_proposal)
            ->first();
        
        if ($existing && $existing->status_pembayaran == 'Diterima') {
            return back()->with('error', 'Pembayaran sudah diverifikasi, tidak dapat diubah.');
        }

        if ($existing && $existing->bukti_pembayaran && file_exists(public_path($existing->bukti_pembayaran))) {
            unlink(public_path($existing->bukti_pembayaran));
        }

        $file = $request->file('bukti_pembayaran');
        $namaFile = 'bukti_' . $request->nim . '_' . date('Ymd_His') . '.' . $file->getClientOriginalExtension();
        $folder = 'uploads_bukti';

        $file->move(public_path($folder), $namaFile);
        $path = $folder . '/' . $namaFile;

        // Simpan bukti pembayaran

        PembayaranTiket::updateOrCreate(
        [
            'nim' => $request->nim,
            'id_proposal' => $id_proposal,
        ],
        [
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'Menunggu',
        ]);

        return redirect()->route('pembayaran.konfirmasi', $request->nim)
            ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi.');
    }

    public function tiket($id)
    {
        $peserta = Peserta::with('proposal')->findOrFail($id);

        if (auth()->guard('peserta')->id() != $peserta->nim) {
            abort(403);
        }

        if (!$peserta->pembayaranTiket || $peserta->pembayaranTiket->status_pembayaran !== 'Diterima') {
            return redirect()->back()->with('error', 'Tiket belum tersedia karena pembayaran belum diverifikasi.');
        }

        return view('pembayaran.tiket', compact('peserta'));
    }

    public function verifikasiPembayaran($id_proposal)
    {
        $panitia = auth('panitia')->user(); // pastikan guard panitia aktif
        $idProposal = $panitia->id_proposal;
        // Validasi bahwa user adalah bendahara di proposal tsb
        $panitia = Panitia::where('id_panitia', $panitia->id_panitia)
            ->where('id_proposal', $id_proposal)
            ->where('jabatan_panitia', 'bendahara')
            ->first();

        if (!$panitia) {
            abort(403, 'Tidak punya akses.');
        }

        // Ambil semua pembayaran di proposal tsb
        $pembayaranTikets = PembayaranTiket::with('peserta')
            ->whereHas('peserta', function($query) use ($id_proposal) {
                $query->where('id_proposal', $id_proposal);
            })->get();

        return view('pembayaran.verifikasi', compact('pembayaranTikets'));
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

        
        Alert::alert('Sukses', 'Status pembayaran berhasil diperbarui!', 'success');
        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function downloadTiket($nim)
    {
        $peserta = Peserta::with(['proposal', 'pembayaranTiket'])->where('nim', $nim)->firstOrFail();

        if (!$peserta->pembayaranTiket || $peserta->pembayaranTiket->status_pembayaran !== 'Diterima') {
            return redirect()->back()->with('error', 'Tiket belum tersedia karena pembayaran belum diverifikasi.');
        }

        $pdf = Pdf::loadView('pembayaran.tiket_pdf', compact('peserta'));
        return $pdf->download('Tiket_'.$peserta->nim.'.pdf');
    }
}
