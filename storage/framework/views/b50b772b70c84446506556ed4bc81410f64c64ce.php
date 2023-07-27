

<?php $__env->startSection('title'); ?>
  Demandes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default  widget">
            <div class="panel-body">
                  <div class="table-responsive">
                    <table  id="datatables-1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Demande</th>
                                <th>Motif</th>
                                <th width="230px">Date</th>
                                <th>Demandeur</th>
                                <th>Etat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                            <tr>
                                <td scope="row"><?php echo e($demande->type); ?></td>
                                <td><?php echo e($demande->titre); ?></td>
                                <td><?php echo e($demande->message); ?></td>
                                <td><?php echo e($demande->date_d.' - '.$demande->date_f); ?></td>
                                <td>
                                    <a <?php if(@$demande->user->personnel_id): ?>  href="<?php echo e(route('personnels.show',@$demande->user->personnel_id)); ?>"  <?php endif; ?>>
                                        <?php echo e(@$demande->user->nom.' '.@$demande->user->prenom); ?>

                                    </a>
                                </td>
                                <td><?php echo e($demande->status); ?></td>
                                <td>
                                    
                                    <?php if($demande->status == "en attente"): ?>
                                        <form action="<?php echo e(route('demande.reponse',[$demande->id,'r'=>1])); ?>"  method="POST" onsubmit='return show_alert();'>
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-success btn-xs">Accorder</button>
                                        </form>
                                        <form action="<?php echo e(route('demande.reponse',[$demande->id,'r'=>0])); ?>" method="POST" onsubmit='return show_alert();'>
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-warning btn-xs">Refuser</button>
                                        </form>
                                    <?php endif; ?>

                                    <a href="<?php echo e(route('demande.pdf',$demande->id)); ?>" class="btn btn-default btn-xs">
                                        Télechargement
                                    </a>
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
       $('#active-demandes').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/demandes/index.blade.php ENDPATH**/ ?>