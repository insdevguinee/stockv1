<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Personnel extends Authenticatable
{
    protected $fillable = [
    	'matricule', 'nom', 'prenoms', 'numero_equipe', 'created_by', 'created_at','updated_at','deleted_at','etat','email','civilite', 'nationnalite', 'adresse', 'cnps', 'cmu', 'embauche', 'poste', 'salaire', 'st_matri', ' enfant', 'sortie','naissance','lieu_n','cv','contact','contrat_id','departement_id'
    ];

    protected $guard = 'admin';
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function outils()
    {
        return $this->belongsToMany(Outil::class, 'personnel_outil', 'personnel_id', 'outil_id')->withPivot('id');
    }

    public function chantiers()
    {
        return $this->belongsToMany(Chantier::class, 'personnel_chantier', 'personnel_id', 'chantier_id');
    }


    /**
     * Get the departement that owns the Personnel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
