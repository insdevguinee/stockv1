<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    //
    protected $fillable = [
       'name', 'pays_id','ville','contact','created_at','updated_at',
    ];

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'pays_id');
    }

    public function entres()
    {
        return $this->hasMany(Entre::class)->where('chantier_id',session('chantier'));
    }

    public function bons()
    {
        return $this->hasMany(Bon::class)->where('chantier_id',session('chantier'));
    }
}
