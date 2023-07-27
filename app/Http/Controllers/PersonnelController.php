<?php

namespace App\Http\Controllers;

use App\Personnel;
use Illuminate\Http\Request;
use Auth;
use App\Chantier;
use Session;
use App\Departement;
use App\FicheEvaluative;
use App\User;
use App\Role;


class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_paginate = 100;

    public function index()
    {

        if (Auth::user()->hasRole('admin|ADMIN')) {
            $personnels = Personnel::paginate($this->_paginate);
        }else{
            $personnels = Personnel::where('departement_id',@Auth::user()->personnel->departement_id)->paginate($this->_paginate);
        }

        return view('personnels.index',compact('personnels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chantiers = Chantier::all();
        $departements = Departement::all();
        return view('personnels.create',['chantiers'=>$chantiers,'departements'=>$departements]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personnel = new Personnel;
        $personnel->matricule = $request['matricule'];
        $personnel->nom = $request['nom'];
        $personnel->prenoms = $request['prenoms'];
        $personnel->contact = $request['contact'];
        $personnel->numero_equipe = $request['numero_equipe'];
        $personnel->created_by = Auth::user()->id;

        $personnel->civilite = $request['civilite'];
        $personnel->naissance = $request['naissance'];
        $personnel->lieu_n = $request['lieu_n'];
        $personnel->nationnalite = $request['nationnalite'];
        $personnel->adresse = $request['adresse'];
        $personnel->st_matri = $request['st_matri'];
        $personnel->enfant = $request['enfant'];
        $personnel->salaire = $request['salaire'];
        $personnel->departement_id = $request['departement_id'];
        $personnel->poste = $request['poste'];
        $personnel->contrat_id = $request['contrat_type'];
        $personnel->cnps = $request['cnps'];
        $personnel->cmu = $request['cmu'];
        $personnel->embauche = $request['embauche'];
        $personnel->save();

        $personnel->chantiers()->attach($request->chantiers);
        Session::flash('success','Personnel enregistré');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $personnel = Personnel::findOrFail($id);
        $fiches = FicheEvaluative::all();
        return view('personnels.show',['personnel'=>$personnel,'fiches'=>$fiches]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnel $personnel)
    {
        $chantiers = Chantier::all();
        $departements = Departement::all();
        return view('personnels.edit',['personnel'=>$personnel,'chantiers'=>$chantiers,'departements'=>$departements]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $personnel = Personnel::findOrFail($id);

        if($request['numero_equipe']){
            Personnel::where('departement_id',$personnel->departement_id)->update([
                'numero_equipe'=>0,
            ]);
        }

        $personnel->update($request->except(['_token','matricule']));
        if(!$request['numero_equipe']){
            @$personnel->chantiers()->detach();
            @$personnel->chantiers()->attach($request->chantiers);
        }
            
         Session::flash('success','Personnel modifié');
         return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personnel $personnel)
    {
        $personnel->delete();
        Session::flash('success','Personnel supprimé');
        return back();
    }

    public function dashboard()
    {
        $personnel = Auth::user()->personnel;
        $fiches = FicheEvaluative::all();
        return view('personnels.profil.index',['personnel'=>$personnel,'fiches'=>$fiches]);
    }

    public function consulter($id,Request $request)
    {
        $personnel = Personnel::findOrFail($id);
        $fiche = FicheEvaluative::findOrFail($_GET['fiche']);
        return view('personnels.profil.mes_notes',['personnel'=>$personnel,'fiche'=>$fiche]);
    }

    public function usercreate($id)
    {
        $personnel = Personnel::findOrFail($id);
        
        $user = new User;
        $user->name = $personnel->matricule;
        $user->nom = $personnel->nom;
        $user->prenom = $personnel->prenoms;
        $user->email = $personnel->email;
        $user->personnel_id = $personnel->id;
        $user->password = "00000000";
        $user->save();

        $role = Role::where('name','Personnel')->first();
        $user->roles()->attach($role->id);

        return back();
    }

    public function modif()
    {
        $personnel = Auth::user()->personnel;
        return view('personnels.profil.edit',['personnel'=>$personnel]);
    }
}
