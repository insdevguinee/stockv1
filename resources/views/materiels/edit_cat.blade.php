@extends('layouts.app')

@section('title')
  Modification {{ $categorie->name }}
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
			  <div class="widget clearfix">
			    <div class="widget-header transparent clearfix">
			      <h2 class="text-center"><strong>Modification</strong> {{ $categorie->name }}</h2>

			    </div>
			    <div class="widget-content padding clearfix">
			      <div id="basic-form">
			        <form action="{{ route('categories.update',$categorie->id) }}" method="POST" role="form">
			        @csrf
			        @method('PUT')

			            <div class="form-group @if($errors->has('name')) has-error @endif">
			              <label>Nom</label>
			              <input type="text" class="form-control"  name="name" value="{{ $categorie->name }}">

			            </div>
			               <div class="form-group">
				              <select name="type" class="form-control">
				                <option value="0" {{ ($categorie->type == 0 ) ? 'selected':'' }}>Pour les materiaux</option>
				                <option value="1" {{ ($categorie->type == 1 ) ? 'selected':'' }}>Outils pour le travail</option>
				              </select>
				            </div>
			            <div class="form-group ">
			            <label>Description</label>
			            <textarea name="description" class="form-control" cols="30" rows="10">{{ $categorie->description }}</textarea>
			      <button type="submit" class="btn btn-success pull-left">Modifier</button>
			    </form>
			  </div>
			</div>
          </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('#active-categories').addClass('active');
</script>
@endsection