<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    
	protected $fillable = [
       'name', 'description','created_at','updated_at','type',
    ];

    public function materiels()
    {
        return $this->hasMany(Materiel::class);
    }
    public function childs()
    {
        return $this->hasMany(Categorie::class, 'parent_id', 'id');
    }
}
