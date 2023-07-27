<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boncaisse extends Model
{
    //
    public function user()
   	{
   	    return $this->belongsTo(Personnel::class,'user_id','id');
   	}

	public function chantier()
	{
		return $this->belongsTo(Chantier::class);
	}

	function valide() {
			return $this->belongsTo(User::class,'valide_by', 'id');
	}
}
