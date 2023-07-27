<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
    	'logo', 'email', 'email2', 'created_at','updated_at','notifnumb','api','active','prefix',
    ];
}
