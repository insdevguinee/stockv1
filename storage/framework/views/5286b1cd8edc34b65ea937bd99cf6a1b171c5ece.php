
<?php $__env->startSection('title'); ?>
Paramètre Application
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
    <div class="row">

      <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
        <div class="widget">
          <div class="widget-header transparent">
                <h2><strong>Configuration</strong> application</h2>

              </div>
          <div class="widget-content padding">
              <?php echo e(Form::model($setting, ['route' => array('settings.update', $setting->id), 'method' => 'PUT','style'=>'width:100%;display:contents !important', 'enctype'=>"multipart/form-data",'autocomplete'=>'off'])); ?>

                <div class="form-group <?php if($errors->has('logo')): ?> has-error <?php endif; ?>">
                    <label for="logo">Logo App</label>
                    <input type="file" class="form-control" name="logo" value="<?php echo e($setting->logo); ?>" placeholder="logo">
                    <?php if($errors->has('logo')): ?> <div class="help-block">
                       <?php echo e($errors->first('logo')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('prefix')): ?> has-error <?php endif; ?>">
                    <label for="prefix">Prefix Connexion <small><i>Ex :OFIX/username </i></small></label>
                    <input type="number" class="form-control" name="prefix" value="<?php echo e($setting->prefix); ?>" data-mask="0" placeholder="OFIX">
                    <?php if($errors->has('prefix')): ?> <div class="help-block">
                       <?php echo e($errors->first('prefix')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <hr>
                 <div class="form-group <?php if($errors->has('notifnumb')): ?> has-error <?php endif; ?>">
                    <label for="notifnumb">Qte minimum notification</label>
                    <input type="number" class="form-control" name="notifnumb" value="<?php echo e($setting->notifnumb); ?>" data-mask="0" placeholder="10" min="10">
                    <?php if($errors->has('notifnumb')): ?> <div class="help-block">
                       <?php echo e($errors->first('notifnumb')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
                    <label for="email">Email notification</label>
                    <input type="email" class="form-control" name="email" value="<?php echo e($setting->email); ?>">
                    <?php if($errors->has('email')): ?> <div class="help-block">
                       <?php echo e($errors->first('email')); ?>

                    </div>
                  <?php endif; ?>
                  </div>
                  <div class="form-group <?php if($errors->has('email2')): ?> has-error <?php endif; ?>">
                    <label for="email2">Email 2 notification</label>
                    <input type="email" class="form-control" name="email2" value="<?php echo e($setting->email2); ?>" placeholder="email">
                    <?php if($errors->has('email2')): ?> <div class="help-block">
                       <?php echo e($errors->first('email2')); ?>

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
  <!-- Page Specific JS Libraries -->
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
  <script>
       $('#active-apps').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/damaro/Bureau/stockv1/resources/views/settings/index.blade.php ENDPATH**/ ?>