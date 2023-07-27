
<?php if(Session::has('success')): ?>
<div class="col-md-6 col-md-offset-3 portlets ui-sortable">
	<div class="alert alert-success alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	   <p class="text-center"><?php echo Session::get('success'); ?></p> 
	</div>
</div>
<?php endif; ?>
<?php if(Session::has('failed')): ?>
<div class="col-md-6 col-md-offset-3 portlets ui-sortable">
	<div class="alert alert-danger alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	     <p class="text-center"><?php echo Session::get('failed'); ?></p> 
	</div>
</div>
<?php endif; ?>


<?php /**PATH /home/damaro/Bureau/stockv1/resources/views/partials/message.blade.php ENDPATH**/ ?>