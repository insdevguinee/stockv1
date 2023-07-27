<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Evaluation SOCOEXIM</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</head>
	<body>
		<h4 class="text-uppercase"> {{$fiche->name.' '.$fiche->annee}} </h4>
		<div class="" style="background-color: ##f5f5f5;padding: 20px;">
			<div class="row">
				<div class="col-md-12">
					Hello, {{$personnel->nom}}
                    Cliquez sur le lien ci dessous
                    pour consulter votre fiche d'évaluation
				</div>
			</div>
		</div>
		<div class="row">
			<a href="https://socoexim.ci/">Cliquez-ici</a>
		</div>
</body>
</html>
