
<?php $__env->startSection('title'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
<style>
  .datepicker.dropdown-menu{
      z-index: 10000;
      top: 0;
  }
</style>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default widget">
          <div class="widget-header">
            <div class="additional-btn"  style="left:15px !important; right: none">
              <div class="date-input">
                <form action="" method="GET" style="margin-right: 80px;position: relative;" autocomplete="off">
                    <input type="text" placeholder="Date debut"  value="<?php echo e(@$_GET['datedebut']); ?>" name="datedebut" required class="datepicker-input">
                    <input type="text" placeholder="Date fin" value="<?php echo e(@$_GET['datefin']); ?>" name="datefin" required class="datepicker-input">
                    <button type="submit" class="btn-default btn" style="display: inline-block; position: absolute;top: 0;right: -35px">ok</button>
                 </form>
              </div>
            </div>
            <h2 class="text-center"><strong>Retour de Materiel</strong></h2>
            <div class="additional-btn">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_entremultiple')): ?>
           
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_entres')): ?>
            <button class="btn btn-success" data-target="#exampleModalLong" data-toggle="modal">Retour</button>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('download_entres')): ?>
            <a type="submit" href="<?php echo e(route('entre.exportXls',['min' => @$_GET['datedebut'],'max'=> @$_GET['datefin' ]])); ?>" class="btn btn-default  pull-right"  style="display: inline-block;margin-left: 7px;color:#fff"><i class="fa fa-download"></i> xls</a>
            <?php endif; ?>
            
            </div>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>N° BON</th>

                        <th>Produit</th>
                        <th>Date</th>
                        
                        <th>Quantite</th>
                        <th>Etat</th>
                        <th>Fournisseur</th>
                        <th>Details</th>
                        <th>Par</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $entres->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $transfert = ($entre->transfert_id != 0)?' <strong> (TRANSFERT)</strong>':'';
                        ?>
                     
                    <tr class="entre">
                       <td><?php echo $entre->nfacture.$transfert; ?></td>

                        <td><?php echo e(@$entre->materiel->name); ?></td>
                        <td><?php echo e(date('d/m/Y',strtotime($entre->date_ajout))); ?></td>
                        
                        <td><?php echo e($entre->quantite.' '.@$entre->materiel->unite.'(s)'); ?></td>
                        <td><?php echo e(($entre->pu==0)?'Fonctionne':'En panne'); ?></td>
                      
                        <td>
                          <?php if($entre->transfert_id == 0): ?>
                          <a href="<?php echo e(route('fournisseurs.show', @$entre->fournisseur->id)); ?>"><?php echo e(@$entre->fournisseur->name); ?></a>
                          <?php else: ?>
                          <?php echo e("Sous p ".\App\Chantier::findOrFail($entre->transfert_id)->name); ?>

                          <?php endif; ?>
                        </td>
                        <td><?php echo e($entre->motif); ?></td>
                        <td><?php echo e(@$entre->user->name); ?></td>
                        <td>
                          <div class="btn-group btn-group-xs">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_entres')): ?>
                           <a href="<?php echo e(route('entres.edit',$entre->id)); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           <?php endif; ?>
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_entres')): ?>
                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['entres.destroy', $entre->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

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
<div class="modal fade" id="exampleModalLong">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Retour de Matériel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form action="<?php echo e(route('entres.store')); ?>" method="POST" role="form" autocomplete="off">
              <?php echo csrf_field(); ?>
              <div class="form-group <?php if($errors->has('nfacture')): ?> has-error <?php endif; ?>">
                <label for="nfacture">Option de retour</label>
              
                <select name="nfacture"  id="numbon" style="width: 100%;" class="form-control">
                  <option value="retour">Retour</option>
                  
                </select>
              </div>
              <div class="form-group <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
              <label for="type_id">Materiel</label>
              <select  class="form-control" style="width: 100%;" name="materiel_id">
                <option value=""></option>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($type->id); ?>"><?php echo e($type->name.' ('.\App\Entre::where([['materiel_id','=',$type->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite') .')'); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group <?php if($errors->has('date')): ?> has-error <?php endif; ?>">
            <label for="date">Date</label>
            <input type="text" class="form-control datepicker-input" placeholder="aaaa-mm-jj"  name="date">
              <?php if($errors->has('date')): ?> <div class="help-block">
                 <?php echo e($errors->first('date')); ?>

              </div>
              <?php endif; ?>
              </div>

                <div class="form-group <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
                  <label for="quantite">Quantité</label>
                  <input type="number" step="0.01" class="form-control" name="quantite" data-mask="0" placeholder="0">
                  <?php if($errors->has('quantite')): ?> <div class="help-block">
                     <?php echo e($errors->first('quantite')); ?>

                  </div>
                <?php endif; ?>
                </div>

              <div class="form-group <?php if($errors->has('fourni')): ?> has-error <?php endif; ?>">
              <label for="fourni">Direction</label>
              
              <select name="fourni" style="width: 100%;" class="form-control">
                <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($fournisseur->id); ?>"><?php echo e($fournisseur->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php if($errors->has('fourni')): ?> 
              <div class="help-block">
                 <?php echo e($errors->first('fourni')); ?>

              </div>
              <?php endif; ?>
              </div>

              <div class="form-group">
              <label for="pu">Etat</label>
              <select name="pu" style="width: 100%;" class="form-control" >
                <option value="0" selected> Fonctionnel</option>
                <option value="1"> En panne</option>
              </select>
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" rows="5"></textarea>
              </div>
               <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-default">Enregistrer</button>
        </form>
        
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

  <script src="<?php echo e(URL::to('assets/js/pages/inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/jquery.inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
  <script>
      $(":input").inputmask();
      $(".numero").inputmask({"mask": "9999/9999"});
      $('#active-generation').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/stocks/entre2.blade.php ENDPATH**/ ?>