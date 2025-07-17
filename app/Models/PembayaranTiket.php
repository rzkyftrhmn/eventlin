<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranTiket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'nim', 'nim');
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'id_proposal', 'id_proposal');
    }
}
