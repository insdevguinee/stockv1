<?php

namespace App\Http\Controllers;

use App\Chantier;
use Illuminate\Http\Request;
use Session;

class ChantierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $chantiers = Chantier::where('archive','<>',1)->get();
        $archives = Chantier::where('archive','=',1)->get();
        // dd($chantiers);
        return view('chantiers.chantier',['chantiers'=>$chantiers,'archives'=>$archives]);
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
         $chantiers = new chantier;
        $chantiers->name = $request['name'];
        $chantiers->description = $request['description'];
        $chantiers->save();
        Session::flash('success','Vous avez bien ajouté <strong>'.$chantiers->name.'</strong> à la liste');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function show(chantier $chantier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chantier = Chantier::findOrFail($id);
        if($chantier->archive != 0){
            Session::flash('failed','Impossible de modifier un Chantier archivé');
            return back();
        }

        return view('chantiers.edit',['chantier'=>$chantier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chantier $chantier)
    {

        // dd($request);
        if($request['name'] or $request['description']){
            $chantier->update([
                'name'=>$request->name,
                'description'=>$request->description,
            ]);
            Session::flash('success','Chantier modifié');
            return redirect()->route('chantiers.index');
        }else{
            if($chantier->archive == 0){
                $chantier->update([
                    'archive'=>1,
                ]);
                if($chantier->id == session('chantier')){
                    $request->session()->put('chantier', null);
                }
            }else{
                $chantier->update([
                    'archive'=>0,
                ]);
            }
            Session::flash('success','Chantier archivé');
            return back();
        }
        
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function destroy(chantier $chantier)
    {
        $name = $chantier->name;
        $chantier->delete();
        Session::flash('failed','Vous avez bien supprimé <strong>'.$name.'</strong> de la liste');
         return back();
    }

    public function select(Request $request){
        $request->session()->put('chantier', $request->chantierselect);
        return back();
    }
}
