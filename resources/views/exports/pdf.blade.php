<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{ URL::to('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
		<title>Bon de commmande</title>

	</head>
	<style>

</style>
	<body>
		<div class="row">
			<div class="col-md-6 float-left">
				<img src="{{ URL::to('assets/img/logo_socoexim.png')}}" style="height: 70px;" alt="Logo">
				<p class="text-justify">Société de Construction et Expertise Immobilière</p>
			</div>
		</div>
		<p class="text-right">Abidjan le {{explode('00:00',\Carbon\Carbon::parse($bon->date_execution,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]}}</p>
		<h4 class="text-center text-uppercase" style="margin-top: 20px;"><u><strong>BON DE COMMANDE N° </strong></u>{{ $bon->numerobon }}</h4>
		<div class="row " style="margin-top: 20px;">
			<div class="col-md-12">
				<h5 class="text-uppercase"><u><strong>OBJET</strong> : {{ $bon->name }}</u></h5>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				<h5 class="text-uppercase"><u><strong>FOURNISSEUR :</strong> {{@$bon->fournisseur->name}}</u></h5>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				<h5 class="text-uppercase"><u><strong>CHANTIER</strong> : {{ @$bon->chantier->name }}</u></h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered" style="margin-top: 50px;">
					<thead>
						<tr>
							<th>N°</th>
							<th>REFERENCES</th>
							<th>UNITE</th>
							<th>QUANTITE</th>
							<th>COUT</th>
							<th>MONTANT</th>
						</tr>
					</thead>
					<tbody>
						@php $i=1;$montant = 0; @endphp
						@foreach(\App\Bon::where('numero',$bon->numero)->where('chantier_id',session('chantier'))->get() as $t)
			              <tr>
			              	<td>{{ $i++ }}</td>
			                <td>{{ @$t->materiel->name }}</td>
			                <td>{{ @$t->materiel->unite }}</td>
			                <td>{{ number_format(@$t->quantite, 2,'.',' ') }}</td>
			                <td>{{ number_format(@$t->cout,0,',',' ') }}</td>
			                <td>{{ number_format($sum = @$t->quantite * @$t->cout ,0, ',' , ' ')    }}</td>
			              </tr>
			              @php $montant += $sum; @endphp
			              @endforeach
			              <tr>
			              	<th colspan="5" class="text-center">
			              		TOTAL
			              	</th>
			              	<th>
			              		{{ number_format($montant ,0, ',' , ' ') }} FCFA
			              	</th>
			              </tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" style="margin-top: 50px;">
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>DIRECTEUR GENERAL</strong></u></h5>
			</div>
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>DIRECTEUR TECHNIQUE</strong></u></h5>
			</div>
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>RESPONSABLE APPROVISIONNEMENT</strong></u></h5>
			</div>
		</div>
		<div class="row" style="position: absolute;bottom: 10px;text-align: center">
			<small>{{ \Carbon\Carbon::now() }}</small>
		</div>

	</body>
</html>
