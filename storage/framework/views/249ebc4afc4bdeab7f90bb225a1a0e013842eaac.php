

<?php $__env->startSection('title'); ?>
  Modification
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modification Bon de Commande</strong></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="<?php echo e(route('bons.update',$bon->id)); ?>" method="POST" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group col-md-6 <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                      <label for="name">Objet </label>
                      <input type="text" class="form-control" name="name" value="<?php echo e($bon->name); ?>" required>
                      <?php if($errors->has('name')): ?> <div class="help-block">
                         <?php echo e($errors->first('name')); ?>

                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="form-group col-md-6 <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                      <label for="numerobon">(Nuemro / Année)</label><?php echo e(@\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon); ?>

                      <input type="text" class="form-control numero" name="numerobon" value="<?php echo e($bon->numerobon); ?>" required>
                      <?php if($errors->has('numerobon')): ?> <div class="help-block">
                         <?php echo e($errors->first('numerobon')); ?>

                        </div>
                      <?php endif; ?>
                    </div>
                    <hr>
                  
                  <div id="materiel">
                    
                      <?php $__currentLoopData = \App\bon::where('numero',$bon->numero)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group col-md-4 <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
                          <label for="type_id">Materiel</label>
                          <select class="form-control" name="materiel[]">
                            <option value=""></option>
                            <?php $__currentLoopData = $materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($materiel->id); ?>" <?php echo e(($materiel->id == $t->materiel_id)?'selected':''); ?>><?php echo $materiel->name; ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>

                      <div class="form-group col-md-4 <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
                          <label for="quantite">Quantité </label>
                          <input type="number" step="0.01" class="form-control" name="quantite[]"  value="<?php echo e($t->quantite); ?>" data-mask="0" placeholder="0">
                          <?php if($errors->has('quantite')): ?> <div class="help-block">
                             <?php echo e($errors->first('quantite')); ?>

                          </div>
                        <?php endif; ?>
                      </div>

                      <div class="form-group col-md-4 <?php if($errors->has('cout')): ?> has-error <?php endif; ?>">
                          <label for="cout">Prix/U </label>
                          <input type="number" class="form-control" name="cout[]"  value="<?php echo e($t->cout); ?>" data-mask="0" placeholder="0">
                          <?php if($errors->has('cout')): ?> <div class="help-block">
                             <?php echo e($errors->first('cout')); ?>

                          </div>
                        <?php endif; ?>
                      </div>

                     
                      <div class="clearfix"></div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="mat">
                        <div class="form-group col-md-4 <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
                          <label for="type_id">Materiel</label>
                          <select class="form-control" name="materiel[]">
                            <option value=""></option>
                            <?php $__currentLoopData = $materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($materiel->id); ?>"><?php echo $materiel->name; ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>

                      <div class="form-group col-md-4 <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
                          <label for="quantite">Quantité </label>
                          <input type="number" class="form-control" name="quantite[]"  data-mask="0" placeholder="0">
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
                  <input type="text" required class="form-control datepicker-input"  name="date" value="<?php echo e($bon->date_execution); ?>" data-mask="9999-99-99" autocomplete>
                    <?php if($errors->has('date')): ?> <div class="help-block">
                       <?php echo e($errors->first('date')); ?>

                    </div>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-12 <?php if($errors->has('fournisseur')): ?> has-error <?php endif; ?>">
                      <label for="fournisseur">Direction </label>
                      <select name="fournisseur" id="fournisseur" class="form-control">
                        <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($fournisseur->id); ?>" <?php echo e(($bon->fournisseur_id == $fournisseur->id)?'selected':''); ?>><?php echo e($fournisseur->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <?php if($errors->has('fournisseur')): ?> <div class="help-block">
                         <?php echo e($errors->first('fournisseur')); ?>

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

          var code = "<div class='mat'> <div class='form-group col-md-4 <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>'> <label for='type_id'>Materiel</label> <select class='form-control select2' name='materiel[]' value='<?php echo e(old('materiel_id')); ?>'> <option selected></option> <?php $__currentLoopData = $materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value='<?php echo e($materiel->id); ?>'><?php echo $materiel->name; ?> </option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </div> <div class='form-group col-md-4 <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>'> <label for='quantite'>Quantité </label> <input type='number' class='form-control' name='quantite[]' required value='<?php echo e(old('quantite')); ?>' data-mask='0' placeholder='0'> <?php if($errors->has('quantite')): ?> <div class='help-block'> <?php echo e($errors->first('quantite')); ?> </div> <?php endif; ?> </div> <div class='form-group col-md-4 <?php if($errors->has('cout')): ?> has-error <?php endif; ?>'> <label for='cout'>Prix/U </label> <input type='number' class='form-control' name='cout[]' required value='<?php echo e(old('cout')); ?>' data-mask='0' placeholder='0'> <?php if($errors->has('cout')): ?> <div class='help-block'> <?php echo e($errors->first('cout')); ?> </div> <?php endif; ?> </div><span class='btn btn-xs btn-info remove btn-danger'><i class='fa fa-remove'></i></span> <div class='clearfix'></div> </div>";

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
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/damaro/Bureau/stockv1/resources/views/bons/edit.blade.php ENDPATH**/ ?>