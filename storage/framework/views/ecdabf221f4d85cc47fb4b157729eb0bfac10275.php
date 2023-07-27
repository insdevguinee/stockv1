
<?php $__env->startSection('title'); ?>
Fournisseurs <?php echo e($fournisseur->name); ?>

<?php $__env->stopSection(); ?>
<?php $array[]= Null ?>

<?php $__env->startSection('contents'); ?>
    <div class="row">
      <h1 class="text-center text-capitalize"><?php echo e($fournisseur->name); ?></h1>
        <?php $__currentLoopData = $fournisseur->bons->whereIn('etat',['valider','terminer'])->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!in_array($bon->numerobon, $array)): ?>
      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header text-center">
             <h3 class="text-center"><?php echo e($bon->numerobon); ?>  
              <a style="padding: 2px 5px;font-size: 10px;" href="<?php echo e(route('fournisseur.exportPdf',[$fournisseur->id,$bon->id])); ?>" class="btn btn-info"><i class="fa fa-download"></i></a></h3>
              <small class="text-uppercase"><strong><?php echo e($bon->etat); ?></strong></small>
              <div class="clearfix"></div>
          </div>
          <div class="panel-body">
             <div class="row">
               <div class="col-md-6">
                <h4 class="text-center">Livrés</h4>
                 <div class="table-responsive">
                    <table class="table table-bordered mb-5" cellspacing="0" width="100%" style="margin-bottom: 15px">
                      <thead>
                          <tr>
                              <th>Produit</th>
                              <th>Date</th>
                              <th>Quantite</th>
                              <th>Details</th>
                              
                              <th>Reste</th>
                             
                          </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = collect(\App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id]])->get())->unique('materiel_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $en): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $mat = @$en->materiel_id;
                        $unite = @$en->materiel->unite;
                        $qte = \App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat]])->sum('quantite');
                        $qteBon = \App\Bon::where([['numerobon','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['chantier_id','=',session('chantier')],['materiel_id','=',$mat]])->sum('quantite');
                        $somme = 0;
                      ?>
                      <tr class="alert <?php echo e(($qte==$qteBon OR $qte >= $qteBon)?'alert-success':'alert-warning'); ?>">
                          <td><?php echo e(@$en->materiel->name); ?></td>
                          <td>
                            <?php $__currentLoopData = \App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat ]])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(date('d/m/Y',strtotime($m->date_ajout))); ?> <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </td>
                          <td>
                             <?php $__currentLoopData = \App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat ]])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($m->quantite.' '.@$m->materiel->unite.'(s)'); ?> <br>
                            <?php
                              $somme += $m->quantite;
                            ?>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <br>
                             <hr style="margin-top: -15px; margin-bottom: 0;">
                             <?php echo e("Total : ".$somme.' '.$unite.'(s)'); ?>

                          </td>
                          <td>
                            <?php echo e($en->motif); ?>

                          </td>
                          <td>
                            <?php echo e($qteBon - $qte); ?>

                          </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                  </div>
               </div>
               <div class="col-md-6">
                 <h4 class="text-center">Commandés</h4>
                 <div class="table-responsive">
             
                    <table class="table table-bordered mb-5" cellspacing="0" width="100%" style="margin-bottom: 15px">
                      <thead>
                          <tr>
                              <th>Produit</th>
                              <th>Date</th>
                              <th>Quantite</th>
                              
                              <th>Prix</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php $i=1;$montant = 0; ?>
                      <?php $__currentLoopData = \App\Bon::where([['numerobon','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['chantier_id','=',session('chantier')]])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $en): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e(@$en->materiel->name); ?></td>
                          <td><?php echo e(date('d/m/Y',strtotime($en->date_execution))); ?></td>
                          <td><?php echo e($en->quantite.' '.@$en->materiel->unite.'(s)'); ?></td>
                          <td><?php echo e(number_format($sum = $en->quantite * $en->cout,0,',',' ')); ?></td>
                          
                      </tr>
                      <?php $montant += $sum; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td colspan="3" class="text-right">Total</td>
                        <td><?php echo e(number_format($montant,0,',',' ')); ?></td>
                      </tr>
                  </tbody>
                </table>
            </div>
               </div>
             </div>
          </div>
        </div>
      </div>
       <?php endif; ?>
                <?php $array[]=$bon->numerobon ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/fournisseurs/show.blade.php ENDPATH**/ ?>