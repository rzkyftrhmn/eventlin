<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiAksesDivisiController extends Controller
{
    public function store(Request $request, $id_proposal)
    {
        $proposal = Proposal::findOrFail($id_proposal);

        $validated = $request->validate([
            'divisi_id' => 'nullable|array',
            'divisi_id.*' => 'exists:divisis,id_divisi'
        ]);

        // Sync: hapus semua divisi lama dan ganti dengan yang baru
        $proposal->divisiAbsensi()->sync($validated['divisi_id'] ?? []);
        Alert::alert('Sukses', 'Divisi absensi berhasil diperbaharui!', 'success');
        return back()->with('success', 'Divisi absensi berhasil diperbarui.');
    }

}