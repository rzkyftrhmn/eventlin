<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'panitia';
    protected $primaryKey = 'id_panitia';
    
    protected $hidden = [
        'password',
    ];
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'id_proposal', 'id_proposal');
    }

    public function absensi()
    {
        return $this->hasMany(AbsensiPanitia::class, 'id_panitia', 'id_panitia');
    }
}
