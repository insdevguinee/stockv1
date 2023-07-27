<?php

namespace App\Http\Controllers;

use App\Personnel;
use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnels = Personnel::all();
        return view('documents.index',['documents'=>Document::all(),"personnels"=>$personnels]);
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
        

        if ($request['fichier']) {
            $filename = time().'-'.$request['name'].'.'.$request->fichier->extension();

            // //Store in Storage Folder
            $file = $request->fichier->storeAs('public/docs', $filename);

            // $file = $request->fichier->move(public_path('assets/docs/'), $filename);
        }
        // dd($file);
        $document = new Document;
        $document->name = $request['name'];
        $document->description = $request['description'];
        $document->personnel_id = $request['personnel_id'];
        $document->fichier = $filename;
        $document->save();

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
    public function destroy($id)
    {
        $d = Document::findOrFail($id);
        unlink('public/storage/docs/'.$d->fichier);
        $d->delete();
        return back();
    }
}
