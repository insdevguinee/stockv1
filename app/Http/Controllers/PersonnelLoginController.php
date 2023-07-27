<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Personnel;
use Hash;

class PersonnelLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('guest:personnels')->except('logout');
    }

    public function index()
    {
        //
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

    public function showLoginForm()
    {
        return view('fiches.login');
    }

    public function login(Request $request)
    {
        // $fiche = FicheEvaluative::findOrFail($_GET['fiche']);
        $credentials = $request->validate([
            'matricule' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('personnels')->attempt($credentials)) {
            // Authentification réussie
            // dd("Success");
            dd(Auth::user());
        } else {
            // Authentification échouée
            return back()->withErrors([
                'matricule' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
            ]);
            // return redirect()->back()->withErrors(['message' => 'Identifiants invalides']);
        }

        // $user = Personnel::where('matricule',$request['matricule'])->first();

        // if (!$user || !Hash::check($credentials['password'], $user->password)) {
        //     return back()->withErrors([
        //         'matricule' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        //     ]);
        // }
        // Auth::guard('personnels')->attempt($credentials);
        // dd($credentials);
        dd(Auth::user());

    }

}
