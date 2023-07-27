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
				<h4 class="text-center text-uppercase" style="margin-top: 20px;"><u><strong>BON DE COMMANDE N° </strong></u><?php echo e($bon->numerobon); ?></h4>
			<div class="row " style="margin-top: 20px;">
				<div class="col-md-12">
					<h5 class="text-uppercase"><u><strong>OBJET</strong> : <?php echo e($bon->name); ?></u> <br></h5>
				</div>
				<div class="col-md-12" style="margin-top: 10px;">
					<h5 class="text-uppercase"><u><strong>FOURNISSEUR :</strong> <?php echo e(@$bon->fournisseur->name); ?></u></h5>
				</div>
				<div class="col-md-12" style="margin-top: 10px;">
					<h5 class="text-uppercase"><u><strong>CHANTIER</strong> : <?php echo e(@$bon->chantier->name); ?></u></h5>
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
							<?php $i=1;$montant = 0; ?>
							<?php $__currentLoopData = \App\Bon::where('numero',$bon->numero)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				              <tr>
				              	<td><?php echo e($i++); ?></td>
				                <td><?php echo e(@$t->materiel->name); ?></td>
				                <td><?php echo e(@$t->materiel->unite); ?></td>
				                <td><?php echo e(number_format(@$t->quantite,0,',',' ')); ?></td>
				                <td><?php echo e(number_format(@$t->cout,0,',',' ')); ?></td>
				                <td><?php echo e(number_format($sum = @$t->quantite * @$t->cout ,0, ',' , ' ')); ?></td>
				              </tr>
				              <?php $montant += $sum; ?>
				              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				              <tr>
				              	<th colspan="5" class="text-center">
				              		TOTAL
				              	</th>
				              	<th>
				              		<?php echo e(number_format($montant ,0, ',' , ' ')); ?> FCFA
				              	</th>
				              </tr>
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
		<div class="row">
			<a href="https://socoexim.ci">Se connecter</a>
		</div>
</body>
</html><?php /**PATH /home/damaro/Bureau/stockv1/resources/views/emails/bon.blade.php ENDPATH**/ ?>