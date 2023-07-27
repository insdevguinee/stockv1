@extends('layouts.app')

@section('title')
  Modification {{ $materiel->name }}
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
			  <div class="widget clearfix">
			    <div class="widget-header transparent clearfix">
			      <h2 class="text-center"><strong>Modification</strong> {{ $materiel->name }}</h2>

			    </div>
			    <div class="widget-content padding clearfix">
			      <div id="basic-form">
			        <form action="{{ route('materiels.update',$materiel->id) }}" method="POST" role="form">
			        @csrf
			        @method('PUT')

			        <div class="form-group @if($errors->has('name')) has-error @endif">
			          <label>Designation</label>
			          <input type="text" class="form-control"  name="name" value="{{ $materiel->name }}">

			        </div>

			        <div class="form-group ">
			        <label>Categorie</label>
			        <select name="categorie" id="categorie" class="form-control">
			          @foreach($categories as $categorie)
			            <option value="{{ $categorie->id }}" {{ ($materiel->categorie_id == $categorie->id) ? 'selected':"" }}>{{ $categorie->name }}</option>
			          @endforeach
			        </select>

			        <div class="form-group ">
			        <label>Unité</label>
			          <input type="text" class="form-control"  name="unite"  value="{{ $materiel->unite }}">
			        </div>
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
       $('#active-entres-table').addClass('active');
</script>
@endsection