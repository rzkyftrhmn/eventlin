<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiPanitia extends Model
{
    use HasFactory;

    protected $guarded = [];
     protected $table = 'absensi_panitia';
     
    public function panitia()
    {
        return $this->belongsTo(Panitia::class, 'id_panitia', 'id_panitia');
    }
}
