@php
$types = \App\Materiel::get();
@endphp

<form action="{{ route('sorties.store') }}" method="POST" role="form" autocomplete="off">
    @csrf
    <div class="form-group @if($errors->has('type_id')) has-error @endif">
		<label for="type_id">Materiel</label>
		<select class="form-control" name="materiel_id" value="{{ old('materiel_id') }}">
      <option value=""></option>
      @foreach($types as $type)
			  <option value="{{ $type->id }}">{!! $type->name !!} </option>
      @endforeach
		</select>
  </div>
  <div class="form-group @if($errors->has('date')) has-error @endif">
  <label for="date">Date</label>
  <input type="text" class="form-control datepicker-input"  name="date" value="{{ old('date') }}" data-mask="9999-99-99">
    @if($errors->has('date')) <div class="help-block">
       {{ $errors->first('date') }}
    </div>
  @endif
</div>
    {{-- <div class="form-group @if($errors->has('nfacture')) has-error @endif">
		<label for="nfacture">N°BON</label>
		<input type="text" class="form-control" name ="nfacture">
    @if($errors->has('nfacture')) <div class="help-block">
       {{ $errors->first('nfacture') }}
    </div>
  @endif
    </div> --}}
    <div class="form-group @if($errors->has('quantite')) has-error @endif">
    <label for="quantite">Quantité sortant</label>
    <input type="number" step="0.01" class="form-control" name="quantite" value="{{ old('quantite') }}" data-mask="0" placeholder="0">
    @if($errors->has('quantite')) <div class="help-block">
       {{ $errors->first('quantite') }}
    </div>
  @endif
  </div>
 {{--  <div class="form-group @if($errors->has('prix_uni')) has-error @endif">
  <label for="prix_uni">Prix Unitaire</label>
  <input type="text" class="form-control" name="prix_uni" value="{{ old('prix_uni') }}" data-mask="0" placeholder="0">
  @if($errors->has('prix_uni')) <div class="help-block">
     {{ $errors->first('prix_uni') }}
  </div>
@endif
</div> --}}
<div class="form-group @if($errors->has('fourni')) has-error @endif">
<label for="fourni">Client</label>
<input type="text" class="form-control" name ="fourni" value="{{ old('fourni') }}">
@if($errors->has('fourni')) <div class="help-block">
   {{ $errors->first('fourni') }}
</div>
@endif
</div>
<div class="form-group">
  <label for="motif">Utilisation *</label>
  <textarea name="motif" id="motif" cols="30" rows="5" class="form-control" required></textarea>
</div>
	  <button type="submit" class="btn btn-default">Enregistrer</button>
	</form>