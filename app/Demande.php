<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Demande extends Model
{
      
   	protected $fillable = [
   		'titre','status','message','date_d','date_f'
   	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

}
