@extends('layouts.app')

@section('title')
{{ $fiche->name }}
@endsection
@section('contents')

<div class="" style="background-color: #fff;padding: 20px;">
    	<div class="row">
			<div class="col-md-6 float-left">
				<img src="{{ URL::to('assets/img/logo_socoexim.png')}}" style="height: 70px;" alt="Logo">
				<p class="text-justify">Société de Construction et Expertise Immobilière</p>
			</div>
		</div>
		<p class="text-right">Année : {{$fiche->annee}}</p>
		<h4 class="text-center text-uppercase" style="margin-top: 20px;">FICHE : {{$fiche->name}}</h4>
        <div class="row">
            <div class="col-md-12" style="margin-top: 50px;">
                <table class="table table-bordered">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td width="400">NON ET PRENOM(S) DE L'EMPLOYE :</td>
                            <td></td>
                            <td width="300">DIRECTION :</td>
                            <td></td>
                            <td></td>
                            <td width="100">DATE</td>
                        </tr>
                        <tr>
                            <td>NATURE DU CONTRAT / DATE DE SIGNATURE :</td>
                            <td></td>
                            <td>FONCTION :</td>
                            <td></td>
                            <td></td>
                            <td>{{date('d-m-y')}}</td>
                        </tr>
                        <tr>
                            <td>Catégorie :</td>
                            <td></td>
                            <td>SERVICE </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Matricule:</td>
                            <td></td>
                            <td>DUREE </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
                @foreach ($fiche->categories as $key => $cat)
                <h4  style="margin-top: 50px;">{{ $key + 1 .'-'.$cat->name}}</h4>
				<table class="table table-bordered">
					<thead>
                        <tr>
                            <th rowspan="2">DESIGNATION</th>
							<th rowspan="2">QUALITE</th>
                            @foreach ($fiche->evaluateurs as $k => $e)
                                <th colspan="2">EVALUATEUR {{$k+1}}</th>
                            @endforeach
							<th rowspan="2">NOTE FINALE</th>
						</tr>
                        <tr>
                            @foreach ($fiche->evaluateurs as $k => $e)
                                <th>NOTE /{{$fiche->notation}}</th>
                                <th>NOTE PONDERE A {{$e->ponderation.'%'}}</th>
                            @endforeach
						</tr>
					</thead>
					<tbody>
                        <tr>
                            <td rowspan="{{count($cat->criteres) + 1 }}">{{$cat->name}}</td>
                        </tr>
                        @foreach ($cat->criteres as $c)
                         <tr>
                            <td>{{$c->name}}</td>
                            @foreach ($fiche->evaluateurs as $e)
                            <td></td>
                            <td>0</td>
                            @endforeach

                            <td>0</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-uppercase">MOYENNE NOTE {{$c->name}} sur {{count($cat->criteres) * $fiche->notation}}</th>
                            @foreach ($fiche->evaluateurs as $e)
                            <th></th><th></th>
                            @endforeach
                            <th></th>
                        </tr>
                    </tfoot>
				</table>
                @endforeach
			</div>
		</div>


</div>

@endsection
@section('scripts')
  <script>
      $('#active-fiches').addClass('active');
</script>
@endsection
