<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuotaPendaftaran extends Model
{
    protected $primaryKey = 'id_proposal';
    protected $guarded = [];
    public $incrementing = false;

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'id_proposal', 'id_proposal');
    }
}
