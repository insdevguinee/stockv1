<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FicheEvaluative extends Model
{
    //
    /**
     * Get all of the evaluateurs for the FicheEvaluative
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluateurs()
    {
        return $this->hasMany(Evaluateur::class, 'fiche_id', 'id');
    }

    /**
     * Get all of the categories for the FicheEvaluative
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(CategorieEvaluation::class, 'fiche_id', 'id');
    }
}
