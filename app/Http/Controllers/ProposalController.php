<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status_filter');

        if ($search) {
            $proposals = Proposal::where('nama_acara', 'like', "%{$search}%")
                                 ->orWhere('judul_proposal', 'like', "%{$search}%")
                                 ->paginate(5);

        } elseif ($status) {
            $proposals = Proposal::where('status_proposal', $status)
                                 ->paginate(5); 
        } else {
            $proposals = Proposal::paginate(5); 
        }

        return view('proposals.index', compact('proposals', 'search'));
    }

    public function create()
    {
        return view('proposals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_acara' => 'required',
            'jenis_acara' => 'required',
            'nama_pengusul' => 'required',
            'judul_proposal' => 'required',
            'file_proposal' => 'required|mimes:pdf,doc,docx|max:2048',
            'tanggal_pengajuan' => 'required|date',
            'estimasi_peserta' => 'required|integer',
            'kebutuhan_logistik' => 'required',
            'tanggal_acara' => 'required|date',
            'waktu_acara' => 'required',
            'detail_acara' => 'required',
        ]);

        $proposal = new Proposal($request->except('file_proposal'));
        $proposal->status_proposal = 'Diajukan'; 
        $proposal->file_proposal = null; 

        if ($request->hasFile('file_proposal')) {
            $file = $request->file('file_proposal');
            $namaAcara = str_replace(' ', '_', $request->nama_acara);
            $tanggalPengajuan = date('Ymd', strtotime($request->tanggal_pengajuan));
            $fileName = $namaAcara . '_' . $tanggalPengajuan . '.' . $file->getClientOriginalExtension();

            // Simpan file ke public/uploads
            $file->move(public_path('uploads'), $fileName);

            // Simpan path file
            $proposal->file_proposal = 'uploads/' . $fileName;
        }
        
        $proposal->save();
        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil disimpan!');
    }

    public function show($id)
    {
        $proposal = Proposal::with(['persetujuans','rundowns','panitia.divisi'])->findOrFail($id);
        return view('proposals.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
        return view('proposals.edit', compact('proposal'));
    }

    public function update(Request $request, string $id)
    {
       $proposal = Proposal::findOrFail($id);

        $request->validate([
            'nama_acara' => 'required|string|max:255',
            'jenis_acara' => 'required|string|max:255',
            'nama_pengusul' => 'required|string|max:255',
            'judul_proposal' => 'required|string|max:255',
            'file_proposal' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'tanggal_pengajuan' => 'required|date',
            'status_proposal' => 'required|in:Diajukan,Disetujui,Ditolak',
            'estimasi_peserta' => 'required|integer',
            'kebutuhan_logistik' => 'required|string',
            'tanggal_acara' => 'required|date',
            'waktu_acara' => 'required',
            'detail_acara' => 'required|string',
        ]);

        $proposal->fill($request->except('file_proposal'));

        if ($request->hasFile('file_proposal')) {
            // Hapus file lama
            if ($proposal->file_proposal && file_exists(public_path($proposal->file_proposal))) {
                unlink(public_path($proposal->file_proposal));
            }

            $file = $request->file('file_proposal');
            $namaAcara = str_replace(' ', '_', $request->nama_acara);
            $tanggalPengajuan = date('Ymd', strtotime($request->tanggal_pengajuan));
            $fileName = $namaAcara . '_' . $tanggalPengajuan . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $fileName);

            $proposal->file_proposal = 'uploads/' . $fileName;
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil diperbarui.');
    }

    public function destroy(Proposal $proposal)
    {
        if ($proposal->file_proposal && file_exists(public_path($proposal->file_proposal))) {
            unlink(public_path($proposal->file_proposal));
        }
        
        $proposal->delete();
        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dihapus.');
    }

    public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $proposals = Proposal::where('nama_acara', 'like', "%$keyword%")
        ->orWhere('judul_proposal', 'like', "%$keyword%")
        ->paginate(5)
        ->appends(['keyword' => $keyword]);

    return view('proposals.index', compact('proposals'));
}

}
