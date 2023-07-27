@php
$array[]= \App\Bon::where('id',$bon)->first()->numerobon;
@endphp

<!DOCTYPE html>
<html lang="" >
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{ URL::to('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
		<title>{{ $fournisseur->name }}</title>

	</head>
	<body style="background-color: #fff !important">

    <div class="container">
    	<div class="row">
			<div class="col-md-6 float-left">
				<img src="{{ URL::to('assets/img/logo_socoexim.png')}}" style="height: 70px;" alt="Logo">
				<p class="text-justify">Société de Construction et Expertise Immobilière</p>
			</div>
		</div>
		<p class="text-right">Abidjan le {{explode('00:00',\Carbon\Carbon::parse(\Carbon\Carbon::now(),'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]}}</p>
    	<div class="row">
      <h1 class="text-center text-capitalize">{{ $fournisseur->name }}</h1>
      <h4><u>Chantier</u> : {{ \App\Chantier::findOrFail(session('chantier'))->name }}</h4>
        @foreach($fournisseur->bons->whereIn('etat',['valider','terminer'])->sortByDesc('id') as $bon)
	        @if(in_array($bon->numerobon, $array))
		      <div class="col-md-12">
		        <div class="widget  panel panel-default">
		          <div class="widget-header">
		             <h3 class="text-center">BON DE COMMANDE {{ $bon->numerobon }}  <small> ({{ $bon->etat }})</small></h3>
		          </div>
		          <div class="panel-body">
		             <div class="row">
		               <div class="col-md-12">
		                <h4 class="text-center">Livrés</h4>
		                 <div class="table-responsive">
		                    <table class="table table-bordered mb-5" cellspacing="0" width="100%" style="margin-bottom: 15px">
		                      <thead>
		                          <tr>
		                              <th>Produit</th>
		                              <th>Date</th>
		                              <th>Quantite</th>
		                              <th>Details</th>
		                              {{-- <th>Par</th> --}}
		                              <th>Reste</th>

		                          </tr>
		                      </thead>
		                     <tbody>
		                      @foreach(collect(\App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id]])->get())->unique('materiel_id') as $en)
		                      @php
		                        $mat = @$en->materiel_id;
		                        $unite = @$en->materiel->unite;
		                        $qte = \App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat]])->sum('quantite');
		                        $qteBon = \App\Bon::where([['numerobon','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['chantier_id','=',session('chantier')],['materiel_id','=',$mat]])->sum('quantite');
		                        $somme = 0;
		                      @endphp
		                      <tr class="alert {{ ($qte==$qteBon OR $qte >= $qteBon)?'alert-success':'alert-warning' }}">
		                          <td>{{ @$en->materiel->name }}</td>
		                          <td>
		                            @foreach(\App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat ]])->get() as $m)
		                            {{ date('d/m/Y',strtotime($m->date_ajout)) }} <br>
		                            @endforeach
		                          </td>
		                          <td>
		                             @foreach(\App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat ]])->get() as $m)
		                            {{ $m->quantite.' '.@$m->materiel->unite.'(s)'}} <br>
		                            @php
		                              $somme += $m->quantite;
		                            @endphp
		                             @endforeach
		                             <br>
		                             <hr style="margin-top: -15px; margin-bottom: 0;">
		                             {{ "Total : ".$somme.' '.$unite.'(s)' }}
		                          </td>
		                          <td>
		                            {{ $en->motif }}
		                          </td>
		                          <td>
		                            {{ $qteBon - $qte }}
		                          </td>
		                      </tr>
		                      @endforeach
		                    </tbody>
		                  </table>
		                  </div>
		               </div>
		               <div class="col-md-12">
		                 <h4 class="text-center">Commandés</h4>
		                 <div class="table-responsive">
		                    <table class="table table-bordered mb-5" cellspacing="0" width="100%" style="margin-bottom: 15px">
		                      <thead>
		                          <tr>
		                              <th>Produit</th>
		                              <th>Date</th>
		                              <th>Quantite</th>
		                              {{-- <th>Par</th> --}}
		                              <th>Prix</th>
		                          </tr>
		                      </thead>
		                      <tbody>
		                      	@php $i=1;$montant = 0; @endphp
			                      @foreach(\App\Bon::where([['numerobon','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['chantier_id','=',session('chantier')]])->get() as $en)
			                      <tr>
			                          <td>{{ @$en->materiel->name }}</td>
			                          <td>{{ date('d/m/Y',strtotime($en->date_execution)) }}</td>
			                          <td>{{ $en->quantite.' '.@$en->materiel->unite.'(s)'}}</td>
			                          <td>{{ number_format($sum = $en->quantite * $en->cout,0,',',' ') }}</td>
			                          {{-- <td>{{ @$en->user->name }}</td> --}}
			                      </tr>
			                      @php $montant += $sum; @endphp
			                      @endforeach
			                      <tr>
			                        <td colspan="3" class="text-right">Total</td>
			                        <td>{{ number_format($montant,0,',',' ') }}</td>
			                      </tr>
					            </tbody>
		                </table>
		            		</div>
		               </div>
		             </div>
		          </div>
		        </div>
		      </div>
		      @break
	       @endif
      @endforeach
    </div>
    </div>

	</body>
</html>
