<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chantier;
use App\Materiel;
use App\Entre;
use Session;
use Auth;

class TransfertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chantiers = Chantier::get();
        $materiels = Materiel::get();
        return view('transferts.transfert',['chantiers'=>$chantiers,'materiels'=>$materiels]);
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
        // dd($request);
        $entres = Entre::where([['materiel_id','=',$request['materiel_id']],['chantier_id','=',$request['chantier1']]])->groupBy('materiel_id')->sum('quantite');
        if($entres < $request['quantite'] ){
            Session::flash('failed','Quantité maximal autorisée '.$entres);
            return back();
        }

        $sortie = new Entre;
        $sortie->mode = 'sortie';
        $sortie->materiel_id = $request['materiel_id'];
        $sortie->date_ajout = $request['date'];
        $sortie->nfacture = $request['nfacture'];
        $sortie->pu = 0;
        $sortie->quantite = - $request['quantite'];
        $sortie->chantier_id = session('chantier');
        $sortie->user_id = Auth::id();
        $sortie->fournisseur_id = 0;
        $sortie->transfert_id = $request['chantier2'];
        $sortie->save();

        $sortie = new Entre;
        $sortie->mode = 'entre';
        $sortie->materiel_id = $request['materiel_id'];
        $sortie->date_ajout = $request['date'];
        $sortie->nfacture = '0000/2021';
        $sortie->pu = 0;
        $sortie->quantite = $request['quantite'];
        $sortie->user_id = Auth::id();
        $sortie->chantier_id = $request['chantier2'];
        $sortie->fournisseur_id =  0;
        $sortie->transfert_id = session('chantier');
        $sortie->save();

        Session::flash('success','Transfert effectué');
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

    public function multiple()
    {
        $chantiers = Chantier::get();
        $materiels = Materiel::get();
        return view('transferts.multiple',['chantiers'=>$chantiers,'materiels'=>$materiels]);
    }

    public function postmultiple(Request $request)
    {
        // dd($request);
         if(is_array($request['materiel'])){

            foreach ($request['materiel'] as $index => $mat) {

                $entres = Entre::where([['materiel_id','=',$mat],['chantier_id','=',$request['chantier1']]])->groupBy('materiel_id')->sum('quantite');

                if($entres < $request['quantite'][$index] ){
                    Session::flash('failed','Quantité maximal autorisée '.$entres.' pour '.Materiel::find($mat)->name);
                }else{

                    $sortie = new Entre;
                    $sortie->mode = 'sortie';
                    $sortie->materiel_id = $mat;
                    $sortie->date_ajout = $request['date'];
                    $sortie->nfacture = $request['nfacture'];
                    $sortie->pu = 0;
                    $sortie->quantite = - $request['quantite'][$index];
                    $sortie->chantier_id = session('chantier');
                    $sortie->user_id = Auth::id();
                    $sortie->fournisseur_id = 0;
                    $sortie->transfert_id = $request['chantier2'];
                    $sortie->save();

                    $sortie = new Entre;
                    $sortie->mode = 'entre';
                    $sortie->materiel_id = $mat;
                    $sortie->date_ajout = $request['date'];
                    $sortie->nfacture = '0000/2021';
                    $sortie->pu = 0;
                    $sortie->quantite = $request['quantite'][$index];
                    $sortie->user_id = Auth::id();
                    $sortie->chantier_id = $request['chantier2'];
                    $sortie->fournisseur_id =  0;
                    $sortie->transfert_id = session('chantier');
                    $sortie->save();
                }

            }
        }
        Session::flash('success','Transfert effectué');
        return back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
