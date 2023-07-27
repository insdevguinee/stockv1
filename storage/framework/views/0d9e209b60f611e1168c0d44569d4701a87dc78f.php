
<?php $__env->startSection('title'); ?>
Liste du personnel
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
    <div class="row">

      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header">
            
            <h2 class="text-center"><strong>Liste du personnel</strong></h2>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_personnels')): ?>
            <div class="additional-btn">
           <a href="<?php echo e(route('personnels.create')); ?>"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
            <?php endif; ?>
          </div>
          <div class="panel-body">
          <br>
            <div class="">
              
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0">
                  <thead>
            <tr>
              <th>Matricule</th>
              <th>Nom</th>
              <th>Prenoms</th>
              
              
              <th>Contact</th>
              
              
              <th>Site</th>
              
              <th>Poste</th>
              
              <th>Statut</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $personnels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personnel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td> <a href="#"> <?php echo e($personnel->matricule); ?> </a> </td>
                <td><?php echo e($personnel->nom); ?></td>

                <td><?php echo e($personnel->prenoms); ?></td>
                
                
                <td><?php echo e($personnel->contact); ?></td>
                
                
                <td>
                  <?php $__currentLoopData = $personnel->chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge badge-info">
                      <?php echo e($chantier->name); ?>

                    </span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td><?php echo e(@$personnel->departement->name); ?></td>
                <td><?php echo e($personnel->poste); ?></td>
                
                <td>
                  <div class="btn-group btn-group-xs"  style="width: 70px;">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_personnels')): ?>
                    <a href="<?php echo e(route('personnels.show',$personnel->id)); ?>" class="btn btn-info" style="padding: 2px 5px;font-size: 10px;">
                      <i class="fa fa-eye"></i>
                    </a>
                   <a href="<?php echo e(route('personnels.edit',$personnel->id)); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                   <?php endif; ?>
                   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_personnels')): ?>
                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['personnels.destroy', $personnel->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

                          <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        <?php echo Form::close(); ?>

                    <?php endif; ?>
                  </div>
                </td>
                <td>
                  <?php if(@$personnel->user->id): ?>
                  <i class="text-success fa fa-lock fa-2x"></i>    
                  <?php else: ?>
                  <form action="<?php echo e(route('user.personnel',$personnel->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-default btn-xssle" type="submit">
                      <i class="fa fa-unlock" aria-hidden="true"></i> Compte
                    </button>
                  </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
              </table>
             <?php echo e($personnels->links()); ?>

            </div>
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
       $('#active-personnels').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/personnels/index.blade.php ENDPATH**/ ?>