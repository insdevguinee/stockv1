
<?php $__env->startSection('title'); ?>
Outil <?php echo e($outil->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <div class="row">
      <h1 class="text-center text-capitalize"><?php echo e($outil->name); ?></h1>
      <p class="text-center"><?php echo e(($outil->etat==1)?'Fonctionne':'En panne'); ?></p>
       <div class="col-md-8">
          <div class="panel panel-default widget">
            <div class="widget-header">
               <h2>Utilisateurs  </h2>
            </div>
            <div class="panel-body widget-content">
                <div class="table-responsive">
                  <table  id="datatables-1" data-sortable class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prenoms</th>
                        <th>Contact</th>
                        <th>Date utilisée</th>
                        <th>Statut</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $outil->personnels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personnel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td> <a href="#"> <?php echo e($personnel->matricule); ?> </a> </td>
                          <td><?php echo e($personnel->nom); ?></td>
                          
                          <td><?php echo e($personnel->prenoms); ?></td>
                          
                          <td><?php echo e($personnel->contact); ?></td>
                          <td>
                            <?php echo e($personnel->pivot->created_at); ?>

                          </td>
                          <td>
                            <?php if($personnel->pivot->selected): ?>
                                
                            <form action="<?php echo e(route('assignation.update',[$outil->id])); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                              <?php echo method_field('PUT'); ?>
                              <span class="badge badge-info"> Retirer 
                                <input type="submit" name="retirer" class="btn btn-xs btn-danger" value="x">
                                <input type="number" name="personnel" value="<?php echo e($personnel->id); ?>" style="display: none">
                                <input type="number" name="pivotid" value="<?php echo e($personnel->pivot->id); ?>" style="display: none">
                              </span>
                            </form>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
        </div>
      <div class="col-md-4">
        <div class="panel panel-default widget">
            <div class="widget-header">
               <h2>Informations</h2>
            </div>
            <div class="panel-body widget-content">
              <div class="card" >
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Nom : </strong><?php echo e($outil->name); ?></li>
                  <li class="list-group-item"><strong>Description : </strong><?php echo e($outil->description); ?></li>
                  <li class="list-group-item"><strong>Etat : </strong><?php echo e(($outil->etat==1)?'Fonctionne':'En panne'); ?></li>
                  <li class="list-group-item"><strong>Quantité : </strong><?php echo e($outil->qte); ?></li>
                  <li class="list-group-item"><strong>En stock : </strong><?php echo e($outil->qte - @$outil->personnels()->wherePivot('selected',1)->count()); ?></li>
                </ul>
              </div>
            </div>
            <div class="panel-footer">
              <a href="<?php echo e(route('outils.edit',$outil->id)); ?>" class="btn btn-default">Modifier</a>
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
       $('#active-outils').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/outils/show.blade.php ENDPATH**/ ?>