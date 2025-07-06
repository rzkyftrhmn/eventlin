<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRundown extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rundown()
    {
        return $this->belongsTo(Rundown::class, 'id_rundown', 'id_rundown');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }
}
