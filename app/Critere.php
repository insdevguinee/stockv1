<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notes as Note;

class Critere extends Model
{

    static function note($id,$p,$c)
    {
        return Note::where([['user_id',$id],['personnel_id',$p],['critere_id',$c]])->first();
    }


}
