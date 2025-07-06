<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function detailRundowns()
    {
        return $this->hasMany(DetailRundown::class, 'id_divisi', 'id_divisi');
    }

    public function panitia()
    {
        return $this->hasMany(Panitia::class, 'id_divisi', 'id_divisi');
    }
}
