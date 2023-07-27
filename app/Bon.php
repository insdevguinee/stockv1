<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Bon extends Model
{
    //
    protected $table="boncommandes";
      
   	protected $fillable = [
   		'name','motif','user_id','date_execution','materiel_id','quantite','etat','numero','valide_by','chantier_id','cout','fournisseur_id','numerobon',
   	];

   	public function user()
   	{
   	    return $this->belongsTo(User::class);
   	}

   		public function materiel()
   	{
   	    return $this->belongsTo(Materiel::class);
   	}

   	public function manager()
   	{
   	    return $this->belongsTo(User::class, 'valide_by', 'id');
   	}

      public function chantier()
      {
          return $this->belongsTo(Chantier::class);
      }

      public function fournisseur()
      {
          return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
      }
}
