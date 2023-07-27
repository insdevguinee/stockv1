<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outil extends Model
{
    protected $fillable = [
   		'name','description','qte','image','etat','categorie_id',
   	];

   	public function personnels()
   	{
   	    return $this->belongsToMany(Personnel::class, 'personnel_outil', 'outil_id', 'personnel_id')->withPivot('id','selected','created_at');
   	}

   	public function categorie()
   	{
   	    return $this->belongsTo(Categorie::class);
   	}
}
