@extends('layouts.app')

@section('title')
  Ajouter du Materiel
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Sortie</strong>  de Materiel</h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
								  @include('partials.sortie')
								</div>
							</div>
						</div>

					</div>
      </div>
      
@endsection
@section('scripts')
  <script>
       $('#active-sorties').addClass('active');
</script>
@endsection
