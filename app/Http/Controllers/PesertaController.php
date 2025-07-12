<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
     public function index()
    {
        $pesertas = Peserta::all();
        return view('peserta.index', compact('pesertas'));
    }

    public function create()
    {
        $proposals = Proposal::all();
        return view('peserta.create', compact('proposals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|unique:pesertas,nim',
            'id_proposal' => 'required|exists:proposals,id_proposal',
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email|unique:pesertas,email',
            'password' => 'required|string|confirmed|min:6',
            'status_pendaftaran' => 'required|in:Diterima,Ditolak',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        Peserta::create([
            'nim' => $request->nim,
            'id_proposal' => $request->id_proposal,
            'nama_peserta' => $request->nama_peserta,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_pendaftaran' => $request->status_pendaftaran,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function edit($nim)
    {
        $peserta = Peserta::findOrFail($nim);
        $proposals = Proposal::all();
        return view('peserta.edit', compact('peserta', 'proposals'));
    }

    public function update(Request $request, $nim)
    {
        $peserta = Peserta::findOrFail($nim);

        $request->validate([
            'id_proposal' => 'required|exists:proposals,id_proposal',
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email|unique:pesertas,email,' . $peserta->nim . ',nim',
            'password' => 'nullable|string|confirmed|min:6',
            'status_pendaftaran' => 'required|in:Diterima,Ditolak',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        $data = $request->only([
            'id_proposal', 'nama_peserta', 'email', 'status_pendaftaran', 'tanggal_pendaftaran'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $peserta->update($data);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil diperbarui.');
    }

    public function destroy($nim)
    {
        Peserta::destroy($nim);
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
