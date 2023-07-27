<?php

namespace App\Http\Controllers;

use App\Outil;
use Illuminate\Http\Request;
use Session;
use App\Role;
use App\Personnel;
use App\Categorie;

class OutilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::where('type',1)->get();
        return view('outils.index',['outils'=>Outil::all(),'categories'=>$categories]);
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
        $outil = new Outil;
        $outil->name = $request['name'];
        $outil->qte = $request['qte'];
        $outil->description = $request['description'];
        $outil->categorie_id = $request['categorie'];
        $outil->etat = 1;
        $outil->save();

        Session::flash('success','Outil crée');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outil  $outil
     * @return \Illuminate\Http\Response
     */
    public function show(Outil $outil)
    {
        return view('outils.show',['outil'=>$outil]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outil  $outil
     * @return \Illuminate\Http\Response
     */
    public function edit(Outil $outil)
    {
        $categories = Categorie::where('type',1)->get();
        return view('outils.edit',['outil'=>$outil,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outil  $outil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outil $outil)
    {
        $outil->name = $request['name'];
        $outil->qte = $request['qte'];
        $outil->etat = $request['etat'];
        $outil->description = $request['description'];
        $outil->categorie_id = $request['categorie'];
        $outil->save();
        Session::flash('success','Outil modifié');
        return back();
    }

    public function assignation()
    {
        $outils = Outil::all();
        $personnels = Personnel::all();
        return view('outils.assigner',['outils'=>$outils,'personnels'=>$personnels]);
    }

    public function assigner(Request $request)
    {
        $personnel = Personnel::findOrFail($request['personnel']);
        // if($personnel->outils()->get()->contains($request['outil'])){

        $personnel->outils()->attach($request['outil'],[
            'id'=> hexdec(uniqid()),
            'selected'=>1,
        ]);
        Session::flash('success','Outil attribué');
        return back();
    }

    public function remove(Request $request,$id)
    {
        // dd($request);
        $outil = Outil::findOrFail($id);
        $outil->personnels()->wherePivot('id', $request['pivotid'])->update([
            'selected'=>0,
        ]);
        Session::flash('success','Appareil récuperé');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outil  $outil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outil $outil)
    {
        $outil->delete();
        Session::flash('success','Outil supprimé');
        return back();
    }
}
