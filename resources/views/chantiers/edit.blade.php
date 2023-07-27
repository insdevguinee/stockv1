@extends('layouts.app')

@section('title')
  Modifier Zones de travail  
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 portlets ui-sortable ">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modifier </strong> {{ $chantier->name }}</h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="{{ route('chantiers.update',$chantier->id) }}" method="POST" role="form">
                    @method('PUT')
                    @csrf

                  <div class="form-group @if($errors->has('name')) has-error @endif">
                      <label>Designation</label>
                      <input type="text" class="form-control"  name="name" value="{{ $chantier->name }}">

                    </div>

                    <div class="form-group ">
                    <label>Description</label>
                    <textarea name="description" class="form-control" cols="30" rows="10">{{ $chantier->description }}</textarea>
									  <button type="submit" class="btn btn-default">Modifier</button>
									</form>
								</div>
							</div>
						</div>

           
					</div>
      </div>
      
@endsection
@section('scripts')
  <script src="{{ URL::to('assets/libs/d3/d3.v3.js')}}"></script>
  <script src="{{ URL::to('assets/libs/rickshaw/rickshaw.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/raphael/raphael-min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/morrischart/morris.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-knob/jquery.knob.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-clock/clock.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-easypiechart/jquery.easypiechart.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/bootstrap-calendar/js/bic_calendar.min.js')}}"></script>
  <script src="{{ URL::to('assets/js/apps/calculator.js')}}"></script>
  <script src="{{ URL::to('assets/js/apps/todo.js')}}"></script>
  <script src="{{ URL::to('assets/js/apps/notes.js')}}"></script>
  <script src="{{ URL::to('assets/js/pages/index.js')}}"></script>
  <script>
       $('#active-chantiers').addClass('active');
</script>
@endsection
