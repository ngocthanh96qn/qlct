<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigSystem extends Model
{
    protected $fillable = [
        'user_id','name_FB','token', 'app_id', 'app_secret','id_userFB'
    ];
}
