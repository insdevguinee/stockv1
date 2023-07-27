<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{ URL::to('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
		<title>Bon de sortie</title>

	</head>
	<style>
		
</style>
	<body>
		<div class="row">
			<div class="float-left col-sm-6">
				<img src="{{ URL::to('assets/img/logo_socoexim.png')}}" style="height: 70px;" alt="Logo">
				<p class="text-justify"><small>Société de Construction et Expertise Immobilière</small></p>
			</div>
			<div class="col-md-6 col-sm-6 text-right">
				<p class="float-right">
					Abidjan le<br>{{substr(explode(':',\Carbon\Carbon::parse($bons->first()->created_at,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0],0,-3)}}
				</p>
			</div>
		</div>
		
		<h4 class="text-center text-uppercase" style="margin-top: 20px;"><strong><u>BON DE SORTIE N°</u>{{ $bons->first()->nfacture }}</strong></h4>
		<div class="row " style="margin-top: 20px;">
			<div class="col-md-12" style="margin-top: 10px;">
				<h6 class="text-uppercase"><u><strong>CHANTIER</strong> : {{ @$bons->first()->chantier->name }}</u></h6>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered" style="margin-top: 50px;">
					<thead>
						<tr>
							<th width="200px">QUANTITE</th>
							<th>DESIGNATION</th>
						</tr>
					</thead>
					<tbody>
						@foreach($bons as $t)
			              <tr>
			                <td>{{ -1 * number_format(@$t->quantite, 2,'.',' ') }}</td>
			                <td>{{ @$t->materiel->name }}</td>
			              </tr>
			             @endforeach
			              
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>