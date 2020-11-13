<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoArticle extends Model
{
    protected $fillable = [
    	'user_id','caption','name_page','account', 'link'
		];
}
