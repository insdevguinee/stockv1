

<?php $__env->startSection('title'); ?>
  Modifier un utilisateur
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
      <div class="row">

        <div class="col-md-6 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modifier </strong> <?php echo e($user->name); ?></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="<?php echo e(route('users.update',$user->id)); ?>" method="POST" role="form">
                    <?php echo method_field('PUT'); ?>
                    <?php echo csrf_field(); ?>

                  <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
                    <label for="name">Username</label>
                    <input value="<?php echo e($user->name); ?>" <?php echo e(old('name')); ?> type="text" class="form-control "  name="name">
                      <?php if($errors->has('name')): ?> <div class="help-block">
                         <?php echo e($errors->first('name')); ?>

                      </div>
                    <?php endif; ?>
                  </div>
                    <div class="form-group <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
                    <label for="email">Email</label>
                    <input value="<?php echo e($user->email); ?>" <?php echo e(old("email")); ?> type="email" class="form-control" name="email">
                    <?php if($errors->has('email')): ?> <div class="help-block">
                       <?php echo e($errors->first('email')); ?>

                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('nom')): ?> has-error <?php endif; ?>">
										<label for="nom">Nom</label>
										<input value="<?php echo e($user->nom); ?>" <?php echo e(old("nom")); ?> type="text" class="form-control" name ="nom">
                    <?php if($errors->has('nom')): ?> <div class="help-block">
                       <?php echo e($errors->first('nom')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('prenom')): ?> has-error <?php endif; ?>">
                    <label for="prenom">Prenom(s)</label>
                    <input value="<?php echo e($user->prenom); ?>" <?php echo e(old("prenom")); ?> type="text" class="form-control" name ="prenom">
                    <?php if($errors->has('prenom')): ?> <div class="help-block">
                       <?php echo e($errors->first('prenom')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                
                  <div class="form-group <?php if($errors->has('phone')): ?> has-error <?php endif; ?>">
                    <label for="phone">Contact</label>
                    <input value="<?php echo e($user->phone); ?>" <?php echo e(old("phone")); ?> type="text" class="form-control" name ="phone">
                    <?php if($errors->has('phone')): ?> <div class="help-block">
                       <?php echo e($errors->first('phone')); ?>

                    </div>
                    <?php endif; ?>
                  </div>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_users')): ?>
                  <div class="form-group">
                    <?php $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <label class="switch switch switch-round block">
                          <input type="checkbox" name="chantiers[]" value="<?php echo e($chantier->id); ?>" <?php echo e(($user->chantiers->contains($chantier) ) ? 'checked':''); ?> >
                          <span class="switch-label" data-on="YES" data-off="NO"></span>
                          <span><?php echo e(Form::label($chantier->name, ucfirst($chantier->name))); ?></span>
                      </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <div class="form-group <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
                    <label for="type_id">Roles</label>
                    <select class="form-control" name="role">
                      <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($role->id); ?>" <?php echo e($user->roles->contains($role) ? 'selected':''); ?>><?php echo e($role->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <?php endif; ?>
                   
                
									  <button type="submit" class="btn btn-default">Modifier</button>
									</form>
								</div>
							</div>
						</div>

           
					</div>
          <div class="col-md-6  portlets ui-sortable">
             <div class="widget">
              <div class="widget-header transparent">
                <h2><strong>Modifier le mot de passe </strong> <?php echo e($user->name); ?></h2>
              </div>
              <div class="widget-content padding">
                <form action="<?php echo e(route('user.passwordReset',$user->id)); ?>" method="POST">
                   <?php echo csrf_field(); ?>
                    <div class="form-group <?php if($errors->has('nom')): ?> has-error <?php endif; ?>">
                      <label for="newPassword">Mot de passe</label>
                      <input type="password" class="form-control" name ="newPassword">
                      <?php if($errors->has('newPassword')): ?> <div class="help-block">
                         <?php echo e($errors->first('newPassword')); ?>

                      </div>
                    <?php endif; ?>
                    </div>
                    <div class="form-group <?php if($errors->has('newPassword_confirmation')): ?> has-error <?php endif; ?>">
                      <label for="newPassword_confirmation">Confirmation</label>
                      <input type="password" class="form-control" name ="newPassword_confirmation">
                      <?php if($errors->has('newPassword_confirmation')): ?> <div class="help-block">
                         <?php echo e($errors->first('newPassword_confirmation')); ?>

                      </div>
                    <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-default">Modifier</button>
                </form>
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
       $('#active-users').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/users/edit.blade.php ENDPATH**/ ?>