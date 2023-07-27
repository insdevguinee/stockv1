
<?php $__env->startSection('title'); ?>
Fournisseurs
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
    <div class="row">

      <div class="col-md-8 col-md-offset-2">
        <div class="widget  panel panel-default">
          <div class="widget-header">
            <h2 class="text-center"><strong>Modification <?php echo e($fournisseur->name); ?></strong></h2>
          </div>
          <div class="panel-body">
            <form action="<?php echo e(route('fournisseurs.update',[$fournisseur->id])); ?>" method="POST" role="form" autocomplete="off" class="pb-3">
                        <?php echo method_field('PUT'); ?>
                        <?php echo csrf_field(); ?>

                        <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                          <label for="name">Entreprise</label>
                          <input type="text" class="form-control" name ="name" value="<?php echo e($fournisseur->name); ?>" />
                          <?php if($errors->has('name')): ?> <div class="help-block">
                             <?php echo e($errors->first('name')); ?>

                          </div>
                          <?php endif; ?>
                        </div>
                        <div class="form-group">
                          <label for="pays">Pays</label>
                          <select name="pays_id" id="pays" class="form-control">
                            <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="form-group <?php if($errors->has('ville')): ?> has-error <?php endif; ?>">
                          <label for="name">Ville</label>
                          <input type="text" class="form-control" value="<?php echo e($fournisseur->ville); ?>" name ="ville"/>
                          <?php if($errors->has('ville')): ?> <div class="help-block">
                             <?php echo e($errors->first('ville')); ?>

                          </div>
                          <?php endif; ?>
                        </div>
                        <div class="form-group <?php if($errors->has('contact')): ?> has-error <?php endif; ?>">
                          <label for="contact">Contact</label>
                          <input type="text" class="form-control" value="<?php echo e($fournisseur->contact); ?>" name="contact"/>
                          <?php if($errors->has('contact')): ?> <div class="help-block">
                             <?php echo e($errors->first('contact')); ?>

                          </div>
                          <?php endif; ?>
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;margin-left: 20px;">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                      <button type="submit" class="btn btn-default">Enregistrer</button>
                    </div>
                  </form>
          </div>
        </div>
      </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <!-- Page Specific JS Libraries -->
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
  <script>
       $('#active-fournisseurs').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/fournisseurs/edit.blade.php ENDPATH**/ ?>