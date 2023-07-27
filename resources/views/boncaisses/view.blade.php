@extends('layouts.app')

@section('title')
{{ $boncaisse->name }}
@endsection
@section('contents')

<div class="" style="background-color: #fff;padding: 20px;">
	<div class="row">
			<div class="col-md-6 float-left">
				<img src="{{ URL::to('assets/img/logo_socoexim.png')}}" style="height: 70px;" alt="Logo">
				<p class="text-justify">Société de Construction et Expertise Immobilière</p>
			</div>
		</div>
		<p class="text-right">Abidjan le {{explode('00:00',\Carbon\Carbon::parse($boncaisse->created_at,'UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]}}</p>
		<h4 class="text-center text-uppercase" style="margin-top: 20px;"><u><strong>BON DE CAISSE N° </strong></u>{{ $boncaisse->numerobon }}</h4>
		<div class="row " style="margin-top: 20px;">
			<div class="col-md-12">
				<h5 class="text-uppercase"><u><strong>OBJET</strong> : {{ $boncaisse->name }}</u> <br></h5>
			</div>
			<div class="col-md-12" style="margin-top: 10px;">
				<h5 class="text-uppercase"><u><strong>CHANTIER</strong> : {{ @$boncaisse->chantier->name }}</u></h5>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label for="">Objet</label>
			  	<div class="form-control">
					{{$boncaisse->name}}
			  	</div>
			</div>

			<div class="form-group col-md-6">
				<label for="">Montant en chiffre</label>
				<div class="form-control">
					{{$boncaisse->cout}} FCFA
				</div>
			</div>

			<div class="col-md-12 form-group">
				<label for="">Objet du reglement</label>
				<div class="form-control">
					{{$boncaisse->motif}}
				</div>
			</div>
			<div class="col-md-12 form-group">
				<label for="">Bénéficiaire</label>
				<div class="form-control">
					@if ($boncaisse->user_id == 0)
						{{$boncaisse->beneficiaire}}
					@else
					{{@$boncaisse->user->nom.' '.@$boncaisse->user->prenoms}}
					@endif
				</div>
			</div>
	   </div>


		<div class="row" style="margin-top: 50px; margin-bottom: 50px;">
			<div style="width: 100%;display: inline-block;">
				<h5 class="text-uppercase text-center"><u><strong>RESPONSABLE</strong></u></h5>
				<p class="text-center">{{ $boncaisse->etat }}</p>
			</div>
		</div>
		
		
		@if($boncaisse->etat == "attente" )

			@can('valide_boncaisses')
			{!! Form::open(['method' => 'PUT', 'route' => ['boncaisses.update', $boncaisse->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}

			<input type="submit" value="valider" class="btn btn-success" name="etat">
			<input type="submit" value="annuler" class="btn btn-danger" name="etat">
			{!! Form::close() !!}
			@endcan


		@endif
			
		@if($boncaisse->etat == 'attente' OR Auth::user()->roles()->first()->name == 'admin')
			{{-- @can('edit_boncaisses')
			<a href="{{ route('boncaisses.edit',$boncaisse->id) }}" class="btn btn-info">
				<i class="fa fa-edit"></i> Modifier
			</a>
			@endcan --}}
		@endif
		 @can('download_boncaisses')
			@if($boncaisse->etat == 'valider')
			<a href="{{ route('boncaisse.pdf',$boncaisse->id) }}" title="Telecharger le bon" style="padding: 2px 5px;margin-top: 50px;" type="submit" class="btn btn-default">Telecharger le bon</a>
			@endif
        @endcan
</div>

@endsection
@section('scripts')
  <script>
      $('#active-boncaisses').addClass('active');
</script>
@endsection
