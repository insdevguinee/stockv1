<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('envoiemail', 'MailController@send');

Route::group(['middleware'=>['https']], function ()
{

	// Generer le rapport de la semaine automatiquement
		// Route::get('generateWeek', 'RapportController@generate');
	// Fin

	Route::get('/', function () {
        return redirect()->route('login');
	})->middleware('guest');

	Route::get('aide', 'HomeController@aide')->name('aide');

	Auth::routes();
	// Route::group(['middleware' => ['auth','permission_controller','user_active']], function() {
	Route::group(['middleware' => ['auth']], function() {

	    Route::get('/home', 'StockController@index');
	    Route::get('/', 'StockController@index')->name('home');

	    // Materiels
		Route::resource('materiels', 'MaterielController');


		// Categories
		Route::resource('categories', 'CategorieController');

		// Reception de marchantise
		Route::resource('entres', 'EntreController')->except(['create']);
		Route::get('entremultiple', 'EntreController@multiple')->name('entre.multiple');
		Route::post('bon/{id}/traitement', 'EntreController@traiter')->name('entre.bon');
		Route::get('exporteentrexls', 'EntreController@export')->name('entre.exportXls');
		Route::get('entres2','entreController@entre2')->name('entre2');

		// Sortie d'article
		Route::resource('sorties', 'SortieController')->except(['create']);
		Route::get('exportesortiexls', 'SortieController@export')->name('sortie.exportXls');
		Route::get('bondesortie/{numero}', 'SortieController@exportPdf')->name('sortie.exportPdf');

		Route::resource('stocks', 'StockController');
		Route::get('resume', 'StockController@pdf')->name('stock.pdf');
		Route::resource('settings', 'SettingController');
		Route::get('sortiemultiple', 'SortieController@multiple')->name('sortie.multiple');

		// Route::get('stock/date', 'StockController@datefilter')->name('datefilter');
		Route::resource('users', 'UserController');
		Route::post('user/{id}/active', 'UserController@active')->name('user.active');
		Route::post('user/{id}/passwordreset', 'UserController@passwordreset')->name('user.passwordReset');

		// Bon de commande
		Route::resource('bons', 'BonController');
		Route::resource('chantiers', 'ChantierController');
		Route::get('commandepdf/{id}','BonController@pdf')->name('bon.pdf');
		Route::get('bon/{id}/traitement', 'BonController@traiter')->name('bon.traiter');
		
		// Bon de caisse
		Route::resource('boncaisses', 'BoncaisseController');
		Route::get('commandecaissepdf/{id}','BoncaisseController@pdf' )->name('boncaisse.pdf');

		// Notifications
		Route::get('notification', 'NotificationController@commande')->name('commande.notif');
		Route::resource('notifications', 'NotificationController');

		// Permissions & Roles
		Route::resource('roles','RoleController');
	    Route::resource('permissions','PermissionController');

	    // Chantiers
	    Route::post('chantierselect','ChantierController@select')->name('chantier.select');

	    // Transfert
	    Route::get('transferts','TransfertController@index')->name('transfert');
	    Route::get('transfertmultiple','TransfertController@multiple')->name('transfert.multiple');
	    Route::POST('transfertmultiple','TransfertController@postmultiple')->name('transfert.multiple');
	    Route::post('transferts', 'TransfertController@store')->name('transferts.store');

	    // Rapport Mensuel
	    Route::resource('rapports', 'RapportController');
	    Route::post('generate', 'RapportController@generate')->name('generate');

	    // Fournisseurs
	    Route::resource('fournisseurs', 'FournisseurController');
	    Route::get('fournisseur/{id}/pdf/{bonid}', 'FournisseurController@exportPdf')->name('fournisseur.exportPdf');

	    // Outils
	    Route::resource('outils', 'OutilController');
	    Route::get('assignations', 'OutilController@assignation')->name('assignation');
	    Route::post('assignations', 'OutilController@assigner')->name('assignation.store');
	    Route::put('assignations/{id}', 'OutilController@remove')->name('assignation.update');

	    // Personnels
	    Route::resource('personnels', 'PersonnelController');
        // Evalutation
            //  Creation fiche
            Route::resource('fiches', 'FicheEvaluativeController');
            Route::get('evaluations/{id}','FicheEvaluativeController@evaluation')->name('evaluation.index');
            Route::get('evaluations/{id}/print','FicheEvaluativeController@print')->name('evaluation.print');
            Route::get('evaluations/{id}/show','FicheEvaluativeController@consulter')->name('evaluation.show');
            Route::POST('evaluations/{id}','FicheEvaluativeController@evaluer')->name('evaluation.index');
            Route::POST('email/{id}/{fiche}','FicheEvaluativeController@sendEmail')->name('emailnote.send');
			Route::POST('createuser/{id}','PersonnelController@usercreate')->name('user.personnel');

        Route::prefix('personnel')->group(function () {
            Route::get('dashboard', 'PersonnelController@dashboard')->name('personnel.dashboard');
            Route::get('evaluations/{id}/show', 'PersonnelController@consulter')->name('personnel_evaluation');
            Route::get('demandes', 'DemandeController@index')->name('demandes');
			Route::post('demandes', 'DemandeController@store')->name('demande.new');
			Route::post('annuler-{id}', 'DemandeController@annuler')->name('demande.annuler');
			Route::post('reponse{id}', 'DemandeController@reponse')->name('demande.reponse');

			Route::get('update','PersonnelController@modif')->name('personnel.edit');
			Route::post('avisuser','FicheEvaluativeController@avisuser')->name('avisuser');
			Route::get('mes-documents',function ()
			{
				return view('personnels.profil.documents');
			})->name('personnel.fichier');
        });
		// Demande
		Route::prefix('demande')->group(function ()
		{
			Route::get('liste','DemandeController@list')->name('demande.index');
			Route::get('demandepdf/{id}','DemandeController@pdf' )->name('demande.pdf');
		});

		Route::get('documents','DocumentController@index')->name('document.index');
		Route::POST('documents{id}','DocumentController@destroy')->name('document.destroy');
		Route::post('documents','DocumentController@store')->name('document.send');
		// personnel_evaluation


    });

	Route::get('link',function ()
	{
		Artisan::call('storage:link --name=public');
	});
    // Route::prefix('personnel')->group(function () {
    //     Route::get('login', 'PersonnelLoginController@showLoginForm');
    //     Route::POST('connexion', 'PersonnelLoginController@login')->name('login.personnel');
    // });

        // Route::get('mafiche', 'FicheEvaluativeController@fiche');
});

