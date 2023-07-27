<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entre extends Model
{
    static function entre()
    {
        return \App\Entre::where([['mode','=','entre'],['chantier_id','=',session('chantier')]]);
    }

    static function sortie()
    {
        return \App\Entre::where([['mode','=','sortie'],['chantier_id','=',session('chantier')]]);
    }

	protected $fillable = [
       'mode', 'materiel_id','nfacture','updated_at','date_ajout','fournisseur_id','pu','chantier_id','motif','user_id','transfert_id',
    ];

    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }

    public function myentre()
    {
        return $this->where([['mode','=','entre'],['chantier_id','=',session('chantier')]]);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chantier()
      {
          return $this->belongsTo(Chantier::class);
      }

}
