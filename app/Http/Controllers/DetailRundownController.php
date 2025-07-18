<?php

namespace App\Http\Controllers;

use App\Models\DetailRundown;
use App\Models\Divisi;
use App\Models\Rundown;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DetailRundownController extends Controller
{
    public function create($id_rundown)
    {
        $rundown = Rundown::findOrFail($id_rundown);
        $divisis = Divisi::all();
        return view('detail_rundowns.create', compact('rundown', 'divisis'));
    }
    
    public function store(Request $request, $id_rundown)
    {
        $request->validate([
            'judul_rundown' => 'required|string|max:255',
            'id_divisi' => 'required|exists:divisis,id_divisi',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'detail_kegiatan' => 'required|string',
        ]);

        DetailRundown::create([
            'id_rundown' => $id_rundown,
            'id_divisi' => $request->id_divisi,
            'judul_rundown' => $request->judul_rundown,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'detail_kegiatan' => $request->detail_kegiatan,
        ]);
        Alert::alert('Sukses', 'Data Berhasil Ditambahkan!', 'success');
        return redirect()->route('rundowns.show', $id_rundown)
                         ->with('success', 'Detail rundown berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $detailRundown = DetailRundown::with('divisi')->findOrFail($id);
        $divisis = Divisi::all();
        return view('detail_rundowns.edit', compact('detailRundown','divisis'));
    }

    public function update(Request $request, $id)
    {
        $detailRundown = DetailRundown::findOrFail($id);

        $request->validate([
            'id_divisi' => 'required|exists:divisis,id_divisi',
            'judul_rundown' => 'required|string|max:255',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'detail_kegiatan' => 'required|string'
        ]);

        $detailRundown->update($request->all());
        Alert::alert('Sukses', 'Data Berhasil Diupdate!', 'success');
        return redirect()->route('rundowns.show', $detailRundown->id_rundown)->with('success', 'Detail rundown berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detail = DetailRundown::findOrFail($id);
        $id_rundown = $detail->id_rundown;
        $detail->delete();

        Alert::alert('Sukses', 'Data Berhasil Dihapus!', 'success');
        return redirect()->route('rundowns.show', $id_rundown)->with('success', 'Detail rundown berhasil dihapus.');
    }
}
