<?php

namespace App\Http\Controllers;

use App\Models\AbsensiAksesDivisi;
use App\Models\AbsensiPanitia;
use App\Models\Panitia;
use App\Models\Rundown;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class AbsensiPanitiaController extends Controller
{

    public function index($id_rundown)
    {
        $rundown = Rundown::with('proposal')->findOrFail($id_rundown);

        $panitias = Panitia::where('id_proposal', $rundown->id_proposal)
            ->with(['absensi' => function ($q) use ($id_rundown) {
                $q->where('id_rundown', $id_rundown);
            }])
            ->paginate(10);

        return view('absensi.index', compact('rundown', 'panitias'));
    }

    public function exportPdf($id_rundown)
    {
        $rundown = Rundown::with('proposal')->findOrFail($id_rundown);

        $panitias = Panitia::where('id_proposal', $rundown->id_proposal)
            ->with(['absensi' => function ($q) use ($id_rundown) {
                $q->where('id_rundown', $id_rundown);
            }])->get();

        $pdf = Pdf::loadView('absensi.pdf', compact('rundown', 'panitias'));
        return $pdf->download('rekap-absensi-' . $rundown->judul_rundown . '.pdf');
    }

    
    public function rekap(Request $request, $id_rundown)
    {
        $rundown = Rundown::findOrFail($id_rundown);
        $user = auth('panitia')->user();

        // Ambil semua id_divisi yang boleh absen untuk proposal ini
        $divisiBolehAbsen = AbsensiAksesDivisi::where('id_proposal', $rundown->id_proposal)
                                ->pluck('id_divisi')
                                ->toArray();

        // Cek apakah user panitia termasuk divisi yang diizinkan
        if ($user->jabatan === 'panitia' && !in_array($user->id_divisi, $divisiBolehAbsen)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $query = Panitia::where('id_proposal', $rundown->id_proposal)
            ->with(['absensi' => function ($q) use ($id_rundown) {
                $q->where('id_rundown', $id_rundown);
            }]);

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->whereHas('absensi', function ($q) use ($request) {
                $q->where('status_kehadiran', $request->status);
            });
        }

        $panitias = $query->paginate(10);

        return view('absensi.rekap', compact('rundown', 'panitias'));
    }

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

        
        Alert::alert('Sukses', 'Absensi Berhasil Dicatat!', 'success');
        return back()->with('success', 'Absensi berhasil dicatat untuk ' . $panitia->nama_panitia);
    }

    

    public function manual(Request $request)
    {
        $request->validate([
            'id_panitia' => 'required|exists:panitia,id_panitia',
            'id_rundown' => 'required|exists:rundowns,id_rundown',
            'status_kehadiran' => 'required|in:Hadir,Tidak Hadir,Izin,Terlambat',
            'keterangan' => 'nullable|string'
        ]);

        $absen = AbsensiPanitia::updateOrCreate(
            [
                'id_panitia' => $request->id_panitia,
                'id_rundown' => $request->id_rundown,
                'waktu_absen' => now()->format('H:i:s'),
            ],
            [
                'status_kehadiran' => $request->status_kehadiran,
                'keterangan' => $request->keterangan,
                'waktu_absen' => now()->format('H:i:s'),
            ]
        );

        return redirect()->back()->with('success', 'Absensi manual berhasil.');
    }



}
