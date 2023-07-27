

<?php $__env->startSection('title'); ?>
  Documents
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>

<!-- Modal -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default  widget">
            <div class="widget-header">
                <h2 class="text-center"><strong>Liste des documents</strong></h2>
              </div>
            <div class="panel-body">
                  <div class="table-responsive">
                    <table  id="datatables-1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Ajouter le</th>
                                <th>Telecharger</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = Auth::user()->personnel->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td scope="row"><?php echo e($document->name); ?></td>
                                <td><?php echo e($document->desciption); ?></td>
                                <td><?php echo e($document->updated_at); ?></td>
                                <td> 
                                    <a target="_blank" href="<?php echo e(asset('storage/docs/'.$document->fichier)); ?>">Afficher</a>
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
       $('#active-documents').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('personnels.profil._body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/personnels/profil/documents.blade.php ENDPATH**/ ?>