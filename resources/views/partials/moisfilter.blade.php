@php
$categories = \App\Categorie::get();
@endphp
  <form action="" method="GET"  style="display: inline-block;">
      <div class="" style="display: inline-block;">
        <select name="mois" id="mois" style="display: block;margin:0px; width: 100%">
          <option value="{{ date('m') }}">Mois en cours</option>
          @foreach(\App\Option::months() as $m => $value)
          <option value="{{ $m }}" {{ (@$_GET['mois'] == $m)?'selected':'' }}>{{ $value }}</option>
          @endforeach
        </select>
        <select name="cat" id="cat" style="display: block;margin:0px; width: 100%">
          @foreach($categories as $categorie)
          <option value="{{ $categorie->id }}" class="text-capitalize"  {{ (@$_GET['cat'] == $categorie->id)?'selected':'' }}>{{ $categorie->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-default"  style="display: inline-block;position: absolute;margin-left: 7px;">Selecte</button>
  </form>
