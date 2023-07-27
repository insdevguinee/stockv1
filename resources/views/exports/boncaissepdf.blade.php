<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{ URL::to('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
		<title>Bon de caisse</title>

	</head>
	<style>

</style>
	<body>

		@for ($i = 0; $i < 2; $i++)
		<div class="row">
			<div class="col-md-6 float-left">
				<img src="{{ URL::to('assets/img/logo_socoexim.png')}}" style="height: 50px;" alt="Logo">
				<p class="text-justify">Société de Construction et Expertise Immobilière</p>
			</div>
		</div>
		<p class="text-right">Abidjan le {{explode('00:00',\Carbon\Carbon::parse($bon->date_execution,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]}}</p>
		<h4 class="text-center text-uppercase" style="margin-top: 10px;"><strong>BON DE CAISSE </strong></h4>
		<div class="row " style="margin-top: 10px;">
			<div class="col-md-12">
				<h5 class="text-uppercase"><u><strong>CHANTIER</strong> : {{ @$bon->chantier->name }} / {{$bon->numerobon }}</u></h5>
			</div>
			{{-- {{ number_format(@$t->quantite, 2,'.',' ') }} --}}
		</div>
		<div class="row">
			<div class="col-md-12">
				<label for="">Montant en chiffre</label>
				<div class="form-control">
					{{ number_format($bon->cout, 2,'.',' ') }}  FCFA
				</div>
			</div>

			<div class="col-md-12">
				<label for="">Nature de la dépense</label>
				<div class="form-control">
					{{$bon->motif}}
				</div>
			</div>
			<div class="col-md-12">
				<label for="">Bénéficiaire</label>
				<div class="form-control">
					@if ($bon->user_id == 0)
						{{$bon->beneficiaire}}
					@else
					{{@$bon->user->nom.' '.@$bon->user->prenoms}}
					@endif
				</div>
			</div>
	   </div>

		<div class="row" style="margin-top: 10px;margin-bottom:20px;">
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>Autorisation</strong></u></h5>
			</div>
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>Beneficiaire</strong></u></h5>
			</div>
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>Remettant</strong></u></h5>
			</div>
		</div>
		@endfor
	</body>
</html>
