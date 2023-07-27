

<?php $__env->startSection('title'); ?>
<?php echo e($bon->numero); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>

<div class="" style="background-color: #fff;padding: 20px;">
	<div class="row">
			<div class="col-md-6 float-left">
				<img src="<?php echo e(URL::to('assets/img/logo.png')); ?>" style="height: 70px;" alt="Logo">
				<p class="text-justify"></p>
			</div>
		</div>
		<p class="text-right">Abidjan le <?php echo e(explode('00:00',\Carbon\Carbon::parse($bon->date_execution,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]); ?></p>
		<h4 class="text-center text-uppercase" style="margin-top: 20px;"><u><strong>BON DE COMMANDE N° </strong></u><?php echo e($bon->numerobon); ?></h4>
		<div class="row " style="margin-top: 20px;">
			<div class="col-md-12">
				<h5 class="text-uppercase"><u><strong>OBJET</strong> : <?php echo e($bon->name); ?></u> <br></h5>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				<h5 class="text-uppercase"><u><strong>Direction :</strong> <?php echo e(@$bon->fournisseur->name); ?></u></h5>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				<h5 class="text-uppercase"><u><strong>Site</strong> : <?php echo e(@$bon->chantier->name); ?></u></h5>
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
		
		<?php
		$bon = \App\Bon::where('numero',$bon->numero)->first();
		?>
		 	<?php echo e($bon->etat); ?>

            <?php if($bon->etat == "attente" ): ?>

              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('valide_bons')): ?>
               <?php echo Form::open(['method' => 'PUT', 'route' => ['bons.update', $bon->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>


              <input type="submit" value="valider" class="btn btn-success" name="etat">
              <input type="submit" value="annuler" class="btn btn-danger" name="etat">
              <?php echo Form::close(); ?>

              <?php endif; ?>

              <?php else: ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('traiter_bons')): ?>
                <?php if($bon->etat == "valider" ): ?>
                  <a href="<?php echo e(route('bon.traiter',$bon->id)); ?>" class="btn btn-success" style="padding: 2px 5px;font-size: 10px;">
                    Traiter <i class="fa fa-arrow-right"></i>
                  </a>
                <?php endif; ?>
              <?php endif; ?>
              <?php endif; ?>
             <?php if($bon->etat == 'attente' OR Auth::user()->roles()->first()->name == 'admin'): ?>
             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_bons')): ?>
            	<a href="<?php echo e(route('bons.edit',$bon->id)); ?>" class="btn btn-info">
              		<i class="fa fa-edit"></i> Modifier
            	</a>
             <?php endif; ?>

            <?php endif; ?>
		 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('download_bons')): ?>
        <?php if($bon->etat == 'valider'): ?>
          <a href="<?php echo e(route('bon.pdf',$bon->id)); ?>" title="Telecharger le bon" style="padding: 2px 5px;margin-top: 50px;" type="submit" class="btn btn-default">Telecharger le bon</a>
        <?php endif; ?>
        <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <script>
      $('#active-bons').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/bons/view.blade.php ENDPATH**/ ?>