
<?php $__env->startSection('title'); ?>
Fiche Evaluation
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
    <div class="row">

      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header">
            
            <h2 class="text-center"><strong>Liste </strong></h2>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_personnels')): ?>
            <div class="additional-btn">
           <a href="<?php echo e(route('fiches.create')); ?>"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
            <?php endif; ?>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
                <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                        <tr>
                            <th>Année</th>
                            <th>Nom</th>
                            <th>Notation</th>
                            <th>Nbre Evaluateurs</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $fiches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fiche): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($fiche->annee); ?></td>
                        <td><?php echo e($fiche->name); ?></td>
                        <td>sur <?php echo e($fiche->notation); ?></td>
                        <td><?php echo e(@$fiche->evaluateurs->count()); ?></td>
                        <td>
                            <a href="<?php echo e(route('fiches.show',$fiche->id)); ?>" class="btn btn-default">Consulter</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary">Evaluer le personnel</a>
                        </td>
                        <td>
                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['fiches.destroy', $fiche->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

                          <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        <?php echo Form::close(); ?>

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
       $('#active-fiches').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/fiches/fiche_index.blade.php ENDPATH**/ ?>