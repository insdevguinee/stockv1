<?php

namespace App\Http\Controllers;

use App\Entre;
use App\Fournisseur;
use Illuminate\Http\Request;
use App\Chantier;
use App\Materiel;
use Session;
use Carbon\Carbon;
use Excel;
use App\Exports\entreExport;
use Auth;

class EntreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $min = (@$_GET['datedebut']) ? @$_GET['datedebut'] : Carbon::now()->subDays(30);
        $max = (@$_GET['datefin']) ? @$_GET['datefin'] : Carbon::now()->addDays(2) ;
        $entres = Entre::entre()->whereBetween('date_ajout', [$min, $max])->orderBy('date_ajout','asc')->get();
        $types = Materiel::get();
        $fournisseurs = Fournisseur::get();
        return view('stocks.entre',['entres'=>$entres,'types'=>$types,'fournisseurs'=>$fournisseurs]);
    }

     public function multiple(){
        $fournisseurs = Fournisseur::all();
        $materiels = Materiel::all();
        return view('stocks.entre.multiple',['fournisseurs'=>$fournisseurs,'materiels'=>$materiels]);
    }

     public function entre2(Request $request)
    {
        $min = (@$_GET['datedebut']) ? @$_GET['datedebut'] : Carbon::now()->subDays(30);
        $max = (@$_GET['datefin']) ? @$_GET['datefin'] : Carbon::now()->addDays(2) ;
        $entres = Entre::entre()->whereBetween('date_ajout', [$min, $max])->orderBy('date_ajout','asc')->get();
        $types = Materiel::get();
        $fournisseurs = Fournisseur::get();
        return view('stocks.entre2',['entres'=>$entres,'types'=>$types,'fournisseurs'=>$fournisseurs]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiels = Materiel::get();
        return view('stocks.entre.create',['types'=>$materiels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_array($request['materiel'])){

            foreach($request['materiel'] as $index => $mat){
                $sortie = new Entre;
                $sortie->mode = 'entre';
                $sortie->materiel_id = $mat;
                $sortie->date_ajout = $request['date'];
                $sortie->nfacture = $request['numerobon'];
                $sortie->motif = $request['motif'];
                $sortie->pu = 0;
                $sortie->quantite = $request['quantite'][$index];
                $sortie->chantier_id = session('chantier');
                $sortie->fournisseur_id = $request['fourni'];
                $sortie->user_id = Auth::id();
                $sortie->save();
            }
        }else{
            $entre = new Entre;
            $entre->mode = 'entre';
            $entre->materiel_id = $request['materiel_id'];
            $entre->date_ajout = $request['date'];
            $entre->nfacture = $request['nfacture'];
            $entre->pu = 0;
            $entre->quantite = $request['quantite'];
            $entre->chantier_id = session('chantier');
            $entre->fournisseur_id = $request['fourni'];
            $entre->motif = $request['description'];
            $entre->user_id = Auth::id();
            $entre->save();
        }
        Session::flash('success','Vous avez bien ajouté  une entrée à la liste');
        return redirect()->route('entres.index');
    }


    public function traiter(Request $request)
    {
        foreach($request['materiel'] as $index => $mat){
            if($mat != Null){
                //  $bon->name = $request['name'];
                // $bon->numerobon = $request['numerobon'];
                // $bon->materiel_id = $mat;
                // $bon->date_execution = $request['date'];
                // $bon->quantite = $request['quantite'][$index];
                // $bon->cout = ($request['cout'][$index]) ? $request['cout'][$index] : 0 ;
                // $bon->user_id = Auth::id();
                // $bon->chantier_id = session('chantier');
                // $bon->fournisseur_id = $request->fournisseur;
                // $bon->numero = $numero;
                // $bon->save();


                $entre = new Entre;
                $entre->mode = 'entre';
                $entre->materiel_id =  $mat;
                $entre->date_ajout = $request['date'];
                $entre->nfacture = $request['numerobon'];
                $entre->pu = ($request['cout'][$index]) ? $request['cout'][$index] : 0 ;
                $entre->quantite = $request['quantite'][$index];
                $entre->chantier_id = session('chantier');
                $entre->fournisseur_id = $request->fournisseur;
                $entre->motif = $request['description'];
                $entre->user_id = Auth::id();
                $entre->save();

            }
        }
        Session::flash('success','Bon de commande traité');
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Entre  $entre
     * @return \Illuminate\Http\Response
     */
    public function show(Entre $entre)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entre  $entre
     * @return \Illuminate\Http\Response
     */
    public function edit(Entre $entre)
    {
        $materiels = Materiel::get();
        $fournisseurs = Fournisseur::get();
        return view('stocks.entre.edit',['entre'=>$entre,'types'=>$materiels,'fournisseurs'=>$fournisseurs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entre  $entre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entre $entre)
    {
        // $entre->mode = 'entre';
        $entre->materiel_id = $request['materiel_id'];
        $entre->date_ajout = $request['date'];
        $entre->nfacture = $request['nfacture'];
        $entre->pu = 0;
        $entre->quantite = $request['quantite'];
        $entre->fournisseur_id = $request['fournisseur_id'];
        $entre->save();
        Session::flash('success','Vous avez modifé une entrée');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entre  $entre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entre $entre)
    {
        $entre->delete();
        Session::flash('failed',"Vous avez bien supprimé l'entrée de la liste");
        return back();
    }

    public function export(){
        $min = (@$_GET['datedebut']) ? @$_GET['datedebut'] : Carbon::now()->subDays(7);
        $max = (@$_GET['datefin']) ? @$_GET['datefin'] : Carbon::now() ;
        return Excel::download(new entreExport($min,$max), Chantier::findOrFail(session('chantier'))->name.' approvisionnement du '.$min.' au '.$max.'.xlsx');
    }
}
