<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{ URL::to('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
		<title>Demande d'autorisation</title>

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
		<p class="text-right">Fait le {{explode('00:00',\Carbon\Carbon::parse($demande->created_at,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]}}</p>
		<h4 class="text-center text-uppercase" style="margin-top: 20px;"><strong>DEMANDE D'AUTORISATION : </strong>{{ $demande->type }}</h4>
		<div class="row " style="margin-top: 20px;">
			<div class="col-md-12">
				<h5 class="text-uppercase"><strong>OBJET</strong> : {{ $demande->titre }}</h5>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				<h5 class="text-uppercase"><strong>DATE :</strong> {{@$demande->date_d." - ".@$demande->date_f}}</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center form-control">
				{!! $demande->message !!}
			</div>
		</div>
		<div class="row" style="margin-top: 50px;">
			<div style="width: 100%;display: inline-block;" class="text-center">
				<h5 class="text-uppercase text-center"><u><strong>RESPONSABLE</strong></u></h5>
                @if ($demande->status == "en attente" )
                    En attente de décision
                @elseif($demande->status == "accorder")
                    REFUSER
                @else
                    ACCEPTER
                @endif
                
            </div>
		</div>
		<div class="row" style="position: absolute;bottom: 10px;text-align: center">
			<small>{{ \Carbon\Carbon::now() }}</small>
		</div>

	</body>
</html>
