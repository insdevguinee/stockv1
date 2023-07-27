

<?php $__env->startSection('title'); ?>
  Mon Profil
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>
<div class="row">
    <?php echo $__env->make('personnels.profil.partials._personnelshow',['personnel'=>$personnel], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('personnels.profil._body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/personnels/profil/index.blade.php ENDPATH**/ ?>