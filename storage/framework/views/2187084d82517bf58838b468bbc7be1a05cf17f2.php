
<?php $__env->startSection('title'); ?>
Notifications
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
    <div class="row">

      <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
        <div class="widget">
          <div class="widget-header transparent">
                <h2><strong>Notifications</strong></h2>

              </div>
          <div class="widget-content padding">
            <ul class="list-group" style="height: 400px; overflow-y: scroll;">
              <?php $__currentLoopData = Auth::user()->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="list-group-item" style="background-color:  <?php echo e(($notif->read)?"#b3b3b3":"#fff"); ?>">
                <a href="<?php echo e(route('notifications.show',$notif->id)); ?>">
                  <?php echo e($notif->text); ?>

                </a>
                <small> Le <?php echo e(explode('00:00',\Carbon\Carbon::parse($notif->created_at,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]); ?></small>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
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
       $('#active-notif').addClass('active');
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/notifications/index.blade.php ENDPATH**/ ?>