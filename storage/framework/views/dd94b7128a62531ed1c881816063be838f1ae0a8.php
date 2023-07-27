

<?php $__env->startSection('title'); ?>
  Modification <?php echo e($materiel->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
			  <div class="widget clearfix">
			    <div class="widget-header transparent clearfix">
			      <h2 class="text-center"><strong>Modification</strong> <?php echo e($materiel->name); ?></h2>

			    </div>
			    <div class="widget-content padding clearfix">
			      <div id="basic-form">
			        <form action="<?php echo e(route('materiels.update',$materiel->id)); ?>" method="POST" role="form">
			        <?php echo csrf_field(); ?>
			        <?php echo method_field('PUT'); ?>

			        <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
			          <label>Designation</label>
			          <input type="text" class="form-control"  name="name" value="<?php echo e($materiel->name); ?>">

			        </div>

			        <div class="form-group ">
			        <label>Categorie</label>
			        <select name="categorie" id="categorie" class="form-control">
			          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <option value="<?php echo e($categorie->id); ?>" <?php echo e(($materiel->categorie_id == $categorie->id) ? 'selected':""); ?>><?php echo e($categorie->name); ?></option>
			          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </select>

			        <div class="form-group ">
			        <label>Unité</label>
			          <input type="text" class="form-control"  name="unite"  value="<?php echo e($materiel->unite); ?>">
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
       $('#active-entres-table').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/materiels/edit.blade.php ENDPATH**/ ?>