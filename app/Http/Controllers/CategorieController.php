<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use Session;
class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::where('parent_id',0)->get();
        return view('materiels.categorie',['categories'=>$categories]);
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
        $categorie = new Categorie;
        $categorie->name = $request['name'];
        $categorie->type = $request['type'];
        $categorie->description = $request['description'];
        $categorie->save();
        Session::flash('success','Vous avez bien ajouté <strong>'.$categorie->name.'</strong> à la liste');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('materiels.edit_cat',['categorie'=>$categorie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->name = $request['name'];
        $categorie->type = $request['type'];
        $categorie->description = $request['description'];
        $categorie->save();
        Session::flash('success','Categorie modifiée');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $categorie = Categorie::findOrFail($id);
        $name = $categorie->name;
        $categorie->delete();
        Session::flash('failed','Vous avez bien supprimé <strong>'.$name.'</strong> de la liste');
         return back();
    }
}
