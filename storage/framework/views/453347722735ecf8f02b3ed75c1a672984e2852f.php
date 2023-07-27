
<?php $__env->startSection('title'); ?>
Demandes
<?php $__env->stopSection(); ?>
 <?php $array[]= Null ?>

<?php $__env->startSection('contents'); ?>
    <div class="row">

      <div class="col-md-12">
        <div class="panel panel-default  widget">
          <div class="widget-header">
            
            <h2 class="text-center"><strong>Liste des demandes</strong></h2>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_bons')): ?>
            <div class="additional-btn">
             <a href="<?php echo e(route('bons.create')); ?>"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
            <?php endif; ?>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              
              <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                            <th>BON</th>
                            <th>NUMERO BON</th>
                            <th>Date execution</th>
                            <th>Utilisateur</th>
                            <th>Materiel</th>
                            <th>Site</th>
                            <th width="100px">Etat</th>
                            <th>Direction</th>
                            
                            <th></th>
                            
                          </tr>
                      </thead>


                      <tbody>
                        <?php $__currentLoopData = $bons->unique('numero'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                          <tr class="bon">

                              <td class="<?php echo e($bon->etat); ?>"><?php echo e($bon->name); ?></td>
                              <td><?php echo e($bon->numerobon); ?></td>
                              <td> <?php echo e($bon->date_execution); ?></td>
                              <td>Commande de : <?php echo e(@$bon->user->name); ?> <br> Traité par : <?php echo e(@$bon->manager->name); ?></td>
                              <td>
                                <table class="table table-bordered">
                                  <tbody>
                                      <?php $__currentLoopData = \App\bon::where('numero',$bon->numero)->where('chantier_id',session('chantier'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                        <td><?php echo e(@$t->materiel->name); ?></td>
                                        <td><?php echo e(@$t->quantite); ?></td>
                                      </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                              </td>
                              <td><?php echo e(@$bon->chantier->name); ?></td>
                              <td>
                                 <span class="badge-primary badge <?php echo e($bon->etat); ?>"> <?php echo e($bon->etat); ?></span>
                                 <hr>
                                <?php if($bon->etat == "attente" ): ?>

                                  
                                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('valide_bons')): ?>
                                   <?php echo Form::open(['method' => 'PUT', 'route' => ['bons.update', $bon->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

                                  

                                  <input type="submit" value="valider" class="btn btn-success btn-xs"  name="etat">
                                  <input type="submit" value="annuler" class="btn btn-danger btn-xs"  name="etat">
                                  <?php echo Form::close(); ?>

                                  <?php endif; ?>

                                  <?php else: ?>

                                    <?php if($bon->etat == "valider" ): ?>
                                      <?php if($bon->etat != 'terminer'): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('traiter_bons')): ?>
                                          <a href="<?php echo e(route('bon.traiter',$bon->id)); ?>" class="btn btn-success" >
                                            Traiter <i class="fa fa-arrow-right"></i>
                                          </a>
                                          
                                    <?php echo Form::open(['method' => 'PUT', 'route' => ['bons.update', $bon->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>


                                  <input type="submit" value="terminer" class="btn btn-default" name="etat">
                                  <?php echo Form::close(); ?>


                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                  <?php endif; ?>
                              </td>
                              <td><a href="<?php echo e(route('fournisseurs.show', @$bon->fournisseur->id)); ?>"><?php echo e(@$bon->fournisseur->name); ?></a></td>
                              
                              <td>
                                <a href="<?php echo e(route('bons.show',$bon->id)); ?>" class="btn btn-info btn-xs" >
                                  <i class="fa fa-eye"></i>
                                </a>

                                <?php if($bon->etat != "terminer" AND $bon->etat != "valider" ): ?>
                                  <?php if($bon->etat == 'attente' OR Auth::user()->roles()->first()->name == 'admin' OR $bon->etat =="annuler"): ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_bons')): ?>
                                    <a href="<?php echo e(route('bons.edit',$bon->id)); ?>" class="btn btn-outline-info btn-xs" >
                                      <i class="fa fa-edit"></i>
                                    </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_bons')): ?>
                                    <div class="btn-group ">
                                     
                                      <?php echo Form::open(['method' => 'DELETE', 'route' => ['bons.destroy', $bon->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

                                            <button  type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                          <?php echo Form::close(); ?>

                                    </div>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('download_bons')): ?>
                                <?php if($bon->etat == 'valider' OR $bon->etat == 'terminer'): ?>
                                  <a href="<?php echo e(route('bon.pdf',$bon->id)); ?>" title="Telecharger le bon"  class="btn btn-default btn-xs"><i class="fa fa-download"></i></a>
                                <?php endif; ?>
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
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <!-- Page Specific JS Libraries -->
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
  <script>
    $(document).ready(function() {
        $('#datatables').DataTable( {
            "order": [[ 1, "desc" ]]
        } );
    } );

        $('#active-bons').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<style>
  .attente{
    background-color: orange;
    color: #fff;
  }
  .annuler{
    background-color: red;
    color: #fff;
  }
  .valider{
    background-color: green;
    color: #fff;
  }
  .terminer{
    background-color: gray;
    color: #fff;
  }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/bons/list.blade.php ENDPATH**/ ?>