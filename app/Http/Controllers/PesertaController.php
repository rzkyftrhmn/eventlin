<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule as ValidationRule;
use RealRashid\SweetAlert\Facades\Alert;

class PesertaController extends Controller
{
   public function index(Request $request)
    {
        $search = $request->input('search');
        $filterProposal = $request->input('proposal');

        $query = \App\Models\Peserta::with('proposal');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_peserta', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")->paginate(5);
            });
        }

        if ($filterProposal) {
            $query->where('id_proposal', $filterProposal)->paginate(5);
        }

        $pesertas = $query->orderBy('created_at', 'desc')->paginate(5); 
        $proposals = \App\Models\Proposal::all();

        return view('peserta.index', compact('pesertas', 'search', 'filterProposal', 'proposals'));
    }


    public function indexByProposal($id_proposal)
    {
        $proposal = Proposal::with('pesertas')->findOrFail($id_proposal);
        $search = request('search');

        $pesertas = $proposal->pesertas();

            if ($search) {
                $pesertas = $pesertas->where(function ($query) use ($search) {
                    $query->where('nama_peserta', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            }

            $pesertas = $pesertas->paginate(10);

            return view('peserta.index_by_proposal', compact('proposal', 'pesertas', 'search'));
    }

    public function create($id_proposal)
    {
        // dd(Auth::guard('panitia')->user());
        $proposal = Proposal::findOrFail($id_proposal);
        $kuota = $proposal->kuotaPendaftaran;

        if (!$kuota || $kuota->status_pendaftaran !== 'Buka' || $kuota->kuota_terpakai >= $kuota->total_kuota) {
            if (auth('admin')->check()) {
                return redirect()->route('proposals.show', $id_proposal)->with('error', 'Pendaftaran ditutup atau kuota penuh.');
            } elseif (auth('panitia')->check()) {
                return redirect()->route('proposal.superpanitia.show', $id_proposal)->with('error', 'Pendaftaran ditutup atau kuota penuh.');
            }
        }
        

        return view('peserta.create', compact('proposal'));
    }

    public function store(Request $request, $id_proposal)
    {
        $proposal = Proposal::findOrFail($id_proposal);
        $kuota = $proposal->kuotaPendaftaran;

        if (!$kuota || $kuota->status_pendaftaran !== 'Buka' || $kuota->kuota_terpakai >= $kuota->total_kuota) {
            return redirect()->route('proposals.show', $id_proposal)->with('error', 'Pendaftaran ditutup atau kuota penuh.');
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
            'tanggal_pendaftaran' => now()->toDateString(), 
            'password' => Hash::make($request->password),
        ]);

        $kuota->increment('kuota_terpakai');

        if (auth('admin')->check()) {
            Alert::alert('Sukses', 'Data Berhasil Ditambahkan!', 'success');
            return redirect()->route('proposals.show', $id_proposal)->with('success', 'Peserta berhasil ditambahkan.');
        } elseif (auth('panitia')->check()) {
            Alert::alert('Sukses', 'Data Berhasil Ditambahkan!', 'success');
            return redirect()->route('proposal.superpanitia.show', $id_proposal)->with('success', 'Peserta berhasil ditambahkan.');
        }
    }


    public function edit($nim)
    {
          $peserta = Peserta::findOrFail($nim);
        return view('peserta.edit', compact('peserta'));
    }

    public function update(Request $request, $nim)
    {
        $peserta = Peserta::findOrFail($nim);

        $request->validate([
            'nim' => [
                'required',
                'string',
                ValidationRule::unique('pesertas', 'nim')->ignore($peserta->nim, 'nim')
            ],
            'nama_peserta' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                ValidationRule::unique('pesertas', 'email')->ignore($peserta->nim, 'nim')
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
            // tanggal_pendaftaran dihapus dari validasi
        ]);

        $data = [
            'nama_peserta' => $request->nama_peserta,
            'email' => $request->email,
            // 'tanggal_pendaftaran' tidak dimasukkan
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $peserta->update($data);

        Alert::alert('Sukses', 'Data Berhasil Diupdate!', 'success');
        return redirect()->route('peserta.byProposal', $peserta->id_proposal)->with('success', 'Peserta berhasil diperbarui.');
    }

    public function show($nim)
    {
        $peserta = Peserta::with('proposal')->findOrFail($nim);

        // Jika peserta login, hanya bisa lihat profil sendiri
        if (auth('peserta')->check() && auth('peserta')->id() != $peserta->nim) {
            abort(403, 'Akses ditolak.');
        }

        return view('peserta.show', compact('peserta'));
    }

    public function destroy($nim)
    {
        $peserta = Peserta::findOrFail($nim);
        $idProposal = $peserta->id_proposal;
        Peserta::where('nim', $nim)->delete();
        return redirect()->route('peserta.byProposal')->with('success', 'Peserta berhasil dihapus.');
    }
    
}
