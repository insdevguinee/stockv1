<?php

namespace App\Http\Controllers;

use App\Boncaisse;
use App\Chantier;
use App\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
use App\User;
use App\Personnel;
use PDF;

class BoncaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etat = (isset($_GET['boncaisses'])) ? $_GET['boncaisses']:"attente";
        $boncaisse = Boncaisse::where([
            ['chantier_id',session('chantier')],
            ['etat',$etat]
        ])->get();
        return view('boncaisses.list',['boncaisses'=>$boncaisse]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $personnels = Personnel::where('departement_id',@Auth::user()->personnel->departement_id)->get();

        if (Auth::user()->hasRole('admin|ADMIN')) {
            $personnels = Personnel::all();
        }else{
            $personnels = Personnel::where('departement_id',@Auth::user()->personnel->departement_id)->get();
        }


        return view('boncaisses.create',['personnels'=>$personnels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $numeroboncount = count(Boncaisse::where([
            ['numerobon', $request['numerobon']],
            ['chantier_id',session('chantier')]
        ])->get());
        if( $numeroboncount > 0){
            Session::flash('failed','Numero de commande déjà utilisé');
            return back();
        }
        $numero = uniqid();
        $bon = new Boncaisse;
        $bon->name = $request['name'];
        $bon->numerobon = $request['numerobon'];
        $bon->motif = $request['motif'];
        $bon->date_execution = Carbon::now();
        $bon->cout = $request['cout'] ;
        $bon->chantier_id = session('chantier');
        if(!empty($request['beneficiaire'])){
            $bon->beneficiaire = $request['beneficiaire'];
            $bon->user_id = 0;
        }else{
            $bon->beneficiaire = NULL;
            $bon->user_id = $request['user_id'];
        }

        $bon->save();


        // Notification
        $n = Notification::new('Demande de decaissement "'.$bon->name.'" chantier '.Chantier::findOrFail(session('chantier'))->name,$bon);

        Session::flash('success','Demande envoyée');
        return redirect()->route('boncaisses.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Boncaisse  $boncaisse
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boncaisse = Boncaisse::findOrFail($id);
        return view('boncaisses.view',['boncaisse'=>$boncaisse]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Boncaisse  $boncaisse
     * @return \Illuminate\Http\Response
     */
    public function edit(Boncaisse $boncaisse)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Boncaisse  $boncaisse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bon = Boncaisse::findOrFail($id);

        if ($bon->etat =="valider" or $bon->etat =="annuler") {
            Session::flash('failed','Impossible de modifier un bon valider ou annuler');
            return back();
        } else{
           
            $bon->etat = $request['etat'];
            $bon->valide_by = Auth::id();
            $bon->save();

            Session::flash('success','Etat modifié');
            return back();
        }
    }

    public function pdf($id){
        // $pdf = PDF::loadView('exports.pdf',['bon'=>$bon])->setPaper('a4', 'landscape');
        $bon = Boncaisse::findOrFail($id);
        if($bon->etat !== 'valider' AND $bon->etat !== 'annuler'){
            Session::flash('failed',"Impossible de télécharger un bon de commande annulé ou en attente de validation");
            return back();
        }
        $pdf = PDF::loadView('exports.boncaissepdf',['bon'=>$bon])->setPaper('a4');
        return $pdf->download('BON DE CAISSE.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Boncaisse  $boncaisse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boncaisse $boncaisse)
    {
        //
    }
}
