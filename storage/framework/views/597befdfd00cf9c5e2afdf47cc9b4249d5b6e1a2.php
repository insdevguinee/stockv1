

<?php $__env->startSection('title'); ?>
  Chantiers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
  <div class="row">

      <div class="col-md-8">
        <div class="panel">
          <div class="widget-header transparent">
             

          </div>
          <div class="panel-body widget-content">
             
            <div class="table-responsive">
              <table data-sortable class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                   <th>Nom</th>
                   <th>Description</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <?php $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                      <?php echo e($chantier->id); ?>

                    </td>
                   

                    <td>
                      <?php echo e($chantier->name); ?>

                    </td>
                    <td>
                      <?php echo e(@$chantier->description); ?>

                    </td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("edit_chantiers")): ?>
                        <form action="<?php echo e(route('chantiers.update',$chantier->id)); ?>" method="POST" style="display: inline-block;">
                          <?php echo method_field('PUT'); ?>
                          <?php echo csrf_field(); ?>
                          <input type="submit" value="archiver" class="btn btn-default  btn-sm" style="padding: 2px 5px;font-size: 10px;display: block;"name="archive">
                        </form>
                        
                        <a href="<?php echo e(route('chantiers.edit',[$chantier->id])); ?>" class="btn btn-info" title="Modifier"><i class="fa fa-edit"></i></a>
                        <?php endif; ?>
                       
                      </div>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                </table>
              </div>
                </div>
                <hr>
              </div>

          <div class="panel">
          <div class="panel-body widget-content">
            
            <div class="table-responsive">
              <table data-sortable class="table table-hover table-striped">
                <thead>
                  
                </thead>

                <tbody>
                 
                </tbody>
                </table>
              </div>
                </div>
                <hr>
              </div>

            </div>

          <div class="col-md-4">
            <div class="widget clearfix">
              <div class="widget-header transparent clearfix">
                <h2 class="text-center"><strong>Créer</strong> Zones de travail </h2>

              </div>
              <div class="widget-content padding clearfix">
                <div id="basic-form">
                  <form action="<?php echo e(route('chantiers.store')); ?>" method="POST" role="form">
                    <?php echo csrf_field(); ?>

                    <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                      <label>Designation</label>
                      <input type="text" class="form-control"  name="name">

                    </div>

                    <div class="form-group ">
                    <label>Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                  <button type="submit" class="btn btn-success pull-left">Enregistrer</button>
                </form>
              </div>
            </div>




          </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
       $('#active-chantiers').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/chantiers/chantier.blade.php ENDPATH**/ ?>