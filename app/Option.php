<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    static function getMiniStock(){
    	return 10;
    }

    static function months(){
    	$months = [
		1 => 'Janvier', 2 => 'Fevrier', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Aout', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Decembre',
		];

		return $months;
    }
}

