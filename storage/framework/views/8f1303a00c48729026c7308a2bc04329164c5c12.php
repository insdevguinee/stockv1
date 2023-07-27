



<?php $__env->startSection('title'); ?>
  Modifier un personnel
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modifier </strong> <?php echo e($personnel->matricule); ?></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="<?php echo e(route('personnels.update',$personnel->id)); ?>" method="POST" role="form">
                    <?php echo method_field('PUT'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="form-group <?php if($errors->has('matricule')): ?> has-error <?php endif; ?>">
                      <label for="matricule">Matricule</label>
                      <input type="text" class="form-control" value="<?php echo e($personnel->matricule); ?>" name="matricule" disabled>
                      <?php if($errors->has('matricule')): ?> <div class="help-block">
                         <?php echo e($errors->first('matricule')); ?>

                      </div>
                    <?php endif; ?>
                    </div>

                  <div class="form-group <?php if($errors->has('nom')): ?> has-error <?php endif; ?>">
										<label for="nom">Nom</label>
										<input type="text" class="form-control" value="<?php echo e($personnel->nom); ?>" name="nom">
                    <?php if($errors->has('nom')): ?> <div class="help-block">
                       <?php echo e($errors->first('nom')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('prenoms')): ?> has-error <?php endif; ?>">
                    <label for="prenoms">Prenom(s)</label>
                    <input type="text" class="form-control" value="<?php echo e($personnel->prenoms); ?>" name="prenoms">
                    <?php if($errors->has('prenoms')): ?> <div class="help-block">
                       <?php echo e($errors->first('prenoms')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="<?php echo e($personnel->email); ?>" name="email">
                    <?php if($errors->has('email')): ?> <div class="help-block">
                       <?php echo e($errors->first('email')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group ">
                        <label for="example-url-input" class="">Civilité </label>
                            <select class="form-control" name="civilite">
                                <option value="m" <?php echo e($personnel->civilite == "m" ? 'selected':' '); ?> >Monsieur</option>
                                <option value="mme" <?php echo e($personnel->civilite == "mme" ? 'selected':' '); ?> >Madame</option>
                                <option value="mlle" <?php echo e($personnel->civilite == "mlle" ? 'selected':' '); ?> >Mademoiselle</option>
                            </select>
                    </div>
                  <div class="form-group <?php if($errors->has('contact')): ?> has-error <?php endif; ?>">
                    <label for="contact">Contact</label>
                    <input  type="text" class="form-control" value="<?php echo e($personnel->contact); ?>" name="contact">
                    <?php if($errors->has('contact')): ?> <div class="help-block">
                       <?php echo e($errors->first('contact')); ?>

                    </div>
                    <?php endif; ?>
                  </div>
                    <div class="form-group">
                        <label for="example-url-input">Date de naissance </label>
                        <input class="form-control" type="date" value="<?php echo e($personnel->naissance); ?>" name="naissance"   placeholder="Date de naissance">
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Lieu de naissance </label>
                        <input class="form-control" type="text" value="<?php echo e($personnel->lieu_n); ?>" name="lieu_n"    placeholder="Lieu de naissance">
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Nationnalité </label>
                            <select class="form-control" value="<?php echo e($personnel->nationnalite); ?>" name="nationnalite"  >
                                <option></option>
                                <option value="ivoirienne">Ivoirienne</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Adresse Habitation </label>

                            <input class="form-control" type="text" value="<?php echo e($personnel->adresse); ?>" name="adresse"    placeholder="Adresse d'habitation">

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Situation Matrimoniale </label>

                            <select class="form-control" value="<?php echo e($personnel->st_matri); ?>"name="st_matri" >
                                <option value="marie">Marié</option>
                                <option value="celibataire" selected>Célibataire</option>
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Nombre d'enfant </label>

                            <input class="form-control" type="number" value="<?php echo e($personnel->enfant); ?>" name="enfant" value="0"  >

                    </div>

                     <div class="form-group">
                        <label for="example-url-input">Departement </label>

                            <select class="form-control"name="departement_id" >
                                <option></option>
                                <?php $__currentLoopData = $departements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($d->id); ?>" <?php echo e($personnel->departement_id == $d->id ?"selected":"

                                "); ?> ><?php echo e($d->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Poste </label>

                            <input class="form-control" type="text" value="<?php echo e($personnel->poste); ?>" name="poste"   placeholder="Poste Occupé">

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Type de Contrat </label>

                            <select class="form-control" value="<?php echo e($personnel->contrat_type); ?>" name="contrat_id" >
                                
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                <option value="prestataire">Prestataire</option>
                                
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Salaire Brut</label>

                            <input class="form-control" type="number" value="<?php echo e($personnel->salaire); ?> "name="salaire" value="0">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">N°CNPS</label>

                            <input class="form-control" type="text" value="<?php echo e($personnel->cnps); ?>" name="cnps">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">CMU</label>

                            <input class="form-control" type="text" value="<?php echo e($personnel->cmu); ?>" name="cmu">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">Date d'embauche </label>

                            <input class="form-control" type="date" value="<?php echo e($personnel->embauche); ?>" name="embauche"  placeholder="Date d'embauche">

                    </div>


                  <div class="form-group <?php if($errors->has('numero_equipe')): ?> has-error <?php endif; ?>">
                    <label for="numero_equipe">Numéro Equipe</label>
                    <input  value="<?php echo e(old("numero_equipe")); ?>" type="text" class="form-control" value="<?php echo e($personnel->numero_equipe); ?>" name="numero_equipe">
                    <?php if($errors->has('numero_equipe')): ?> <div class="help-block">
                       <?php echo e($errors->first('numero_equipe')); ?>

                    </div>
                    <?php endif; ?>
                  </div>

                  <div class="form-group">
                    <p><strong>Travail sur le / les Chantier(s)</strong></p>
                    <?php $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <label class="switch switch switch-round block">
                          <input type="checkbox" name="chantiers[]" value="<?php echo e($chantier->id); ?>" <?php echo e(($personnel->chantiers->contains($chantier) ) ? 'checked':''); ?> >
                          <span class="switch-label" data-on="YES" data-off="NO"></span>
                          <span><?php echo e(Form::label($chantier->name, ucfirst($chantier->name))); ?></span>
                      </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/personnels/edit.blade.php ENDPATH**/ ?>