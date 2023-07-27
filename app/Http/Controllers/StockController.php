<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entre;
use Auth;
use App\Materiel;
use App\Categorie;
use PDF;
use Carbon\Carbon;
use App\Rapport;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(isset($_GET['cat'])){
            $categorie = Categorie::findOrFail($_GET['cat']);
        }else{
            $categorie = Categorie::first();
        }

        $materiels = @$categorie->materiels()->orderBy('name')->get();
        $types = Materiel::get();
        return view('stocks.stock',['materiels'=>$materiels,'types'=>$types,'catego'=>$categorie]);
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
        //
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

    public function datefilter(){

       if(isset($_GET['cat'])){
            $categorie = Categorie::findOrFail($_GET['cat']);
        }else{
            $categorie = Categorie::first();
        }

        $materiels = $categorie->materiels()->orderBy('name')->get();
        return view('stocks.stock-date',['materiels'=>$materiels]);

    }

    public function pdf(Request $request){
        
        if(isset($_GET['article']) and !empty($_GET['article'])){
            $materiels = Materiel::findOrFail($_GET['article'])->get();
        }else{
            if(isset($_GET['cat']) and !empty($_GET['cat']) ){
                $categorie = Categorie::findOrFail($_GET['cat']);
            }else{
                $categorie = Categorie::first();
            }
            $materiels = $categorie->materiels()->orderBy('name')->get();
        } 

        
        $cat = (isset($_GET['cat'])) ? $_GET['cat'] : @$materiels->first()->categorie->id;
        $min = (@$_GET['datedebut']) ? @$_GET['datedebut'] : Carbon::now()->startOfWeek()  ;
        $max = (@$_GET['datefin']) ? @$_GET['datefin'] : Carbon::now()->endOfWeek()->subDays(1) ;

        $getDate = ['max'=>$max,'min'=>$min,'cat'=>$cat];
        $categorie = $materiels->first()->categorie;

        $rapport = isset($request['rapport']) ? 1 : 0;
       
       // Rapport
        if($rapport){
            $rapport = Rapport::findOrFail($request['rapport']);
            $min = $rapport->debut;
            $max = $rapport->fin ;
            $getDate = ['max'=>$max,'min'=>$min,'cat'=>$cat];
            return view('exports.pdfresume',['categorie'=>$categorie,'getDate'=>$getDate,'rapport'=>$rapport]);
        }

        $pdf = PDF::loadView('exports.pdfresume',['categorie'=>$categorie,'getDate'=>$getDate,'rapport'=>$rapport])->setPaper('a4','landscape');
        return $pdf->download('STOCK DATE '.$max.'-'.$min.' .pdf');
    }
}
