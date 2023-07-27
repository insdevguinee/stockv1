<?php

namespace App\Http\Controllers;

use App\CategorieEvaluation;
use App\Critere;
use App\Evaluateur;
use App\FicheEvaluative;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Personnel;
use Session;
use PDF;
use App\Notes as Note;
use App\Notification;
use Hash;

class FicheEvaluativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $fiches = FicheEvaluative::all();
        return view('fiches.fiche_index',['fiches'=>$fiches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $evaluateurs = User::all();
        return view('fiches.fiche_create',['evaluateurs'=>$evaluateurs]);
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
        $newfiche = new FicheEvaluative;
        $newfiche->name = $request['name'];
        $newfiche->notation = $request['notation'];
        $newfiche->annee = $request['year'];
        $newfiche->save();

        // sauvegarder des evaluateurs
        foreach ($request['user_id'] as $key => $value) {
            $evaluateur = new Evaluateur;
            $evaluateur->fiche_id = $newfiche->id;
            $evaluateur->ponderation = $request['ponderation'][$key];
            $evaluateur->user_id = $value;
            $evaluateur->save();
        }

        $this->critere("Individuel",$request['i-cname'],$newfiche->id);
        $this->critere("Technique",$request['t-cname'],$newfiche->id);
        $this->critere("Groupe",$request['g-cname'],$newfiche->id);

        Session::flash('success','Fiche créée avec succès');
        return back();

    }

    private function critere(String $categorie,array $array,int $fiche_id)
    {
        $cat = new CategorieEvaluation;
        $cat->name = $categorie;
        $cat->fiche_id = $fiche_id;
        $cat->save();

        foreach ($array as $key => $value) {
            $critere = new Critere;
            $critere->name = $value;
            $critere->categorie_id = $cat->id;
            $critere->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FicheEvaluative  $ficheEvaluative
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('fiches.fiche_show',['fiche'=>FicheEvaluative::findOrFail($id)]);
    }

    public function consulter($id,Request $request)
    {
        $personnel = Personnel::findOrFail($id);
        $fiche = FicheEvaluative::findOrFail($_GET['fiche']);
        return view('fiches.fiche_note',['personnel'=>$personnel,'fiche'=>$fiche]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FicheEvaluative  $ficheEvaluative
     * @return \Illuminate\Http\Response
     */
    public function edit(FicheEvaluative $ficheEvaluative)
    {
        //
    }

    public function avisuser(Request $request)
    {
        // dd($request['fiche']);
        $avis = Note::where([
            ['fiche_id',$request['fiche']],
            ['personnel_id',$request['personnel']]
             ])->update(['avis_utilisateur'=>$request['monavis']]);

        Session::flash('success','Votre avis a été transmis');
        return back();
    }

    public function evaluation($id,Request $request)
    {
        $personnel = Personnel::findOrFail($id);
        $fiche = FicheEvaluative::findOrFail($_GET['fiche']);
        // dd($fiche->categories);
        return view('fiches.fiche_evaluer',['personnel'=>$personnel,'fiche'=>$fiche]);
    }

    public function evaluer($id, Request $request)
    {
        // dd($request);
        foreach ($request['note'] as $key => $note) {

            $idcritere = @Note::where([['user_id',Auth::id()],['personnel_id',$request['personnel_id']],['critere_id',$key]])->first()->id;

            if (isset($idcritere)) {
                $n =Note::findOrFail($idcritere);
            }else{
                $n = new Note;
            }
            $n->critere_id = $key;
            $n->note = $note;
            $n->fiche_id= $id;
            $n->personnel_id = $request['personnel_id'];
            $n->user_id = Auth::id();
            $n->avis = $request['avis'];
            $n->save();
        }
        Session::flash('success','Evaluation effectuée');
        $this->sendEmail($request['personnel_id'],$id);

        return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FicheEvaluative  $ficheEvaluative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FicheEvaluative $ficheEvaluative)
    {
        //
    }

    public function sendEmail($id,$f)
    {

        $personnel = Personnel::findOrFail($id);
        $fiche = FicheEvaluative::findOrFail($f);
        try {
            Notification::note_email($personnel,$fiche);
            Session::flash('success','Email envoyé');
        } catch (\Throwable $th) {
            Session::flash('error','Erreur lors de l\'envoie du mail');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FicheEvaluative  $ficheEvaluative
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FicheEvaluative::findOrFail($id)->delete();
        Session::flash('success','Fiche supprimée');
        return back();
    }

    public function print($id,Request $request)
    {
        $personnel = Personnel::findOrFail($id);
        $fiche = FicheEvaluative::findOrFail($_GET['fiche']);

        $pdf = PDF::loadView('exports.fiche_pdf',['personnel'=>$personnel,'fiche'=>$fiche])->setPaper('a4');
        return $pdf->download('Fiche Evaluation.pdf');

        // dd($fiche->categories);
        // return view('fiches.fiche_evaluer',['personnel'=>$personnel,'fiche'=>$fiche]);
    }
}
