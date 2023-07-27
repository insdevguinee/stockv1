@extends('layouts.app')

@section('title')
{{ $bon->numero }}
@endsection
@section('contents')

<div class="" style="background-color: #fff;padding: 20px;">
	<div class="row">
			<div class="col-md-6 float-left">
				<img src="{{ URL::to('assets/img/logo.png')}}" style="height: 70px;" alt="Logo">
				<p class="text-justify"></p>
			</div>
		</div>
		<p class="text-right">Conakry le {{explode('00:00',\Carbon\Carbon::parse($bon->date_execution,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]}}</p>
		<h4 class="text-center text-uppercase" style="margin-top: 20px;"><u><strong>BON DE COMMANDE N° </strong></u>{{ $bon->numerobon }}</h4>
		<div class="row " style="margin-top: 20px;">
			<div class="col-md-12">
				<h5 class="text-uppercase"><u><strong>OBJET</strong> : {{ $bon->name }}</u> <br></h5>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				<h5 class="text-uppercase"><u><strong>Direction  :</strong> {{@$bon->fournisseur->name}}</u></h5>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				<h5 class="text-uppercase"><u><strong>Site</strong> : {{ @$bon->chantier->name }}</u></h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered" style="margin-top: 50px;">
					<thead>
						<tr>
							<th>N°</th>
							<th>REFERENCES</th>
							<th>UNITE</th>
							<th>QUANTITE</th>
							<th>COUT</th>
							<th>MONTANT</th>
						</tr>
					</thead>
					<tbody>
						@php $i=1;$montant = 0; @endphp
						@foreach(\App\Bon::where('numero',$bon->numero)->get() as $t)
			              <tr>
			              	<td>{{ $i++ }}</td>
			                <td>{{ @$t->materiel->name }}</td>
			                <td>{{ @$t->materiel->unite }}</td>
			                <td>{{ number_format(@$t->quantite,0,',',' ') }}</td>
			                <td>{{ number_format(@$t->cout,0,',',' ') }}</td>
			                <td>{{ number_format($sum = @$t->quantite * @$t->cout ,0, ',' , ' ')    }}</td>
			              </tr>
			              @php $montant += $sum; @endphp
			              @endforeach
			              <tr>
			              	<th colspan="5" class="text-center">
			              		TOTAL
			              	</th>
			              	<th>
			              		{{ number_format($montant ,0, ',' , ' ') }} FCFA
			              	</th>
			              </tr>
					</tbody>
				</table>
			</div>
		</div>
		{{-- <div class="row" style="margin-top: 50px; margin-bottom: 50px;">
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>DIRECTEUR GENERAL</strong></u></h5>
			</div>
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>DIRECTEUR TECHNIQUE</strong></u></h5>
			</div>
			<div style="width: 33%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>RESPONSABLE APPROVISIONNEMENT</strong></u></h5>
			</div>
		</div> --}}
		@php
		$bon = \App\Bon::where('numero',$bon->numero)->first();
		@endphp
		 	{{ $bon->etat }}
            @if($bon->etat == "attente" )

              @can('valide_bons')
               {!! Form::open(['method' => 'PUT', 'route' => ['bons.update', $bon->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}

              <input type="submit" value="valider" class="btn btn-success" name="etat">
              <input type="submit" value="annuler" class="btn btn-danger" name="etat">
              {!! Form::close() !!}
              @endcan

              @else
              @can('traiter_bons')
                @if($bon->etat == "valider" )
                  <a href="{{ route('bon.traiter',$bon->id) }}" class="btn btn-success" style="padding: 2px 5px;font-size: 10px;">
                    Traiter <i class="fa fa-arrow-right"></i>
                  </a>
                @endif
              @endcan
              @endif
             @if($bon->etat == 'attente' OR Auth::user()->roles()->first()->name == 'admin')
             @can('edit_bons')
            	<a href="{{ route('bons.edit',$bon->id) }}" class="btn btn-info">
              		<i class="fa fa-edit"></i> Modifier
            	</a>
             @endcan

            @endif
		 @can('download_bons')
        @if($bon->etat == 'valider')
          <a href="{{ route('bon.pdf',$bon->id) }}" title="Telecharger le bon" style="padding: 2px 5px;margin-top: 50px;" type="submit" class="btn btn-default">Telecharger le bon</a>
        @endif
        @endcan
</div>

@endsection
@section('scripts')
  <script>
      $('#active-bons').addClass('active');
</script>
@endsection
