
<?php $__env->startSection('title'); ?>
Assignation
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
<style>
  .datepicker.dropdown-menu{
      z-index: 10000;
      top: 0;
  }
</style>
    <div class="row">
      <div class="col-md-12 portlets ui-sortable">
        <div class="panel panel-default widget">
          <div class="widget-header">
           
            <h2 class="text-center"><strong>Assigner un outil à une personne</strong> <a href="#" data-target="#assiger" data-toggle="modal" class="btn btn-sm btn-info pull-right">Assigner</a></h2>

          </div>
          <div class="panel-body">
             <div class="table-responsive">
              <table  id="datatables-1" data-sortable class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Categorie</th>
                    <th>Appareils</th>
                    <th>Qte/Reste</th>
                    <th>Numero de Serie / Code</th>
                    <th>Etat</th>
                    <th width="100">Utilisateurs</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $outils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                     $stock = $outil->qte - $outil->personnels()->wherePivot('selected',1)->count() ;
                    ?>
                  <tr>
                    <td><?php echo e(@$outil->categorie->name); ?></td>
                    <td><?php echo e($outil->name); ?></td>
                    <td><?php echo e($outil->qte.' / '.$stock); ?></td>
                    <td><?php echo e($outil->description); ?></td>
                    <td><?php echo e(($outil->etat==1)?'Fonctionne':'En panne'); ?></td>
                    <td>
                      
                      <?php echo e($outil->personnels->count()); ?>

                    </td>
                    <td>
                      <a href="<?php echo e(route('outils.show',$outil->id)); ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    </td>
                  </tr>
                 </form>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="assiger">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Fermer</span>
            </button>
            <h4 class="modal-title">Effectuer une assignation</h4>
          </div>
          <form action="<?php echo e(route('assignation.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
             

                  <div class="col-md-6">
                    <label for="">Appareil</label><br>
                    <select name="outil" class="form-control text-capitalize" style="width: 100%;">
                      <?php $__currentLoopData = $outils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($outil->personnels()->wherePivot("selected",1)->count() < $outil->qte): ?>
                      
                      <option value="<?php echo e($outil->id); ?>"><?php echo e($outil->name.' ('.$outil->description.')'); ?></option>
                      <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                    <div class="col-md-6 form-group">
                    <label for="">Utilisateur</label><br>
                    <select name="personnel" class="form-control text-capitalize" style="width: 100%;">
                      <?php $__currentLoopData = $personnels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personnel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($personnel->id); ?>">
                        <?php echo e("(".$personnel->matricule.') '.$personnel->name.' '.$personnel->prenoms); ?>

                      </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Assigner</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <!-- Page Specific JS Libraries -->
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>

  <script src="<?php echo e(URL::to('assets/js/pages/inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/jquery.inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
  <script>
       $('#active-assignation').addClass('active');
  </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/outils/assigner.blade.php ENDPATH**/ ?>