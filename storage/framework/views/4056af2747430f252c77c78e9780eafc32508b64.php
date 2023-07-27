

<?php $__env->startSection('title'); ?>
  Faire une entré
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Entre de materiels</strong></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="<?php echo e(route('entres.store')); ?>" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
                    <?php echo csrf_field(); ?>
                    <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                      <label for="numerobon">N°BON DE COMMANDE</label>
                       <select name="numerobon" id="numerobon" class="form-control search_select">
                        <option value="0000/2021">Retour</option>
                          <?php $__currentLoopData = \App\Bon::where([['chantier_id','=',session('chantier')],['etat',"=","valider"]])->orderBy('numerobon','desc')->groupBy('numerobon')->distinct()->get('numerobon'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($bon->numerobon); ?>"><?php echo e($bon->numerobon); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      <?php if($errors->has('numerobon')): ?> <div class="help-block">
                         <?php echo e($errors->first('numerobon')); ?>

                        </div>
                      <?php endif; ?>
                    </div>

                  <div id="materiel">
                    <div class="mat">
                        <div class="form-group col-md-6 <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
                        <label for="type_id">Materiel</label>
                        <select class="form-control search_select" name="materiel[]" value="<?php echo e(old('materiel_id')); ?>">
                          <option value=""></option>
                          <?php $__currentLoopData = $materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($materiel->id); ?>"><?php echo e($materiel->name.' ('.\App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite') .')'); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>

                      <div class="form-group col-md-6 <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
                          <label for="quantite">Quantité </label>
                          <input type="number" step="0.01" class="form-control" name="quantite[]" required value="<?php echo e(old('quantite')); ?>" data-mask="0" placeholder="0">
                          <?php if($errors->has('quantite')): ?> <div class="help-block">
                             <?php echo e($errors->first('quantite')); ?>

                          </div>
                        <?php endif; ?>
                      </div>


                      <div class="clearfix"></div>
                    </div>
                  </div>
                   <p class="text-center">
                       <a href="#end" id="addLine" class="add btn btn-xs btn-info"><span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                    </p>
                  <div id="end" class="form-group col-md-12 <?php if($errors->has('date')): ?> has-error <?php endif; ?>">
                  <label for="date">Date du bon</label>
                  <input type="text" required class="form-control datepicker-input"  name="date" value="<?php echo e(old('date')); ?>" data-mask="9999-99-99" autocomplete>
                    <?php if($errors->has('date')): ?> <div class="help-block">
                       <?php echo e($errors->first('date')); ?>

                    </div>
                  <?php endif; ?>
                </div>
                 <div class="form-group <?php if($errors->has('fourni')): ?> has-error <?php endif; ?>">
                    <label for="fourni">Fournisseur</label>
                    
                    <select name="fourni" id="fourni" class="form-control search_select">
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

     $('#addLine').click(function(event) {

          var code = "<div class='mat'> <div class='form-group col-md-6 <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>'> <label for='type_id'>Materiel</label> <select class='form-control search_select' name='materiel[]' value='<?php echo e(old('materiel_id')); ?>'> <option selected></option> <?php $__currentLoopData = $materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value='<?php echo e($materiel->id); ?>'><?php echo e($materiel->name.' ('.\App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite') .')'); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </div> <div class='form-group col-md-6 <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>'> <label for='quantite'>Quantité </label> <input type='number' step='0.01' class='form-control' name='quantite[]' required value='<?php echo e(old('quantite')); ?>' data-mask='0' placeholder='0'> <?php if($errors->has('quantite')): ?> <div class='help-block'> <?php echo e($errors->first('quantite')); ?> </div> <?php endif; ?> </div><span class='btn btn-xs btn-info remove btn-danger'><i class='fa fa-remove'></i></span> <div class='clearfix'></div> </div>";

          $('#materiel').append("<div class='mat'>"+code+"</div>");
            $('select').select2({
              placeholder: "Search for a repository",
            });
          $('.remove').click(function(event) {
            $(this).parent('.mat').remove();
          });
        });
      $(":input").inputmask();
       $(".numero").inputmask({"mask": "9999/9999"});
        $('#active-generation').addClass('active');
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/stocks/entre/multiple.blade.php ENDPATH**/ ?>