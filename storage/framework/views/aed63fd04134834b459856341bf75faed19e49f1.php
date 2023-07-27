

<?php $__env->startSection('title'); ?>
  Modification <?php echo e($categorie->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
			  <div class="widget clearfix">
			    <div class="widget-header transparent clearfix">
			      <h2 class="text-center"><strong>Modification</strong> <?php echo e($categorie->name); ?></h2>

			    </div>
			    <div class="widget-content padding clearfix">
			      <div id="basic-form">
			        <form action="<?php echo e(route('categories.update',$categorie->id)); ?>" method="POST" role="form">
			        <?php echo csrf_field(); ?>
			        <?php echo method_field('PUT'); ?>

			            <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
			              <label>Nom</label>
			              <input type="text" class="form-control"  name="name" value="<?php echo e($categorie->name); ?>">

			            </div>
			               <div class="form-group">
				              <select name="type" class="form-control">
				                <option value="0" <?php echo e(($categorie->type == 0 ) ? 'selected':''); ?>>Pour les materiaux</option>
				                <option value="1" <?php echo e(($categorie->type == 1 ) ? 'selected':''); ?>>Outils pour le travail</option>
				              </select>
				            </div>
			            <div class="form-group ">
			            <label>Description</label>
			            <textarea name="description" class="form-control" cols="30" rows="10"><?php echo e($categorie->description); ?></textarea>
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
    $('#active-categories').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/materiels/edit_cat.blade.php ENDPATH**/ ?>