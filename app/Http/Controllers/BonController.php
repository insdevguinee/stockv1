<?php

namespace App\Http\Controllers;

use App\Bon;
use Illuminate\Http\Request;
use App\Materiel;
use App\Fournisseur;
use Auth;
use Session;
use PDF;
use App\Entre;
use App\Notification;
use Carbon\Carbon;
use App\Ticket;
use App\Chantier;
use App\User;

class BonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $etat = (isset($_GET['bons'])) ? $_GET['bons']:"attente";
        $bons = Bon::where([
            ['chantier_id',session('chantier')],
            ['etat',$etat]
        ])->get();

        $ids = Auth::user()->notifications()->allRelatedIds();

        foreach ($ids as $id){
            Auth::user()->notifications()->updateExistingPivot($id, ['show' => 0]);
        }

        return view('bons.list',['bons'=>$bons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiels = Materiel::get();
        $fournisseurs = Fournisseur::orderBy('name',"asc")->get();
        return view('bons.create',['types'=>$materiels,'fournisseurs'=>$fournisseurs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $numeroboncount = count(Bon::where([
            ['numerobon', $request['numerobon']],
            ['chantier_id',session('chantier')]
        ])->get());
        if( $numeroboncount > 0){
            Session::flash('failed','Numero de commande déjà utilisé');
            return back();
        }


        $numero = uniqid();
        foreach($request['materiel'] as $index => $mat){
            if($mat != Null){
                $bon = new Bon;
                $bon->name = $request['name'];
                $bon->numerobon = $request['numerobon'];
                $bon->materiel_id = $mat;
                $bon->date_execution = $request['date'];
                $bon->quantite = $request['quantite'][$index];
                // $bon->cout = ($request['cout'][$index]) ? $request['cout'][$index] : 0 ;
                $bon->cout =  0 ;
                $bon->user_id = Auth::id();
                $bon->chantier_id = session('chantier');
                $bon->fournisseur_id = $request->fournisseur;
                $bon->numero = $numero;
                $bon->save();
            }
        }


        // Notification
        $n = Notification::new('Nouveau bon de commande "'.$bon->name.'" chantier '.Chantier::findOrFail(session('chantier'))->name,$bon);

        Session::flash('success','Bon de commande créé');
        return redirect()->route('bons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bon  $bon
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bon = Bon::findOrFail($id);
        return view('bons.view',['bon'=>$bon]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bon  $bon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bon = Bon::findOrFail($id);
        if ($bon->etat =="valider" OR $bon->etat =="terminer"  ) {
            Session::flash('failed','Impossible de modifier un bon terminer ou valider');
            return redirect()->route('bons.index');
        }

        $materiels = Materiel::get();
        $fournisseurs = Fournisseur::get();
        return view('bons.edit',['bon'=>$bon,'materiels'=>$materiels,'fournisseurs'=>$fournisseurs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bon  $bon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bon = Bon::findOrFail($id);

        $created_at = $bon->created_at;
        if(!isset($request->etat)){
            if ($bon->etat =="valider" OR $bon->etat =="terminer"  ) {
                Session::flash('failed','Impossible de modifier un bon terminer ou valider');
                return redirect()->route('bons.index');
            }

            Bon::where('numero',$bon->numero)->delete();
            $numero = uniqid();
            foreach($request['materiel'] as $index => $mat){
                if($mat != Null){
                    $newbon = new Bon;
                    $newbon->name = $request['name'];
                    $newbon->numerobon = $request['numerobon'];
                    $newbon->materiel_id = $mat;
                    $newbon->date_execution = $request['date'];
                    $newbon->quantite = $request['quantite'][$index];
                    $newbon->cout = 0 ;
                    // $newbon->cout = (int)($request['cout'][$index]) ? $request['cout'][$index] : 0 ;
                    $newbon->user_id = Auth::id();
                    $newbon->etat = 'attente';
                    $newbon->chantier_id = /*$request['chantier_id']*/ session('chantier');
                    $newbon->fournisseur_id = $request->fournisseur;
                    $newbon->numero = $numero;
                    $newbon->created_at = $created_at;
                    $newbon->save();
                }
            }
            // Notification
            Notification::new('Modification du bon de commande "'.$newbon->name.'" de '.User::findOrFail($newbon->user_id)->name,$newbon);
        }else{
            $bons = Bon::where('numero',$bon->numero)->get();
            foreach($bons as $bon){
                $bon->etat = $request['etat'];
                $bon->motif = $request['motif'];
                $bon->valide_by = Auth::user()->id;
                $bon->save();
            }

            Session::flash('success','Etat modifié');
            return back();
        }

        Session::flash('success','Commande modifiée');
        $id = $newbon->id;

        return redirect()->route('bons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bon  $bon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bon $bon)
    {
        $numero = $bon->numero;
        Bon::where('numero',$numero)->delete();
        Session::flash('failed',"Vous avez bien supprimé l'entrée de la liste");
        return back();
    }

    public function pdf($id){
        // $pdf = PDF::loadView('exports.pdf',['bon'=>$bon])->setPaper('a4', 'landscape');
        $bon = Bon::findOrFail($id);
        if($bon->etat !== 'valider' AND $bon->etat !== 'terminer'){
            Session::flash('failed',"Impossible de télécharger un bon de commande annulé ou en attente de validation");
            return back();
        }
        $pdf = PDF::loadView('exports.pdf',['bon'=>$bon])->setPaper('a4');
        return $pdf->download('BON DE COMMANDE.pdf');
    }

    public function traiter($id)
    {
        $bon = Bon::findOrFail($id);
        $materiels = Materiel::get();
        $fournisseurs = Fournisseur::get();

        return view('bons.traiter',['bon'=>$bon,'materiels'=>$materiels,'fournisseurs'=>$fournisseurs]);
    }
}
