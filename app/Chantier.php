<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    protected $fillable = [
       'name', 'description','archive','created_at','updated_at',
    ];

    public function personnels()
   	{
   	    return $this->belongsToMany(Personnel::class, 'personnel_chantier', 'chantier_id', 'personnel_id');
   	}

}
