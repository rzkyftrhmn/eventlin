<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_proposal';
    protected $guarded = [];

    public function persetujuans()
    {
        return $this->hasOne(Persetujuan::class, 'id_proposal', 'id_proposal');
    }

    public function rundowns()
    {
        return $this->hasMany(Rundown::class, 'id_proposal', 'id_proposal');
    }

    public function kuotaPendaftaran()
    {
        return $this->hasOne(KuotaPendaftaran::class, 'id_proposal', 'id_proposal');
    }

    public function pesertas()
    {
        return $this->hasMany(Peserta::class, 'id_proposal', 'id_proposal');
    }

    public function panitia()
    {
        return $this->hasMany(Panitia::class, 'id_proposal', 'id_proposal');
    }
}
