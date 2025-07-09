<?php

namespace Database\Seeders;

use App\Models\Proposal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Proposal::create([
                'nama_acara' => 'Acara Ke-' . $i,
                'jenis_acara' => 'Seminar',
                'nama_pengusul' => 'Pengusul ' . $i,
                'judul_proposal' => 'Proposal Acara ' . $i,
                'file_proposal' => 'proposals/file' . $i . '.pdf',
                'tanggal_pengajuan' => now(),
                'status_proposal' => 'Diajukan',
                'estimasi_peserta' => rand(50, 200),
                'kebutuhan_logistik' => 'Sound System, Kursi, Meja',
                'tanggal_acara' => now()->addDays($i),
                'waktu_acara' => '08:00',
                'detail_acara' => 'Detail acara ke-' . $i,
            ]);
    }
        }
}
