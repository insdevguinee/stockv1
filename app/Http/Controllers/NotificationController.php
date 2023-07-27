<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Bon;
use App\Notification;
use Auth;
use App\Setting;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
	public function index(){
		$notifications = Notification::where('chantier_id',session('chantier'))->get();
		return view('notifications.index',['notifications'=>$notifications]);
	}

    public function commande(Request $request){

    	if($request->ajax()){

    		$count[1] = Bon::where([['etat','=','attente'],['chantier_id','=',session('chantier')]])
            ->distinct('numero')
            ->count();
            $count[2] = Bon::where([['etat','=','annuler'],['chantier_id','=',session('chantier')]])
            ->distinct('numero')
            ->count();

    		return response()->json($count);
    	}
    }

    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->read=1;
        $notification->save();
        Auth::user()->notifications()->updateExistingPivot($id,['show'=>0]);
        return Redirect::to($notification->link);
    }

   
}
