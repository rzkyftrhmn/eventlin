<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPanitia;
use App\Models\Panitia;
use App\Models\Rundown;
use Illuminate\Http\Request;

class AbsensiPanitiaController extends Controller
{
    public function scanForm($id_rundown)
    {
        $rundown = Rundown::with('proposal')->findOrFail($id_rundown);

        return view('absensi.scan', compact('rundown'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'id_rundown' => 'required|exists:rundowns,id_rundown',
        ]);

        $panitia = Panitia::where('email', $request->email)->first();

        if (!$panitia) {
            logger('Email tidak ditemukan: ' . $request->email);
            return back()->with('error', 'Email tidak ditemukan dalam data panitia.');
        }

        $rundown = Rundown::with('proposal')->findOrFail($request->id_rundown);

        // Cek apakah panitia termasuk dalam proposal rundown tersebut
        if ($panitia->id_proposal !== $rundown->id_proposal) {
            return back()->with('error', 'Panitia ini tidak terkait dengan rundown tersebut.');
        }

        // Cek apakah sudah absen untuk rundown ini di hari ini
        $sudahAbsen = AbsensiPanitia::whereDate('created_at', now())
            ->where('id_panitia', $panitia->id_panitia)
            ->where('id_rundown', $rundown->id_rundown)
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Panitia ini sudah absen untuk rundown ini hari ini.');
        }

        AbsensiPanitia::create([
            'id_panitia' => $panitia->id_panitia,
            'id_rundown' => $rundown->id_rundown,
            'status_kehadiran' => 'Hadir',
            'waktu_absen' => now()->format('H:i:s'),
            'keterangan' => null,
        ]);

        return back()->with('success', 'Absensi berhasil dicatat untuk ' . $panitia->nama_panitia);
    }



}
