

<?php $__env->startSection('title'); ?>
  Documents
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>

<!-- Modal -->
<div class="modal fade" id="newmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Envoyer un document</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <form action="<?php echo e(route('document.send')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
            
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Titre du document</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control rows="10"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="">Document</label>
                                <input type="file" name="fichier" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label for="">Personnel</label>
                                <select name="personnel_id" class="form-control">
                                    <?php $__currentLoopData = $personnels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($p->id); ?>"><?php echo e('['.$p->matricule.'] - '.$p->nom.' '.$p->prenoms); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default  widget">
            <div class="widget-header">
                <h2 class="text-center"><strong>Liste des documents</strong></h2>
              
                <div class="additional-btn">
               <button class="btn btn-success pull-right" data-target="#newmodal" data-toggle="modal">Ajouter</button>
                </div>
              </div>
            <div class="panel-body">
                  <div class="table-responsive">
                    <table  id="datatables-1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Utilisateur</th>
                                <th>Ajouter le</th>
                                <th>Telecharger</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                            <tr>
                                <td scope="row"><?php echo e($document->name); ?></td>
                                <td><?php echo e($document->description); ?></td>
                                <td><?php echo e('['.@$document->personnel->matricule.'] - '.@$document->personnel->nom.' '.@$document->personnel->prenoms); ?></td>
                                <td><?php echo e($document->updated_at); ?></td>
                                <td> 
                                    <a target="_blank" href="<?php echo e(asset('storage/docs/'.$document->fichier)); ?>">Afficher</a>
                                </td>
                                <td>
                                    
                                    <?php echo Form::open(['method' => 'POST', 'route' => ['document.destroy', $document->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

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
       $('#active-documents').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/documents/index.blade.php ENDPATH**/ ?>