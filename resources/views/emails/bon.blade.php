<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Nouveau Bon de commande</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</head>
	<body>
		<p>
		Nouveau bon de commande en attente de validation
		</p>
		<div class="" style="background-color: ##f5f5f5;padding: 20px;">
				<h4 class="text-center text-uppercase" style="margin-top: 20px;"><u><strong>BON DE COMMANDE N° </strong></u>{{ $bon->numerobon }}</h4>
			<div class="row " style="margin-top: 20px;">
				<div class="col-md-12">
					<h5 class="text-uppercase"><u><strong>OBJET</strong> : {{ $bon->name }}</u> <br></h5>
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
								<th>REF</th>
								<th>UNITE</th>
								<th>QTE</th>
								<th>COUT</th>
								<th>MONTANT</th>
							</tr>
						</thead>
						<tbody>
							@php $i=1;$montant = 0; @endphp
							@foreach(\App\Bon::where('numero',$bon->numero)->get() as $t)
				              <tr>
				              	<td>{{ $i++ }}</td>
				                <td>{{ @$t->materiel->name }}</td>
				                <td>{{ @$t->materiel->unite }}</td>
				                <td>{{ number_format(@$t->quantite,0,',',' ') }}</td>
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
			{{-- <div>
				<a href="#" class="btn btn-info">
		      		 Valider
		    	</a>
		    	<a href="#" class="btn btn-danger">
		      		 Annuler
		    	</a>
			</div> --}}
		</div>
		<div class="row">
			<a href="https://socoexim.ci">Se connecter</a>
		</div>
</body>
</html>