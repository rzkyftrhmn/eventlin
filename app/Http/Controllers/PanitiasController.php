<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Panitia;
use App\Models\Peserta;
use App\Models\Proposal;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PanitiasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterProposal = $request->input('proposal');

        $query = Panitia::with(['proposal', 'divisi']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_panitia', 'like', "%{$search}%")
                ->orWhere('jabatan_panitia', 'like', "%{$search}%");
            });
        }

        if ($filterProposal) {
            $query->where('id_proposal', $filterProposal);
        }

        $panitias = $query->orderBy('created_at', 'desc')->paginate(10); // 👈 Pagination
        $proposals = \App\Models\Proposal::all();

        return view('panitia.index', compact('panitias', 'search', 'filterProposal', 'proposals'));
    }

    public function show($id_panitia)
    {
        $panitia = Panitia::with(['proposal', 'divisi'])->findOrFail($id_panitia);

        // Jika login panitia, hanya boleh akses profil sendiri
        if (auth('panitia')->check() && auth('panitia')->id() != $panitia->id_panitia) {
            abort(403); // akses ditolak
        }

        return view('panitia.show', compact('panitia'));
    }


    public function indexByProposal(Request $request, $id_proposal)
    {
        $proposal = Proposal::with('panitia.divisi')->findOrFail($id_proposal);
        $search = $request->input('search');

        $panitiaQuery = $proposal->panitia();

        if ($search) {
            $panitiaQuery->where(function ($query) use ($search) {
                $query->where('nama_panitia', 'like', "%{$search}%")
                    ->orWhere('jabatan_panitia', 'like', "%{$search}%");
            });
        }

        $panitias = $panitiaQuery->with('divisi')->paginate(10);

        return view('panitia.index_by_proposal', compact('proposal', 'panitias', 'search'));
    }

    
    public function create($id_proposal)
    {
        $proposal = Proposal::findOrFail($id_proposal);
        $divisis = Divisi::all();
        return view('panitia.create', compact('proposal', 'divisis'));
    }
    
    public function store(Request $request, $id_proposal)
    {
            $request->validate([
            'nama_panitia' => 'required|string|max:255',
            'email' => 'required|email|unique:panitia,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',        // Huruf kecil
                'regex:/[A-Z]/',        // Huruf besar
                'regex:/[0-9]/',        // Angka
                'confirmed'             
            ],
            'jabatan_panitia' => 'required|in:Ketua,Sekretaris,Bendahara,Panitia,Akademik',
            'id_divisi' => 'nullable|required_if:jabatan_panitia,Panitia',
        ]);

        // Cek apakah sudah ada jabatan yang sama di proposal ini (kecuali Panitia biasa)
        if (in_array($request->jabatan_panitia, ['Ketua', 'Sekretaris', 'Bendahara'])) {
            $sudahAda = Panitia::where('id_proposal', $id_proposal)
                ->where('jabatan_panitia', $request->jabatan_panitia)
                ->exists();

            if ($sudahAda) {
                return redirect()->back()->withInput()->withErrors([
                    'jabatan_panitia' => 'Sudah ada ' . $request->jabatan_panitia . ' untuk proposal ini.',
                ]);
            }
        }

        if (!Gate::allows('edit-jabatan-panitia')) {
            $request->merge(['jabatan_panitia' => 'Panitia']);
        }


        Panitia::create([
            'id_proposal' => $id_proposal,
            'id_divisi' => $request->jabatan_panitia === 'Panitia' ? $request->id_divisi : null,
            'nama_panitia' => $request->nama_panitia,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jabatan_panitia' => $request->jabatan_panitia,
        ]);

         if (auth('admin')->check()) {
            Alert::alert('Sukses', 'Data Berhasil Ditambahkan!', 'success');
            return redirect()->route('panitia.byProposal', $id_proposal)->with('success', 'Panitia berhasil dihapus.');
        } elseif (auth('panitia')->check()) {
            return redirect()->route('panitia.SuperbyProposal', $id_proposal)->with('success', 'Panitia berhasil dihapus.');
        }
    }
    
    public function edit($id_panitia)
    {
        $panitia = Panitia::findOrFail($id_panitia);
        $divisis = Divisi::all();
        return view('panitia.edit', compact('panitia', 'divisis'));
    }
    
    public function update(Request $request, $id_panitia)
   {
       $panitia = Panitia::findOrFail($id_panitia);

        $request->validate([
            'nama_panitia' => 'required|string|max:255',
            'email' => ['required','email',ValidationRule::unique('panitia', 'email')->ignore($panitia->id_panitia, 'id_panitia')],
            'password' =>[
                'nullable',
                'string',
                'min:8',
                'regex:/[a-z]/',        // Huruf kecil
                'regex:/[A-Z]/',        // Huruf besar
                'regex:/[0-9]/',        // Angka
                'confirmed'
            ],
            'jabatan_panitia' => 'required|in:Ketua,Sekretaris,Bendahara,Panitia,Akademik',
            'id_divisi' => 'nullable|required_if:jabatan_panitia,Panitia',
        ]);

        $data = [
            'nama_panitia' => $request->nama_panitia,
            'email' => $request->email,
            'jabatan_panitia' => $request->jabatan_panitia,
            'id_divisi' => $request->jabatan_panitia === 'Panitia' ? $request->id_divisi : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        if (in_array($request->jabatan_panitia, ['Ketua', 'Sekretaris', 'Bendahara'])) {
            $sudahAda = Panitia::where('id_proposal', $panitia->id_proposal)
                ->where('jabatan_panitia', $request->jabatan_panitia)
                ->where('id_panitia', '!=', $panitia->id_panitia) // Hindari bentrok dengan dirinya sendiri
                ->exists();

            if ($sudahAda) {
                return redirect()->back()->withInput()->withErrors([
                    'jabatan_panitia' => 'Sudah ada ' . $request->jabatan_panitia . ' untuk proposal ini.',
                ]);
            }
        }

        if (!Gate::allows('edit-jabatan-panitia')) {
            $request->merge(['jabatan_panitia' => 'Panitia']);
        }


        $panitia->update($data);

         if (auth('admin')->check()) {
            Alert::alert('Sukses', 'Data Berhasil Diupdate!', 'success');
            return redirect()->route('panitia.byProposal', $panitia->id_proposal)->with('success', 'Panitia berhasil dihapus.');
        } elseif (auth('panitia')->check()) {
            return redirect()->route('panitia.SuperbyProposal', $panitia->id_proposal)->with('success', 'Panitia berhasil dihapus.');
        }
   }
    
    public function destroy($id_panitia)
    {
        $panitia = Panitia::findOrFail($id_panitia);
        $proposalId = $panitia->id_proposal;
        $panitia->delete();

        // Redirect dinamis tergantung siapa yang login
        if (auth('admin')->check()) {
            Alert::alert('Sukses', 'Data Berhasil Dihapus!', 'success');
            return redirect()->route('panitia.byProposal', $proposalId)->with('success', 'Panitia berhasil dihapus.');
        } elseif (auth('panitia')->check()) {
            return redirect()->route('panitia.SuperbyProposal', $proposalId)->with('success', 'Panitia berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Tidak memiliki akses.');
    }
    
}
