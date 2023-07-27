
@if(Session::has('success'))
<div class="col-md-6 col-md-offset-3 portlets ui-sortable">
	<div class="alert alert-success alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	   <p class="text-center">{!! Session::get('success') !!}</p> 
	</div>
</div>
@endif
@if(Session::has('failed'))
<div class="col-md-6 col-md-offset-3 portlets ui-sortable">
	<div class="alert alert-danger alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	     <p class="text-center">{!! Session::get('failed') !!}</p> 
	</div>
</div>
@endif


{{-- @if(session('chaniter'))
<div class="alert alert-warning text-center text-capitalize">
   <strong>Selectionnez un chantier pour une meilleure utilisation de l'application</strong>
</div>
@endif --}}