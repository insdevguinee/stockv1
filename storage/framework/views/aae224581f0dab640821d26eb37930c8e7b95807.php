

<?php $__env->startSection('title'); ?>
  Faire un bon de commande
<?php $__env->stopSection(); ?>
<?php
$numero = ( count(\App\Bon::where('chantier_id',session('chantier'))->get()) !=0 ) ?  sprintf("%04d",explode('/',@\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon)[0] + 1 ).'/'.explode('/',@\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon)[1] : "0001/2021";
?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Commande</strong></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="<?php echo e(route('bons.store')); ?>" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
                    <?php echo csrf_field(); ?>

                 <div class="row">
                      <div class="form-group col-md-6 <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                      <label for="name">Objet </label>
                      <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
                      <?php if($errors->has('name')): ?> <div class="help-block">
                         <?php echo e($errors->first('name')); ?>

                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="form-group col-md-6 <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                      <label for="numerobon">(Numero / Année) <strong> Dernier N°:<?php echo e(@\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon); ?></strong></label>
                      <input type="text" class="form-control numero" name="numerobon" value="<?php echo e(old('numerobon')); ?>" required data-mask="9999/9999"
                       placeholder="<?php echo e($numero); ?>">
                      <?php if($errors->has('numerobon')): ?> <div class="help-block">
                         <?php echo e($errors->first('numerobon')); ?>

                        </div>
                      <?php endif; ?>
                    </div>
                 </div>

                 <div class="row">
                    <div id="materiel">
                    <div class="mat">
                        <div class="form-group col-md-4 <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
                        <label for="type_id">Materiel</label>
                        <select class="form-control select2" name="materiel[]" value="<?php echo e(old('materiel_id')); ?>">
                          <option value=""></option>
                          <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>"><?php echo $type->name.' ('.$type->unite.')'; ?> </option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>

                      <div class="form-group col-md-4 <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
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
                       <div class="clearfix"></div>
                    <p class="text-center">
                       <a href="#end" id="addLine" class="add btn btn-xs btn-info"><span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                    </p>
                 </div>
                  <div class="row">
                    <div id="end" class="form-group col-md-12 <?php if($errors->has('date')): ?> has-error <?php endif; ?>">
                  <label for="date">Date du bon</label>
                  <input type="text" required class="form-control datepicker-input"  name="date" value="<?php echo e(old('date')); ?>" data-mask="9999-99-99" autocomplete>
                    <?php if($errors->has('date')): ?> <div class="help-block">
                       <?php echo e($errors->first('date')); ?>

                    </div>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-12 <?php if($errors->has('fournisseur')): ?> has-error <?php endif; ?>">
                      <label for="fournisseur">Direction </label>
                      <select name="fournisseur" id="fournisseur" class="form-control">
                        <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($fournisseur->id); ?>"><?php echo e($fournisseur->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <?php if($errors->has('fournisseur')): ?> <div class="help-block">
                         <?php echo e($errors->first('fournisseur')); ?>

                      </div>
                    <?php endif; ?>
                  </div>
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
    jQuery(document).ready(function($) {

        $('#addLine').click(function(event) {

          var code = "<div class='mat'> <div class='form-group col-md-4 <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>'> <label for='type_id'>Materiel</label> <select class='form-control select2' name='materiel[]' value='<?php echo e(old('materiel_id')); ?>'> <option selected></option> <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value='<?php echo e($type->id); ?>'><?php echo $type->name; ?> </option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </div> <div class='form-group col-md-4 <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>'> <label for='quantite'>Quantité </label> <input type='number' step='0.01' class='form-control' name='quantite[]' required value='<?php echo e(old('quantite')); ?>' data-mask='0' placeholder='0'> <?php if($errors->has('quantite')): ?> <div class='help-block'> <?php echo e($errors->first('quantite')); ?> </div> <?php endif; ?> </div> <div class='form-group col-md-4 <?php if($errors->has('cout')): ?> has-error <?php endif; ?>'> </div><span class='btn btn-xs btn-info remove btn-danger'><i class='fa fa-remove'></i></span> <div class='clearfix'></div> </div>";

          $('#materiel').append("<div class='mat'>"+code+"</div>");
            $('select').select2({
            placeholder: "Search for a repository",
          });
          $('.remove').click(function(event) {
            $(this).parent('.mat').remove();
          });

        });

        $(".numero").inputmask({"mask": "9999/9999"});
         $('#active-bons').addClass('active');
    });

  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/bons/create.blade.php ENDPATH**/ ?>