<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'pesertas';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'id_proposal',
        'nama_peserta',
        'email',
        'password',
        'tanggal_pendaftaran',
    ];

    protected $hidden = ['password'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'id_proposal', 'id_proposal');
    }

    public function pembayaranTiket()
    {
        return $this->hasMany(PembayaranTiket::class, 'nim', 'nim');
    }
}
