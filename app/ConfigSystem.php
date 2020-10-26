<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigSystem extends Model
{
    protected $fillable = [
        'token', 'app_id', 'app_secret','id_user'
    ];
}
