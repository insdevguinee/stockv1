
<?php $__env->startSection('title'); ?>
Fournisseurs
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
    <div class="row">

      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header">
            
            <h2 class="text-center"><strong>Liste des Direction</strong></h2>

            <div class="additional-btn">
           <a href="#" data-toggle="modal" data-target="#addfournisseur"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Pays</th>
                              <th>Ville</th>
                              <th>Contact</th>
                              <th width="120px"></th>
                          </tr>
                      </thead>


                      <tbody>
                        <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr class="fournisseur">
                              <td><?php echo e($fournisseur->name); ?></td>
                              <td><?php echo e(@$fournisseur->pays->name); ?></td>
                              <td><?php echo e($fournisseur->ville); ?></td>
                              <td><?php echo e($fournisseur->contact); ?></td>
                              <td>
                                <div class="btn-group btn-group-xs"  style="width: 100px;">
                                  <a href="<?php echo e(route('fournisseurs.show',$fournisseur->id)); ?>" class="btn btn-info">
                                    <i class="fa fa-eye"></i> Etat
                                  </a>
                                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_fournisseurs')): ?>
                                 <a href="<?php echo e(route('fournisseurs.edit',$fournisseur->id)); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                 <?php endif; ?>
                                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_fournisseurs')): ?>
                                  <?php echo Form::open(['method' => 'DELETE', 'route' => ['fournisseurs.destroy', $fournisseur->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

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
<!-- Modal -->
<div class="modal fade" id="addfournisseur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Entrée de Marchandise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="basic-form">
                  <form action="<?php echo e(route('fournisseurs.store')); ?>" method="POST" role="form" autocomplete="off">
                        <?php echo csrf_field(); ?>

                        <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                          <label for="name">Entreprise</label>
                          <input type="text" class="form-control" name ="name"/>
                          <?php if($errors->has('name')): ?> <div class="help-block">
                             <?php echo e($errors->first('name')); ?>

                          </div>
                          <?php endif; ?>
                        </div>
                        <div class="form-group">
                          <label for="pays">Pays</label>
                          <select name="pays_id" id="pays" style="width: 100%;" class="form-control">
                            <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($p->id); ?>" <?php echo e($p->alpha2 =="CI" ? "selected":""); ?>><?php echo e($p->nom_fr_fr); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="form-group <?php if($errors->has('ville')): ?> has-error <?php endif; ?>">
                          <label for="name">Ville</label>
                          <input type="text" class="form-control" name ="ville"/>
                          <?php if($errors->has('ville')): ?> <div class="help-block">
                             <?php echo e($errors->first('ville')); ?>

                          </div>
                          <?php endif; ?>
                        </div>
                        <div class="form-group <?php if($errors->has('contact')): ?> has-error <?php endif; ?>">
                          <label for="contact">Contact</label>
                          <input type="text" class="form-control" name="contact"/>
                          <?php if($errors->has('contact')): ?> <div class="help-block">
                             <?php echo e($errors->first('contact')); ?>

                          </div>
                          <?php endif; ?>
                        </div>


                  
                    
                    </div>
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-default">Enregistrer</button>
                  </form>
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
       $('#active-fournisseurs').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/fournisseurs/index.blade.php ENDPATH**/ ?>