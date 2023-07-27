<h4 class="text-center text-uppercase" style="margin-top: 20px;"><u><strong><?php echo e(@$categorie->name); ?></span></strong></u></h4>
      <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0">
          <thead>
              <tr>
                  <th >Designation</th>
                  <th >Qte i</th>
                  <th >Unité</th>
                  <th class="text-center">Reception
                    <table class="table table-bordered">
                          <tr>
                            <td>N°S</td>
                            <td>Date</td>
                            <td>N°BON</td>
                            <td>Qte</td>
                          </tr>
                    </table>
                  </th>
                  <th >Qte Re Totale</th>
                  <th class="text-center">Consommation
                    <table class=" table-bordered table">
                          <tr>
                            <td>N°Sem</td>
                            <td>Date</td>
                            <td>Qte</td>
                          </tr>
                    </table>
                  </th>
                  <th>Cons. Totale</th>
                  <th>Stock</th>
              </tr>
          </thead>
          
          <tbody>
            <?php $__currentLoopData = $categorie->materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php

              $stockini =  $materiel->entres()->whereDate('date_ajout','<',$min)->where([['chantier_id','=',session('chantier')]])->sum('quantite');

                $qteSortie = -$materiel->entreDate($min,$max)->where([['mode','=','sortie'],['chantier_id','=',session('chantier')]])->sum('quantite');

                $qteEntre = $materiel->entreDate($min,$max)->where([['mode','=','entre'],['chantier_id','=',session('chantier')]])->sum('quantite') + $stockini ;
                $stock = $qteEntre - $qteSortie;
              ?>
              <?php if($qteEntre != 0 AND $stockini != 0 ): ?>
              <tr class="entre">
                  <td class="middle"><?php echo e(@$materiel->name); ?></td>
                  <td class="middle">
                   
                    <?php echo e($stockini); ?>


                  </td>
                  <td class="middle"> <?php echo e(@$materiel->unite); ?> </td>

                  <td>
                    <table  class="table table-bordered table-hover" style="background: transparent;">
                      <tbody>
                        <?php $__currentLoopData = $materiel->entreDate($min,$max)->where([['mode','=','entre'],['chantier_id','=',session('chantier')]])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                          <?php if(isset($_GET['semaine'])): ?>
                          <?php if(@$_GET['semaine']== \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth ): ?>
                          <tr>
                            <td class="text-center"><?php echo e(\Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth); ?></td>
                            <td class="text-center">
                              <?php echo e(date('d/m/Y',strtotime($entre->date_ajout))); ?>

                            </td>
                            <td class="text-center"><?php echo e($entre->nfacture); ?></td>
                            <td class="text-center"><?php echo e($entre->quantite); ?></td>
                          </tr>

                          <?php endif; ?>
                          <?php else: ?>
                          <tr>
                            <td class="text-center"><?php echo e(\Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth); ?></td>
                            <td class="text-center">
                              <?php echo e(date('d/m/Y',strtotime($entre->date_ajout))); ?>

                            </td>
                            <td class="text-center"><?php echo e($entre->nfacture); ?></td>
                            <td class="text-center"><?php echo e($entre->quantite); ?></td>
                          </tr>
                          <?php endif; ?>
                          
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </td>
                   <td class="middle"><?php echo e($qteEntre); ?></td>
                   <td>
                     <table class="table table-bordered table-hover" style="background: transparent;">
                       <tbody>
                         <?php $__currentLoopData = $materiel->entreDate($min,$max)->where([['mode','=','sortie'],['chantier_id','=',session('chantier')]])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(isset($_GET['semaine'])): ?>
                             <?php if(@$_GET['semaine']== \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth ): ?>
                            <tr title="<?php echo e($entre->motif); ?>">
                              <td class="text-center"><?php echo e(\Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth); ?></td>
                              <td class="text-center">
                                <?php echo e(date('d/m/Y',strtotime($entre->date_ajout))); ?>

                              </td>
                              <td class="text-center"><?php echo e(-$entre->quantite); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php else: ?>
                             <tr title="<?php echo e($entre->motif); ?>">
                              <td class="text-center"><?php echo e(\Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth); ?></td>
                              <td class="text-center">
                                <?php echo e(date('d/m/Y',strtotime($entre->date_ajout))); ?>

                              </td>
                              <td class="text-center"><?php echo e(-$entre->quantite); ?></td>
                            </tr>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </tbody>
                     </table>
                   </td>
                   <td class="middle"><?php echo e($qteSortie); ?></td>
                   <td class="middle"
                    <?php if($stock > $minStock ): ?> style="background: #c8ffc8;<?php endif; ?> " <?php if($stock <= $minStock): ?> style="background: #ffc8c8; <?php endif; ?> "
                   ><strong><?php echo e($stock); ?></strong></td>
              </tr>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>
<?php /**PATH /home/damaro/Bureau/stockv1/resources/views/partials/rapportPdfexport.blade.php ENDPATH**/ ?>