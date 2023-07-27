<?php

namespace App\Http\Controllers;

use App\Materiel;
use Illuminate\Http\Request;
use App\Categorie;
use Auth;
use Session;

class MaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::where('type',0)->get();
        $materiels = Materiel::get();
        return view('materiels.table',['types'=>$materiels,'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materiel = new Materiel;
        $materiel->name = $request['name'];
        $materiel->categorie_id = $request['categorie'];
        $materiel->user_id = Auth::id();
        $materiel->unite = $request['unite'];
        $materiel->save();
        Session::flash('success','Vous avez bien ajouté <strong>'.$materiel->name.'</strong> à la liste');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function show(Materiel $materiel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function edit(Materiel $materiel)
    {
        $categories = Categorie::all();
        return view('materiels.edit',['materiel'=>$materiel,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materiel $materiel)
    {
        $materiel->name = $request['name'];
        $materiel->unite = $request['unite'];
        $materiel->categorie_id = $request['categorie'];
        $materiel->save();
        Session::flash('success','Materiel modifié');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiel $materiel)
    {
        $name = $materiel->name;
        $materiel->delete();
        Session::flash('failed','Vous avez bien supprimé <strong>'.$name.'</strong> de la liste');
         return back();
    }
}
