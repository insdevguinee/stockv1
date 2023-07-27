<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;
use Session;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nom','prenom','phone','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function bons()
    {
        return $this->hasMany(Bon::class)->where('chantier_id',session('chantier'));
    }

    public function chantiers()
    {
        return $this->belongsToMany(Chantier::class, 'user_chantier', 'user_id', 'chantier_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'user_notification', 'user_id', 'notification_id')->withPivot('show');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
