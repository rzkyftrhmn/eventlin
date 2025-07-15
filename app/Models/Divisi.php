<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'id_divisi'; 
    public function detailRundowns()
    {
        return $this->hasMany(DetailRundown::class, 'id_divisi', 'id_divisi');
    }

    public function panitia()
    {
        return $this->hasMany(Panitia::class, 'id_divisi', 'id_divisi');
    }

    public function proposalsWithAbsensi()
    {
        return $this->belongsToMany(Proposal::class, 'absensi_akses_divisis', 'divisi_id', 'proposal_id');
    }
}
