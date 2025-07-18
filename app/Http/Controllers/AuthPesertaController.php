<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthPesertaController extends Controller
{
    public function pilihProposal()
    {
        $proposals = Proposal::whereHas('kuotaPendaftaran', function ($query) {
            $query->where('status_pendaftaran', 'Buka')
                ->whereColumn('kuota_terpakai', '<', 'total_kuota');
        })->get();

        return view('landing.pilih_proposal', compact('proposals'));
    }
    public function showRegisterForm($id_proposal)
    {
        $proposal = Proposal::findOrFail($id_proposal);
        $kuota = $proposal->kuotaPendaftaran;

        if (!$kuota || $kuota->status_pendaftaran !== 'Buka' || $kuota->kuota_terpakai >= $kuota->total_kuota) {
            return redirect()->back()->with('error', 'Pendaftaran ditutup atau kuota penuh.');
        }

        return view('auth.peserta.register', compact('proposal'));
    }

    public function register(Request $request, $id_proposal)
    {
        $proposal = Proposal::findOrFail($id_proposal);
        $kuota = $proposal->kuotaPendaftaran;

        if (!$kuota || $kuota->status_pendaftaran !== 'Buka' || $kuota->kuota_terpakai >= $kuota->total_kuota) {
            return redirect()->route('peserta.pilihProposal')->with('error', 'Pendaftaran ditutup atau kuota penuh.');
        }

        $request->validate([
            'nim' => 'required|string|unique:pesertas,nim',
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email|unique:pesertas,email',
            'password' => 'required|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
        ]);

        Peserta::create([
            'nim' => $request->nim,
            'id_proposal' => $id_proposal,
            'nama_peserta' => $request->nama_peserta,
            'email' => $request->email,
            'tanggal_pendaftaran' => now(),
            'password' => Hash::make($request->password),
        ]);

        $kuota->increment('kuota_terpakai');

        return redirect()->route('peserta.pilihProposal')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function showLoginForm()
    {
        return view('auth.peserta.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
        ],[
            'nim' => 'NIM harus diisi!',
            'password' => 'Password harus diisi!',
        ]);
        
        $remember = $request->filled('remember');

        if (Auth::guard('peserta')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('peserta.dashboard'));
        }

        Alert::toast('NIM atau Password anda salah!', 'error');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::guard('peserta')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login/peserta');
    }

    public function dashboard()
    {
        $peserta = Auth::guard('peserta')->user();
        return view('peserta.dashboard', compact('peserta'));
    }
}
