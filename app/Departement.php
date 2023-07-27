<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    //

    public function personnels() {
        return $this->hasMany(Personnel::class);
    }
}
