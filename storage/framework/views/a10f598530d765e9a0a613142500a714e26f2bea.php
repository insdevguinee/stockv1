

<?php $__env->startSection('title'); ?>
  Materiels
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
  <div class="row">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_materiels')): ?>
      <div class="col-md-8">
      <?php else: ?>
      <div class="col-md-12">
      <?php endif; ?>
        <div class="panel">
          <div class="widget-header transparent">
             

          </div>
          <div class="panel-body widget-content">
            
            <div class="table-responsive">
              <table  id="datatables-1" data-sortable class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                   <th>Nom</th>
                   <th>Categorie</th>
                   <th>Unité</th>
                   <th>Code i</th>
                    <th>Crée</th>
                    <th> <span class="badge-primary badge" ><?php echo e(@$types->count()); ?></span></th>
                  </tr>
                </thead>

                <tbody>
                  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                      <?php echo e($type->id); ?>

                    </td>
                   

                    <td>
                      <?php echo e($type->name); ?>

                    </td>
                    <td>
                      <?php echo e(@$type->categorie->name); ?>

                    </td>
                    <td>
                      <?php echo e($type->unite); ?>

                    </td>
                    <td>
                      
                    </td>
                    <td>
                      <?php echo e(date('d/m/Y',strtotime($type->updated_at))); ?>

                    </td>
                    <td>
                      <div class="btn-group btn-group-xs">
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_materiels')): ?>
                           <a href="<?php echo e(route('materiels.edit',$type->id)); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_materiels')): ?>
                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['materiels.destroy', $type->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

                                  <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                <?php echo Form::close(); ?>

                        <?php endif; ?>
                        </div>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                </table>
              </div>
                </div>
              </div>
            </div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_materiels')): ?>
<div class="col-md-4">
  <div class="widget clearfix">
    <div class="widget-header transparent clearfix">
      <h2 class="text-center"><strong>Ajouter</strong> un materiel</h2>

    </div>
    <div class="widget-content padding clearfix">
      <div id="basic-form">
        <form action="<?php echo e(route('materiels.store')); ?>" method="POST" role="form" onsubmit='return show_alert();'>
        <?php echo csrf_field(); ?>

        <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
          <label>Designation</label>
          <input type="text" class="form-control"  name="name">

        </div>

        <div class="form-group ">
        <label>Categorie</label>
        <select name="categorie" id="categorie" class="form-control">
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($categorie->id); ?>"><?php echo e($categorie->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <div class="form-group ">
        <label>Unité</label>
          <input type="text" class="form-control"  name="unite">
        </div>
        <div class="form-group ">
        <label>Code</label>
          <input type="text" class="form-control"  name="unite">
        </div>
      <button type="submit" class="btn btn-success pull-left">Enregistrer</button>
    </form>
  </div>
</div>




          </div>
    </div>
    <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>

   <script src="<?php echo e(URL::to('assets/js/pages/inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/jquery.inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
<script>
       $('#active-entres-table').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/damaro/Bureau/stockv1/resources/views/materiels/table.blade.php ENDPATH**/ ?>