
<?php $__env->startSection('title'); ?>
Rapports
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<div class="row">
  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_rapports')): ?>
  <div class="col-md-12">
      <form action="<?php echo e(route('generate')); ?>" method="POST">
        <?php echo csrf_field(); ?>
      <button class="btn btn-info" type="submit"><span class="pull-right"> Generer le rapport de la semaine</button>
      </form>
  </div>
  <?php endif; ?>
</div>
<hr>
<div class="row">

  <?php $__currentLoopData = $rapports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rapport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <div class="col-md-3">
    <div class="panel panel-<?php echo e(($rapport->valider)? 'success' : 'warning'); ?> text-center">
    	<div class="panel-heading">
    		Rapport <strong> <?php echo e($rapport->name); ?></strong>
    	</div>
      <div class="panel-body">

      	<p ><?php echo e($rapport->debut." - ".$rapport->fin); ?> <br><small>Generé le <?php echo e($rapport->updated_at); ?></small></p>

	     <div>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('valide_rapports')): ?>

        <?php if(!$rapport->valider): ?>
        <form action="<?php echo e(route('rapports.update',$rapport->id)); ?>" method="POST" style="display: inline-block;">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <button class="btn btn-success" type="submit">Valider</button>
        </form>
	      <?php endif; ?>
      <?php endif; ?>
           <a href="#" class="btn btn-default" onclick="document.getElementById('downloadPDF<?php echo e($rapport->id); ?>').submit();">
             Voir le rapport
           </a>

	      	
	     </div>
          <form id="downloadPDF<?php echo e($rapport->id); ?>" action="<?php echo e(route('stock.pdf',[$rapport->id])); ?>" method="GET"  style="display: none;" autocomplete="off">
            <input type="number" name="rapport" value="<?php echo e($rapport->id); ?>" style="display: none;">
          </form>

      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>
       $('#active-rapports').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/rapports/index.blade.php ENDPATH**/ ?>