
<?php $__env->startSection('title'); ?>
Aide
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
<div class="row" style="margin-bottom: 10px;">
	<div class="col-md-6 col-md-offset-3" >
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Recherche" >
		</div>
	</div>
</div>
<div class="row">
<div class="col-md-4">

<div class="video">
	<div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="<?php echo e(URL::to('https://www.youtube.com/embed/59z3Ih6VaLc')); ?>"></iframe>
	</div>
	<h4 class="title text-center">Connexion & Deconnexion</h4>
</div>


</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/aides/index.blade.php ENDPATH**/ ?>