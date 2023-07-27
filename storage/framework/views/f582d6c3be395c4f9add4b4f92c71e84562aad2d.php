
<?php $__env->startSection('title'); ?>
Utilisateurs
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
    <div class="row">

      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header">
            
            <h2 class="text-center"><strong>Liste des Utilisateurs</strong></h2>

            <div class="additional-btn">
           <a href="<?php echo e(route('users.create')); ?>"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Username</th>
                              <th>Nom</th>
                              <th>Prenom</th>
                              <th>Email</th>
                              <th>Sites</th>
                              <th>Tel</th>
                              <th>Role</th>
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_users')): ?>
                              <th>Status</th>
                              <?php endif; ?>
                              <th></th>
                          </tr>
                      </thead>


                      <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr class="user">
                              <td><?php echo e($user->name); ?></td>
                              <td><?php echo e($user->nom); ?></td>
                              <td><?php echo e($user->prenom); ?></td>
                              <td><?php echo e($user->email); ?></td>
                              <td>
                                <?php $__currentLoopData = $user->chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <span class="badge badge-info">
                                    <?php echo e($chantier->name); ?>

                                  </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </td>
                              <td><?php echo e($user->phone); ?></td>
                              <td><?php echo e(@$user->roles()->first()->name); ?></td>
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_users')): ?>
                              <td>
                                <form action="<?php echo e(route('user.active',$user->id)); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                  

                                  
                                  <button class="btn btn-<?php echo e(($user->active==1) ? "success":""); ?> <?php echo e(($user->active==1) ? "active":""); ?>">Activer</button>
                                  <button type="submit" name="desactiver" value="0" class="btn btn-<?php echo e(($user->active==0) ? "danger":""); ?>  <?php echo e(($user->active==0) ? "active":""); ?>">Desactiver</button>
                                </div>

                                </form>
                              </td>
                              <?php endif; ?>
                              <td>
                                <div class="btn-group btn-group-xs"  style="width: 45px;">
                                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_users')): ?>
                                 <a href="<?php echo e(route('users.edit',$user->id)); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                 <?php endif; ?>
                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_users')): ?>
                                  <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

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
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <!-- Page Specific JS Libraries -->
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
  <script>
       $('#active-users').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/damaro/Bureau/stockv1/resources/views/users/table.blade.php ENDPATH**/ ?>