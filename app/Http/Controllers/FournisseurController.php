<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use App\Pays;
use Illuminate\Http\Request;
use Session;
use PDF;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs=Fournisseur::paginate(20);
        return view('fournisseurs.index',['fournisseurs'=>$fournisseurs,'pays'=>Pays::get()]);
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
        $fournisseur = new Fournisseur;
        $fournisseur->name = $request->name;
        $fournisseur->pays_id = $request->pays_id;
        $fournisseur->ville = $request->ville;
        $fournisseur->contact = $request->contact;
        $fournisseur->save();
        Session::flash('success','Fournisseur créé');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        return view('fournisseurs.show',['fournisseur'=>$fournisseur]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        $pays = Pays::get();
        return view('fournisseurs.edit',['fournisseur'=>$fournisseur,'pays'=>$pays]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $fournisseur->update($request->all());
        Session::flash('success','Fournisseur modifié');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        //
        $fournisseur->delete();
        Session::flash('success','Fournisseur supprimé');
        return back();
    }
    public function exportPdf($id,$bonid){
        $fournisseur = Fournisseur::findOrFail($id);
        $pdf = PDF::loadView('exports.pdffournisseur',['fournisseur'=>$fournisseur,'bon'=>$bonid])->setPaper('a4','hardscape');
        return $pdf->download('RECAP FOUNISSEUR '.$fournisseur->name.'.pdf');
    }
}
