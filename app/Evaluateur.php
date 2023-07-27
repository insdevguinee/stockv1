<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluateur extends Model
{
    //
    /**
     * Get the user associated with the Evaluateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
