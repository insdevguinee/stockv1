@extends('layouts.app')
@section('title')
Rapports
@endsection

@section('contents')
<div class="row">
  @can('add_rapports')
  <div class="col-md-12">
      <form action="{{ route('generate') }}" method="POST">
        @csrf
      <button class="btn btn-info" type="submit"><span class="pull-right"> Generer le rapport de la semaine</button>
      </form>
  </div>
  @endcan
</div>
<hr>
<div class="row">

  @foreach($rapports as $rapport)
   <div class="col-md-3">
    <div class="panel panel-{{ ($rapport->valider)? 'success' : 'warning'}} text-center">
    	<div class="panel-heading">
    		Rapport <strong> {{ $rapport->name }}</strong>
    	</div>
      <div class="panel-body">

      	<p >{{ $rapport->debut." - ".$rapport->fin }} <br><small>Generé le {{ $rapport->updated_at }}</small></p>

	     <div>
      @can('valide_rapports')

        @if(!$rapport->valider)
        <form action="{{ route('rapports.update',$rapport->id) }}" method="POST" style="display: inline-block;">
          @csrf
          @method('PUT')
          <button class="btn btn-success" type="submit">Valider</button>
        </form>
	      @endif
      @endcan
           <a href="#" class="btn btn-default" onclick="document.getElementById('downloadPDF{{ $rapport->id }}').submit();">
             Voir le rapport
           </a>

	      	{{-- <button class="btn btn-default"><span class="pull-right"> <i class="fa fa-download"></i> Telecharger</button> --}}
	     </div>
          <form id="downloadPDF{{ $rapport->id }}" action="{{ route('stock.pdf',[$rapport->id]) }}" method="GET"  style="display: none;" autocomplete="off">
            <input type="number" name="rapport" value="{{ $rapport->id }}" style="display: none;">
          </form>

      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

@section('scripts')
  <script>
       $('#active-rapports').addClass('active');
</script>
@endsection
