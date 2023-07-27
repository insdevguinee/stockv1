<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
       'name', 'fichier','description','personnel_id','created_at','updated_at',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
