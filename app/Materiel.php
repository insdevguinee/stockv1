<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorie;

class Materiel extends Model
{
   	protected $fillable = [
       'name', 'categorie_id','created_at','updated_at','user_id','unite',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class)->where('type',0);
    }

    public function entres()
    {
        return $this->hasMany(Entre::class, 'materiel_id', 'id');
    }

    public function entreDate($min,$max){
        return $this->entres()->whereBetween('date_ajout', [$min, $max])->orderBy('date_ajout','asc');
    }

    public function entresMois($signe,$mois)
    {
        return $this->entres()->whereMonth('date_ajout',$signe,$mois)->orderBy('date_ajout','asc');
    }

}
