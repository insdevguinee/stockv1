@extends('layouts.app')

@section('title')
  Modification {{ $outil->name }}
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
			  <div class="widget clearfix">
			    <div class="widget-header transparent clearfix">
			      <h2 class="text-center"><strong>Modification</strong> {{ $outil->name }}</h2>

			    </div>
			    <div class="widget-content padding clearfix">
			      <div id="basic-form">
			        <form action="{{ route('outils.update',$outil->id) }}" method="POST" role="form">
			        @csrf
			        @method('PUT')

			        <div class="form-group @if($errors->has('name')) has-error @endif">
			          <label>Nom</label>
			          <input type="text" class="form-control"  name="name" value="{{ $outil->name }}">

			        </div>

			         <div class="form-group @if($errors->has('qte')) has-error @endif">
			          <label>Quantité</label>
			          <input type="number" class="form-control"  name="qte" value="{{ $outil->qte }}">

			        </div>


			        <div class="form-group ">
			        <label>Etat</label>
			        <select name="etat" class="form-control">
			        	<option value="0" {{ ($outil->etat == 0) ? 'selected':''}}>En panne</option>
			        	<option value="1" {{ ($outil->etat == 1) ? 'selected':''}}>Fonctionne</option>
			        </select>
			        </div>
			             <div class="form-group ">
				        <label>Categorie</label>
				        <select name="categorie" id="categorie" class="form-control">
				          @foreach($categories as $categorie)
				            <option value="{{ $categorie->id }}" {{ ($outil->categorie_id == $categorie->id) ? 'selected':"" }}>{{ $categorie->name }}</option>
				          @endforeach
				        </select>
				        </div>

			        <div class="form-group">
			        	<label for="">Nuemro de Serie</label>
			        	<textarea name="description" class="form-control">{{ $outil->description }}</textarea>
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
       $('#active-outils').addClass('active');
</script>
@endsection