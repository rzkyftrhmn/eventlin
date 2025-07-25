<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends  Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $guarded = [];
    protected $primaryKey = 'id_admin';
    protected $table = 'admins';

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
