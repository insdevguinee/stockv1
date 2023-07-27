

<?php $__env->startSection('title'); ?>
  Demande de permission
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
<div class="row">
    <div class="col-md-4">
        <a href="#" class="btn btn-primary" style="margin-bottom:10px;" data-target="#demande" data-toggle="modal">Faire une demande</a>
        
        <!-- Modal -->
        <div class="modal fade" id="demande" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Faire une demande</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <form action="<?php echo e(route('demande.new')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="container-fluid">
                           
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">
                                            Type de la demande
                                        </label>
                                        <select name="type" class="form-control">
                                            <option value="abscence">Absence</option>
                                            <option value="congé">Congé</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">
                                            Objet
                                        </label>
                                        <input type="text" name="titre" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">
                                            Raison
                                        </label>
                                        <textarea name="message" id="" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Date de debut</label>
                                        <input type="date" name="date_d" class="form-control" id="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Date de Retour</label>
                                        <input type="date" name="date_f" class="form-control" id="">
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        
        <script>
            $('#exampleModal').on('show.bs.modal', event => {
                var button = $(event.relatedTarget);
                var modal = $(this);
                // Use above variables to manipulate the DOM
                
            });
        </script>
        <ul>
            <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="?demande=<?php echo e($demande->id); ?>">
                        <?php echo e($demande->type); ?> - <?php echo e($demande->titre); ?> (<?php echo e($demande->status); ?>)
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="col-md-8">
        <div class="widget">
            <?php if($d != null): ?>
            <div class="widget-header transparent">
                <h2><?php echo e($d->type); ?><strong><?php echo e($d->titre); ?> </strong> <span class="badge badge-info"> <?php echo e($d->status); ?> </span> </h2>
            </div>
            <div class="widget-content padding">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-control">
                            <?php echo $d->message; ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-control">
                           DATE DEBUT :  <?php echo e($d->date_d); ?> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-control">
                            DATE FIN :  <?php echo e($d->date_f); ?> 
                        </div>
                    </div>
                </div>
                <?php if($d->status == 'en attente'): ?>
                    
                
                <div class="row mt-3">
                    <div class="col-md-12">
                        <form action="<?php echo e(route('demande.annuler',$d->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-xs btn-warning">
                                Annuler la demande
                            </button>
                        </form>
                    </div>
                 </div>
                 <?php endif; ?>
            </div>
             <small>creer le <i><?php echo e($d->created_at); ?></i></small>
            <?php endif; ?>
        </div>
        
        

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('personnels.profil._body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/personnels/profil/permission.blade.php ENDPATH**/ ?>