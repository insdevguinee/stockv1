

<?php $__env->startSection('title'); ?>
  Ajouter du Materiel
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modification</strong>  Sortie</h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
                  <?php echo e(Form::model($entre, ['route' => array('sorties.update', $entre->id), 'method' => 'PUT','style'=>'width:100%;display:contents !important', 'enctype'=>"multipart/form-data",'autocomplete'=>'off','onsubmit'=>'return show_alert();'])); ?>

									
                    <div class="form-group <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
										<label for="type_id">Materiel</label>
  									<select class="form-control search_select" name="materiel_id">
                      <option value=""></option>
                      <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    									  <option value="<?php echo e($type->id); ?>" <?php echo e(($type->id == $entre->materiel->id)?'selected':""); ?>><?php echo e($type->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  									</select>
                  </div>
                  <div class="form-group <?php if($errors->has('date')): ?> has-error <?php endif; ?>">
                  <label for="date">Date</label>
                  <input type="text" value="<?php echo e($entre->date_ajout); ?>" class="form-control datepicker-input"  name="date" data-mask="9999-99-99" autocomplete="no">
                    <?php if($errors->has('date')): ?> <div class="help-block">
                       <?php echo e($errors->first('date')); ?>

                    </div>
                  <?php endif; ?>
                </div>
                    <div class="form-group <?php if($errors->has('nfacture')): ?> has-error <?php endif; ?>">
										<label for="nfacture">N°BON</label>
										<input type="text" value="<?php echo e($entre->nfacture); ?>" class="form-control num" name ="nfacture" placeholder="0001">
                    <?php if($errors->has('nfacture')): ?> <div class="help-block">
                       <?php echo e($errors->first('nfacture')); ?>

                    </div>
                  <?php endif; ?>
                    </div>
                    <div class="form-group <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
                    <label for="quantite">Quantité</label>
                    <input type="number" step="0.01" value="<?php echo e(-$entre->quantite); ?>" class="form-control" name="quantite" data-mask="0" placeholder="0">
                    <?php if($errors->has('quantite')): ?> <div class="help-block">
                       <?php echo e($errors->first('quantite')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                 
           
                <div class="form-group">
                  <label for="motif">Utilisation *</label>
                  <textarea name="motif" id="motif" cols="30" rows="5" class="form-control" required><?php echo e($entre->motif); ?></textarea>
                </div>
									  <button type="submit" class="btn btn-default">Modifier</button>
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
    <script src="<?php echo e(URL::to('assets/js/pages/inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/jquery.inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
  <script>
        $(".num").inputmask({"mask": "9999"});
      $('#active-sorties').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/stocks/sortie/edit.blade.php ENDPATH**/ ?>