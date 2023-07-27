

<?php $__env->startSection('title'); ?>
  Transfert de materiel
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
            <div class="alert alert-info">
                <strong>Info</strong>
                <p>Pour tous les transferts de stock entre site de stock, le numéro de Bon en réception pour le site de destination  est 0000/2023 et le fournisseur est le site de départ.</p>
            </div>
               
                    <a class="btn btn-success text-light " href="<?php echo e(route('transfert.multiple')); ?>" style="color: #fff;margin-bottom:10px">Transfert Plusieurs</a>
                
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>Transfert</strong>  de Materiel</h2>
                </div>

                <div class="widget-content padding">

                    <div id="basic-form">
                        <form action="<?php echo e(route('transferts.store')); ?>" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
                    <?php echo csrf_field(); ?>
                    <div class="form-group <?php if($errors->has('nfacture')): ?> has-error <?php endif; ?>">
                      <label for="nfacture">N°BON DE SORTIE ( Dernier numero : <?php echo e(@\App\Entre::sortie()->orderBy('created_at','desc')->first()->nfacture); ?> )</label>
                      <input type="text" class="form-control numero" name ="nfacture" placeholder="<?php echo e(@\App\Entre::sortie()->orderBy('created_at','desc')->first()->nfacture); ?>">
                      <?php if($errors->has('nfacture')): ?> <div class="help-block">
                         <?php echo e($errors->first('nfacture')); ?>

                      </div>
                    <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="chantier">Site départ</label>
                      <div class="form-control">
                        <?php echo e(\App\Chantier::findOrFail(session('chantier'))->name); ?>

                      </div>
                      <input class="form-control" name="chantier1" value="<?php echo e(session('chantier')); ?>" style="display: none;" required>
                    </div>

                    <div class="form-group <?php if($errors->has('materiel_id')): ?> has-error <?php endif; ?>">
  										<label for="materiel_id">Materiel à transferer</label>
    									<select class="form-control" name="materiel_id">
                        <option value=""></option>
                        <?php $__currentLoopData = $materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $qte = \App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite');
                          ?>
                          <?php if($qte != 0): ?>
      									  <option value="<?php echo e($materiel->id); ?>"><?php echo e($materiel->name.' ('.$qte.')'); ?></option>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    									</select>
                    </div>
                    <div class="form-group <?php if($errors->has('date')): ?> has-error <?php endif; ?>">
                      <label for="date">Date du transfert</label>
                      <input type="text" class="form-control datepicker-input"  name="date" data-mask="9999-99-99" autocomplete="off">
                        <?php if($errors->has('date')): ?> <div class="help-block">
                           <?php echo e($errors->first('date')); ?>

                        </div>
                      <?php endif; ?>
                    </div>

                    <div class="form-group <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
                      <label for="quantite">Quantité à transferer</label>
                      <input type="text" class="form-control" name="quantite" data-mask="0" placeholder="0" required>
                      <?php if($errors->has('quantite')): ?> <div class="help-block">
                         <?php echo e($errors->first('quantite')); ?>

                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('chantier2')): ?> has-error <?php endif; ?>">
                    <label for="chantier2">Site arrivé</label>
                    <select class="form-control" name="chantier2">
                      <option value=""></option>
                      <?php $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($chantier->id != session('chantier')): ?>
                          <option value="<?php echo e($chantier->id); ?>"><?php echo e($chantier->name); ?></option>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
									  <button type="submit" class="btn btn-default">Enregistrer</button>
									</form>
								</div>
							</div>
						</div>

					</div>
      </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

  <script src="<?php echo e(URL::to('assets/js/pages/inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/jquery.inputmask.min.js')); ?>"></script>
  <script>
     $(".numero").inputmask({"mask": "9999"});
       $('#active-transfert').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/transferts/transfert.blade.php ENDPATH**/ ?>