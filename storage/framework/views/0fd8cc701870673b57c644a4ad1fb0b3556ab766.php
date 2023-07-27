

<?php $__env->startSection('title'); ?>
  Nouveau personnel
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Nouveau </strong> Personnel </h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="<?php echo e(route('personnels.store')); ?>" method="POST" role="form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group <?php if($errors->has('matricule')): ?> has-error <?php endif; ?>">
                      <label for="matricule">Matricule</label>
                      <input value="<?php echo e(old("matricule")); ?>" type="text" class="form-control" name ="matricule">
                      <?php if($errors->has('matricule')): ?> <div class="help-block">
                         <?php echo e($errors->first('matricule')); ?>

                      </div>
                    <?php endif; ?>
                    </div>

                  <div class="form-group <?php if($errors->has('nom')): ?> has-error <?php endif; ?>">
										<label for="nom">Nom</label>
										<input value="<?php echo e(old("nom")); ?>" type="text" class="form-control" name ="nom">
                    <?php if($errors->has('nom')): ?> <div class="help-block">
                       <?php echo e($errors->first('nom')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('prenoms')): ?> has-error <?php endif; ?>">
                    <label for="prenoms">Prenom(s)</label>
                    <input value="<?php echo e(old("prenoms")); ?>" type="text" class="form-control" name ="prenoms">
                    <?php if($errors->has('prenoms')): ?> <div class="help-block">
                       <?php echo e($errors->first('prenoms')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group ">
                        <label for="example-url-input" class="">Civilité <span class="text-danger">*</span></label>
                            <select class="form-control" name="civilite" required>
                                <option value="m">Monsieur</option>
                                <option value="mme">Madame</option>
                                <option value="mlle">Mademoiselle</option>
                            </select>
                    </div>
                  <div class="form-group <?php if($errors->has('contact')): ?> has-error <?php endif; ?>">
                    <label for="contact">Contact</label>
                    <input value="<?php echo e(old("contact")); ?>" type="text" class="form-control" name="contact">
                    <?php if($errors->has('contact')): ?> <div class="help-block">
                       <?php echo e($errors->first('contact')); ?>

                    </div>
                    <?php endif; ?>
                  </div>
                    <div class="form-group">
                        <label for="example-url-input">Date de naissance <span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="naissance" required  placeholder="Date de naissance">
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Lieu de naissance <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="lieu_n"  required  placeholder="Lieu de naissance">
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Nationnalité <span class="text-danger">*</span></label>
                            <select class="form-control" name="nationnalite" required >
                                <option></option>
                                <option value="ivoirienne">Ivoirienne</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Adresse Habitation <span class="text-danger">*</span></label>

                            <input class="form-control" type="text" name="adresse"  required  placeholder="Adresse d'habitation">

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Situation Matrimoniale <span class="text-danger">*</span></label>

                            <select class="form-control" name="st_matri" required>
                                <option value="marie">Marié</option>
                                <option value="celibataire" selected>Célibataire</option>
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Nombre d'enfant <span class="text-danger">*</span></label>

                            <input class="form-control" type="number" name="enfant" value="0"  required>

                    </div>

                     <div class="form-group">
                        <label for="example-url-input">Direction <span class="text-danger">*</span></label>

                            <select class="form-control" name="departement_id" required>
                                <option></option>
                                <?php $__currentLoopData = $departements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($d->id); ?>" ><?php echo e($d->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Poste <span class="text-danger">*</span></label>

                            <input class="form-control" type="text" name="poste"  required placeholder="Poste Occupé">

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Type de Contrat <span class="text-danger">*</span></label>

                            <select class="form-control" name="contrat_type" required>
                                
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Salaire Brut</label>

                            <input class="form-control" type="number" name="salaire" value="0">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">N°CNPS</label>

                            <input class="form-control" type="text" name="cnps">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">CMU</label>

                            <input class="form-control" type="text" name="cmu">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">Date d'embauche <span class="text-danger">*</span></label>

                            <input class="form-control" type="date" name="embauche" required  placeholder="Date d'embauche">

                    </div>


                  <div class="form-group <?php if($errors->has('numero_equipe')): ?> has-error <?php endif; ?>">
                    <label for="numero_equipe">Numéro Equipe</label>
                    <input  value="<?php echo e(old("numero_equipe")); ?>" type="text" class="form-control" name ="numero_equipe">
                    <?php if($errors->has('numero_equipe')): ?> <div class="help-block">
                       <?php echo e($errors->first('numero_equipe')); ?>

                    </div>
                    <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <p><strong>Travail sur le / les Chantier(s)</strong></p>
                    <?php $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <label class="switch switch switch-round block">
                          <input type="checkbox" name="chantiers[]" value="<?php echo e($chantier->id); ?>">
                          <span class="switch-label" data-on="YES" data-off="NO"></span>
                          <span><?php echo e(Form::label($chantier->name, ucfirst($chantier->name))); ?></span>
                      </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>



									  <button type="submit" class="btn btn-default">Creer</button>
									</form>
								</div>
							</div>
						</div>


					</div>

      </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(URL::to('assets/libs/d3/d3.v3.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/rickshaw/rickshaw.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/raphael/raphael-min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/morrischart/morris.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-knob/jquery.knob.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-clock/clock.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-easypiechart/jquery.easypiechart.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/bootstrap-calendar/js/bic_calendar.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/apps/calculator.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/apps/todo.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/apps/notes.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/index.js')); ?>"></script>
  <script>
       $('#active-personnels').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/personnels/create.blade.php ENDPATH**/ ?>