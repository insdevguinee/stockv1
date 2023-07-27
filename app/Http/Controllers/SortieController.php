<?php

namespace App\Http\Controllers;

use App\Entre;
use Illuminate\Http\Request;
use App\Materiel;
use Session;
use Carbon\Carbon;
use Excel;
use App\Exports\sortieExport;
use App\Chantier;
use App\Notification;
use Auth;
use App\Fournisseur;
use PDF;

class SortieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $min = (@$_GET['datedebut']) ? @$_GET['datedebut'] :  Carbon::parse(date('Y-m-d'))->subDays(30) ;
        $max = (@$_GET['datefin']) ?  @$_GET['datefin'] : Carbon::now();
        $entres = Entre::sortie()->whereBetween('date_ajout', [$min, $max])->get();
        $types = Materiel::get();
        return view('stocks.sortie',['entres'=>$entres,'types'=>$types]);
    }

    public function multiple(){
        $fournisseurs = Fournisseur::all();
        $materiels = Materiel::all();
        return view('stocks.sortie.multiple',['fournisseurs'=>$fournisseurs,'materiels'=>$materiels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	// $mats[] = [];
        $materiels = Materiel::get();
        foreach($materiels as $mat){
        	if($mat->entres->where( 'chantier_id',session('chantier') )->sum('quantite') > 0){
        		$mats[]=$mat;
        	}
        }
        if(!isset($mats)){
        		$mats = Null;
        }
        return view('stocks.sortie.create');
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

        if(is_array($request['materiel'])){

           foreach($request['materiel'] as $index => $mat){

                 $entres = Entre::where([['materiel_id','=',$mat],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite');

                if($entres < $request['quantite'][$index] ){
                    Session::flash('failed',Materiel::findOrFail($mat)->name.' quantité maximal autorisée '.$entres);
                }else{

                    $sortie = new Entre;
                    $sortie->mode = 'sortie';
                    $sortie->materiel_id = $mat;
                    $sortie->date_ajout = $request['date'];
                    $sortie->nfacture = sprintf("%04d",$request['numerobon']);
                    $sortie->motif = $request['motif'];
                    $sortie->pu = 0;
                    $sortie->quantite = - $request['quantite'][$index];
                    $sortie->chantier_id = session('chantier');
                    $sortie->fournisseur_id = 0;
                    $sortie->user_id = Auth::id();
                    $sortie->save();
                }
           }

        }else{
           
        
            $entres = Entre::where([['materiel_id','=',$request['materiel_id']],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite');

            if($entres < $request['quantite'] ){
            	Session::flash('failed','Quantité maximal autorisée '.$entres);
            	return back();
            }

            $sortie = new Entre;
            $sortie->mode = 'sortie';
            $sortie->materiel_id = $request['materiel_id'];
            $sortie->date_ajout = $request['date'];
            $sortie->nfacture = sprintf("%04d",$request['nfacture']);
            $sortie->motif = $request['motif'];
            $sortie->pu = 0;
            $sortie->quantite = - $request['quantite'];

            $sortie->chantier_id = session('chantier');
            $sortie->fournisseur_id = $request['fourni'];

            $sortie->user_id = Auth::id();
            $sortie->save();

        }



        Session::flash('success','Vous avez bien ajouté  une entrée à la liste');
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
    public function edit($id)
    {
        $materiels = Materiel::get();
        $entre = Entre::findOrFail($id);
        return view('stocks.sortie.edit',['entre'=>$entre,'types'=>$materiels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entre  $entre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$entre)
    {
        $entre = Entre::findOrFail($entre);
        $entre->materiel_id = $request['materiel_id'];
        $entre->date_ajout = $request['date'];
        $entre->nfacture = sprintf("%04d",$request['nfacture']);
        $entre->pu = 0;
        $entre->quantite = -$request['quantite'];
        // $sortie->chantier_id = session('chantier');
        // $entre->fournisseur_id = $request['fourni'];
        $entre->motif = $request['motif'];
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
        return Excel::download(new sortieExport($min,$max), Chantier::findOrFail(session('chantier'))->name.' sortie de marchandise du '.$min.' au '.$max.'.xlsx');
    }

    public function exportPdf($numero){
        $bons = Entre::where('nfacture',$numero)->get();
        // return view('exports.pdfsortie',['bons'=>$bons]);
        $pdf = PDF::loadView('exports.pdfsortie',['bons'=>$bons])->setPaper('a5','hardscape');
        return $pdf->download('BON DE SORTIE '.$numero.'.pdf');
    }
}
