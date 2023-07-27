
<?php $__env->startSection('title'); ?>
Sorties
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
        <div class="panel panel-default  widget">
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
            <h2 class="text-center"><strong>Sortie de Marchandise</strong></h2>

            <div class="additional-btn">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_sortiemultiple')): ?>
            <a class="btn btn-success text-light" href="<?php echo e(route('sortie.multiple')); ?>" style="color: #fff;">Ajouter Plusieurs</a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_sorties')): ?>
            

            <?php endif; ?>
           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('download_sorties')): ?>
           <a type="submit" href="<?php echo e(route('sortie.exportXls',['min' => @$_GET['datedebut'],'max'=> @$_GET['datefin' ]])); ?>" class="btn btn-default  pull-right"  style="display: inline-block;margin-left: 7px;color:#fff"><i class="fa fa-download"></i> xls</a>
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
                              
                              <th>Utilisation</th>
                              <th>Par</th>

                              <th>Options</th>

                          </tr>
                      </thead>


                      <tbody>
                        <?php $__currentLoopData = $entres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php
                        $transfert = ($entre->transfert_id != 0)?' <strong> (TRANSFERT)</strong>':'';
                        ?>
                     

                          <tr class="entre">

                              <td><?php echo $entre->nfacture.$transfert; ?></td>

                              <td><?php echo e(@$entre->materiel->name); ?></td>
                              <td><?php echo e(date('d/m/Y',strtotime($entre->date_ajout))); ?></td>
                             
                              <td><?php echo e(-1*$entre->quantite.' '.@$entre->materiel->unite); ?></td>
                              

                              <td><?php echo e($entre->motif); ?>

                                <?php if($entre->transfert_id != 0 ): ?>
                                 <?php echo e("Chantier de ".@\App\Chantier::findOrFail($entre->transfert_id)->name); ?>

                                <?php endif; ?>

                              </td>
                              <td><?php echo e(@$entre->user->name); ?></td>
                              <td>
                          <div class="btn-group btn-group-xs">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('download_sorties')): ?>
                             <a href="<?php echo e(route('sortie.exportPdf',($entre->nfacture)?$entre->nfacture:0 )); ?>" title="Telecharger le bon" style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-info"><i class="fa fa-download"></i></a>
                             <?php endif; ?>
                             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_sorties')): ?>
                           <a href="<?php echo e(route('sorties.edit',$entre->id)); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           <?php endif; ?>
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_sorties')): ?>
                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['entres.destroy', $entre->id] ,'style'=>'display:inline-block !important;margin:0;float:right;margin-left:10px','onsubmit'=>'return show_alert();' ]); ?>

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

    <div class="modal fade" id="newItem">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Sortie de Marchandise</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo e(route('sorties.store')); ?>" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
                <?php echo csrf_field(); ?>
                <div class="form-group <?php if($errors->has('nfacture')): ?> has-error <?php endif; ?>">
                    <label for="nfacture">N°BON</label>
                    <input type="text" minlength="4" size="4" class="form-control num" required name ="nfacture" data-inputmask="'mask': '9999'" placeholder="0001" />
                    <?php if($errors->has('nfacture')): ?> <div class="help-block">
                       <?php echo e($errors->first('nfacture')); ?>

                    </div>
                    <?php endif; ?>
                  </div>

                <div class="form-group <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
                <label for="type_id">Materiel</label>
                <select class="form-control search_select" required name="materiel_id" style="width: 100%;">
                  <option value=""></option>
                  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($materiel->id); ?>"><?php echo $materiel->name .' ('. round ( \App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite'),2) .')'; ?> </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="form-group <?php if($errors->has('date')): ?> has-error <?php endif; ?>">
              <label for="date">Date</label>
             <input type="text" class="form-control datepicker-input" placeholder="aaaa/mm/jj"  name="date">
                <?php if($errors->has('date')): ?> <div class="help-block">
                   <?php echo e($errors->first('date')); ?>

                </div>
              <?php endif; ?>
            </div>

                <div class="form-group <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
                  <label for="quantite">Quantité sortant</label>
                  <input type="number" step="0.01" class="form-control" required name="quantite" value="<?php echo e(old('quantite')); ?>" data-mask="0" placeholder="0">
                  <?php if($errors->has('quantite')): ?> <div class="help-block">
                     <?php echo e($errors->first('quantite')); ?>

                  </div>
                <?php endif; ?>
                </div>

           

            <div class="form-group">
              <label for="motif">Utilisation</label>
              <textarea name="motif" id="motif" cols="30" rows="5" class="form-control"></textarea>
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
      $(".num").inputmask({"mask": "9999"});
       $('#active-sorties').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/stocks/sortie.blade.php ENDPATH**/ ?>