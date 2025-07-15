<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiAksesDivisi extends Model
{
    protected $table = 'absensi_akses_divisis'; // pastikan pakai nama tabel pivot

    protected $guarded = [];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'id_proposal', 'id_proposal');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_Divisi', 'id_divisi');
    }
}
