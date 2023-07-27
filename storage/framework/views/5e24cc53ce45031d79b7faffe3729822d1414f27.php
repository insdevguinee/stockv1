

<?php $__env->startSection('title'); ?>
  Modification <?php echo e($outil->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
			  <div class="widget clearfix">
			    <div class="widget-header transparent clearfix">
			      <h2 class="text-center"><strong>Modification</strong> <?php echo e($outil->name); ?></h2>

			    </div>
			    <div class="widget-content padding clearfix">
			      <div id="basic-form">
			        <form action="<?php echo e(route('outils.update',$outil->id)); ?>" method="POST" role="form">
			        <?php echo csrf_field(); ?>
			        <?php echo method_field('PUT'); ?>

			        <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
			          <label>Nom</label>
			          <input type="text" class="form-control"  name="name" value="<?php echo e($outil->name); ?>">

			        </div>

			         <div class="form-group <?php if($errors->has('qte')): ?> has-error <?php endif; ?>">
			          <label>Quantité</label>
			          <input type="number" class="form-control"  name="qte" value="<?php echo e($outil->qte); ?>">

			        </div>


			        <div class="form-group ">
			        <label>Etat</label>
			        <select name="etat" class="form-control">
			        	<option value="0" <?php echo e(($outil->etat == 0) ? 'selected':''); ?>>En panne</option>
			        	<option value="1" <?php echo e(($outil->etat == 1) ? 'selected':''); ?>>Fonctionne</option>
			        </select>
			        </div>
			             <div class="form-group ">
				        <label>Categorie</label>
				        <select name="categorie" id="categorie" class="form-control">
				          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				            <option value="<?php echo e($categorie->id); ?>" <?php echo e(($outil->categorie_id == $categorie->id) ? 'selected':""); ?>><?php echo e($categorie->name); ?></option>
				          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				        </select>
				        </div>

			        <div class="form-group">
			        	<label for="">Nuemro de Serie</label>
			        	<textarea name="description" class="form-control"><?php echo e($outil->description); ?></textarea>
			        </div>
			      <button type="submit" class="btn btn-success pull-left">Modifier</button>
			    </form>
			  </div>
			</div>
          </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
       $('#active-outils').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/outils/edit.blade.php ENDPATH**/ ?>