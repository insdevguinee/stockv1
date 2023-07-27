<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use Session;
use Hash;
use App\Chantier;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::get();
        return view('users.table',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $chantiers = Chantier::get();
        return view('users.create',['roles'=>$roles,'chantiers'=>$chantiers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // $request['created_by']=Auth::user()->id;
        // $request['remember_token'] = str_random(10);
        $request['name'] = env('APP_NAME')."\\".strtolower($request['name']);
        // $request['name'] = strtolower($request['name']);
        $user = User::create($request->except(['role','chantiers']));

        if($request->role <> ''){
            $user->roles()->attach($request->role);
        }

        $user->chantiers()->attach($request->chantiers);
        Session::flash('success',"Vous avez bien créé l'utilisateur ".$user->name );
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if($user->id == Auth::id() OR Auth::user()->can('edit_users')){
            $roles = Role::get();
            $chantiers = Chantier::get();
            return view('users.edit',['user'=>$user,'chantiers'=>$chantiers,'roles'=>$roles]);
        }
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->update($request->except(['role','chantiers']));

        if($request->role <> ''){
            $user->roles()->detach();
            $user->roles()->attach($request->role);
        }

        $user->chantiers()->detach();
        $user->chantiers()->attach($request->chantiers);
        Session::flash('success',"Utilisateur Modifié");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id != 1)
            $user->delete();
        Session::flash('failed',"Vous avez bien supprimé l'entrée de la liste");
        return back();
    }

    public function active($active){
        $user = User::findOrFail($active);
        $user->active = ($user->active == 1) ? 0 : 1;
        $user->save();
        $etat = ($user->active == 1 )?"activé":"desactivé";
        Session::flash('success',"Compte ".$etat);
        return back();
    }

    public function passwordreset(Request $request,$userid){

        $this->validate($request, [
            'newPassword' => 'required|string|min:6|confirmed',
        ]);
        $user = User::findOrFail($userid);

        if(Hash::check($request['newPassword'], $user->password)){
           Session::flash('failed','Mot de passe identique');
        }else{
            $user->password = $request['newPassword'];
            $user->save();
            Session::flash('success','Mot de passe modifié');
        }
        return back();


    }
}
