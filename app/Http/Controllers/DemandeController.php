<?php

namespace App\Http\Controllers;

use App\Demande;
use Illuminate\Http\Request;
use Auth;
use PDF;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request['demande']){
            $d = Demande::findOrFail($request['demande']);
        }else{
            $d = null;
        }
        $demandes = Auth::user()->demandes()->orderBy('created_at','desc')->get();
        return view('personnels.profil.permission',['demandes'=>$demandes,'d'=>$d]);
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
        $demande = new Demande;
        $demande->titre = $request['titre'];
        $demande->type = $request['type'];
        $demande->message = $request['message'];
        $demande->date_d = $request['date_d'];
        $demande->date_f = $request['date_f'];
        $demande->status = "en attente";
        $demande->user_id = Auth::user()->id;
        
        $demande->save();

        return back();
    }

    public function annuler($id)
    {
        Demande::findOrFail($id)->update([
            'status'=>'annuler',
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function show(Critere $critere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function edit(Critere $critere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Critere $critere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Critere $critere)
    {
        //
    }

    public function list()
    {
        $demandes = Demande::where([['status','!=','annuler']])->get();
        return view('demandes.index',['demandes'=>$demandes]);
    }

    public function reponse($id,Request $request)
    {
        $message = $request['r'] == 0 ? "refuser" : "accorder";
        Demande::findOrFail($id)->update([
            'status'=>$message,
        ]);

        return back();
    }
    
    public function pdf($id){
        // $pdf = PDF::loadView('exports.pdf',['bon'=>$bon])->setPaper('a4', 'landscape');
        $demande = Demande::findOrFail($id);
        // if($demande->status !== 'valider' AND $bon->etat !== 'terminer'){
        //     Session::flash('failed',"Impossible de télécharger un bon de commande annulé ou en attente de validation");
        //     return back();
        // portrait
        // }
        $pdf = PDF::loadView('exports.pdfdemande',['demande'=>$demande])->setPaper('a5','landscape');
        return $pdf->download('DEMANDE D\'AUTORISATION.pdf');
    }

}
