<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Notification extends Model
{
    protected $fillable = [
    	'text', 'link', 'created_at','updated_at','section_id','read',
    ];

    static function basic_email($bon) {

      $setting = \App\Setting::findOrFail(1);

        Mail::send('emails.bon', ['setting' => $setting,"bon"=>$bon], function ($m) use ($setting,$bon) {
          $m->from('ldamaro98@gmail.com', 'SOCOEXIM');

          $m->to($setting->email)->subject('Bon de commande en attente '.$bon->name);
          $m->cc($setting->email);
      });

    }

    static function note_email($personnel, $fiche) {

      $setting = \App\Setting::findOrFail(1);

        Mail::send('emails.note', ['setting' => $setting,"personnel"=>$personnel,'fiche'=>$fiche], function ($m) use ($setting,$personnel,$fiche) {
          $m->from('ldamaro98@gmail.com', 'SOCOEXIM');
          $m->to($personnel->email)->subject('Evaluation : '.$fiche->name.' '.$fiche->annee);
      });

    }

    static function new(String $text,$bon)
    {
    	$notif = New Notification;
    	$notif->text = $text;
    	$notif->link = route('bons.show',$bon->id);
    	$notif->chantier_id = session('chantier');
    	$notif->save();

        $notif->users()->attach(\App\User::permission('valide_bons')->get('id'));
        Notification::basic_email($bon);
    	return $notif;
    }



    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notification', 'notification_id', 'user_id')->withPivot('show');;
    }
}
