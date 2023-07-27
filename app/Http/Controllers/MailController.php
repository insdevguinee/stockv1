<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\User;

class MailController extends Controller
{
    public	function send()
    {
	    	// $data = array('name'=>"socoexim");
	   

		    // Mail::send(['text'=>'mail'], $data, function($message) {
	     //    	$message->to('achi.a.evrard@gmail.com')->subject
	     //        	('Nouveau bon de commande');
	     //        $message->attach(asset('assets/img/logo.png'));
	     //    	$message->from('info@socoexim.ci','SOCOEXIM');
	     //  	});

    	$user = User::findOrFail(1);

        Mail::send('emails.bon', ['user' => $user], function ($m) use ($user) {
            $m->from('info@socoexim.ci', 'SOCOEXIM');

            $m->to($user->email)->subject('Bon de commande en attente');
        });

      	echo "Basic Email Sent. Check your inbox.";

    }
}
