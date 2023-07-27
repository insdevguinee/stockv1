<?php

namespace App\Http\Controllers;

use App\Rapport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;

class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rapports = Rapport::where('chantier_id',session('chantier'))->get();
        return view('rapports.index',['rapports'=>$rapports]);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rapport  $rapport
     * @return \Illuminate\Http\Response
     */
    public function show(Rapport $rapport)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rapport  $rapport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rapport  $rapport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rapport = Rapport::findOrFail($id);
        if(!$rapport->valider){
            $rapport->valider = 1;
            $rapport->save();
            Session::flash('success','Rapport <strong>'.$rapport->name.'</strong> validé');
        }else{
            Session::flash('failed','Rapport <strong>'.$rapport->name.'</strong> déjà validé');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rapport  $rapport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rapport $rapport)
    {
        //
    }

    public function generate(Request $request)
    {
        if(@Auth::user()->roles->contains('name','admin') or @Auth::user()->can('add_rapports')){
            $rapport = Rapport::where('chantier_id',session('chantier'))->latest()->first();
            if(isset($rapport)){
                $datemin = $rapport->debut;
                $debut = Carbon::parse($datemin)->startOfWeek();
            }else{
                $debut = null;
            }



            if($debut != Carbon::now()->startOfWeek()){
                $rapport = new Rapport;
                $rapport->name = "Semaine ".Carbon::now()->weekOfMonth;
                $rapport->chantier_id = session('chantier');
                $rapport->debut = Carbon::now()->startOfWeek();
                $rapport->fin = Carbon::now()->endOfWeek();
                $rapport->user_id = Auth::id();
                $rapport->save();

                Session::flash('success','Rapport de la semaine generé');
            }else{
                Session::flash('failed','Rapport déja generé <strong>'.$rapport->name.'</strong>');
            }
        }
        return back();
    }

    public function auto()
    {

    }
}
