<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieEvaluation extends Model
{
    //
    /**
     * Get all of the criteres for the CategorieEvaluation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function criteres()
    {
        return $this->hasMany(Critere::class, 'categorie_id', 'id');
    }
}
