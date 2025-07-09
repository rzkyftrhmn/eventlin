<?php

namespace App\Http\Controllers;

use App\Models\DetailRundown;
use App\Models\Rundown;
use Illuminate\Http\Request;

class DetailRundownController extends Controller
{
    public function create($id_rundown)
    {
        $rundown = Rundown::findOrFail($id_rundown);
        return view('detail_rundowns.create', compact('rundown'));
    }
    
    public function store(Request $request, $id_rundown)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'detail_acara' => 'required',
        ]);

        DetailRundown::create([
            'id_rundown' => $id_rundown,
            'id_divisi' => $request->id_divisi,
            'nama_kegiatan' => $request->nama_kegiatan,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'detail_acara' => $request->detail_acara,
        ]);

        return redirect()->route('rundowns.show', $id_rundown)->with('success', 'Detail rundown berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $detail = DetailRundown::findOrFail($id);
        return view('detail_rundowns.edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'detail_acara' => 'required',
        ]);

        $detail = DetailRundown::findOrFail($id);
        $detail->update($request->all());

        return redirect()->route('rundowns.show', $detail->id_rundown)->with('success', 'Detail rundown berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detail = DetailRundown::findOrFail($id);
        $id_rundown = $detail->id_rundown;
        $detail->delete();

        return redirect()->route('rundowns.show', $id_rundown)->with('success', 'Detail rundown berhasil dihapus.');
    }
}
