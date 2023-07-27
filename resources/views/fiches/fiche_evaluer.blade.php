@extends('layouts.app')

@section('title')
{{ $fiche->name }}- Evaluation
@endsection

@section('contents')
@php

$n = @\App\Personnel::where('id', '>', $personnel->id)->orderBy('id')->first()->id;
$p = @\App\Personnel::where('id', '<', $personnel->id)->orderBy('id','desc')->first()->id;

@endphp
<div class="d-grid gap-2 mb-2" style="margin-bottom: 10px">
    @isset($p)
        <a href="{{route('evaluation.index',[$p,'fiche'=>$fiche->id])}}"  class="btn btn-primary float-right btn-sm">< Précedent</a>
    @endisset
    <span>PERSONNEL</span>
    @isset($n)
    <a href="{{route('evaluation.index',[$n,'fiche'=>$fiche->id])}}"  class="btn btn-primary float-left btn-sm">Suivant ></a>
    @endisset
</div>
<div class="" style="background-color: #fff;padding: 20px;">
@if ($fiche->evaluateurs->contains('user_id',Auth::id()))
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
                            <td width="400">NOM ET PRENOM(S) DE L'EMPLOYE :</td>
                            <td>{{$personnel->nom.' '.$personnel->prenoms}}</td>
                            <td width="300">DIRECTION :</td>
                            <td>{{$personnel->direction}}</td>
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
                <form method="POST" action="{{route('evaluation.index',[$fiche->id,'personnel_id'=>$personnel->id])}}"  role="form" autocomplete="off" onsubmit='return show_alert();'>
                    @csrf
                <div id="printview">
                @foreach ($fiche->categories as $key => $cat)
                <h4  style="margin-top: 50px;">{{ $key + 1 .'-'.$cat->name}}</h4>
				<table class="table table-bordered">
					<thead>
                        <tr>
                            <th rowspan="1">DESIGNATION</th>
							<th rowspan="1">QUALITE</th>
                            {{-- <th colspan="2" class="text-center">{{Auth::user()->nom.' '.Auth::user()->prenom}} </th> --}}

                            <th>NOTE /{{$fiche->notation}}</th>
                            <th>NOTE PONDERE A {{$p = @$fiche->evaluateurs()->where('user_id',Auth::id())->first()->ponderation}}%</th>
						</tr>
					</thead>
					<tbody>
                        <tr>
                            <td rowspan="{{count($cat->criteres) + 1 }}">{{$cat->name}}</td>
                        </tr>
                        @php
                            $sum = $sump = 0;
                        @endphp
                        @foreach ($cat->criteres as $c)
                         <tr>
                            <td>{{$c->name}}</td>
                            <td><input type="number" name="note[{{$c->id}}]" style="width:80px" max="{{$fiche->notation}}" min="0" value="{{$n = @\App\Critere::note(Auth::id(),$personnel->id,$c->id)->note}}" required></td>
                            <td id="{{$c->id}}">{{ $n2 = $p * $n /100 }}</td>
                        </tr>
                        @php
                            $sum += @\App\Critere::note(Auth::id(),$personnel->id,$c->id)->note;
                            $sump += $n2;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-uppercase">MOYENNE NOTE {{$cat->name}} sur {{$fiche->notation}}</th>
                            <th>{{$sum / count($cat->criteres)}}</th>
                            <th>{{ $sum / count($cat->criteres) * $p / 100}}</th>
                        </tr>
                    </tfoot>
				</table>
                @endforeach
                <div class="mb-3" style="margin-bottom: 10px">
                  <label for="" class="form-label">Votre avis</label>
                  <textarea class="form-control" name="avis" rows="3">{{@\App\Critere::note(Auth::id(),$personnel->id,@$fiche->categories()->first()->criteres()->first()->id)->avis}}</textarea>
                </div>
                </div>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Evaluation Terminer</button>
                  {{-- <button type="button" class="btn btn-primary float-right" id="print">Imprimer</button> --}}
                </div>
                </form>
			</div>
		</div>
@else
    Vous n'êtes pas autorisé à noter ce personnel
@endif

</div>
<div class="d-grid gap-2 mb-2" style="margin-bottom: 10px">
    @isset($p)
        <a href="{{route('evaluation.index',[$p,'fiche'=>$fiche->id])}}"  class="btn btn-primary float-right btn-sm">< Précedent</a>
    @endisset
    <span>PERSONNEL</span>
    @isset($n)
    <a href="{{route('evaluation.index',[$n,'fiche'=>$fiche->id])}}"  class="btn btn-primary float-left btn-sm">Suivant ></a>
    @endisset
</div>
@endsection
@section('scripts')

  <script>

    $('#active-personnels').addClass('active');

    $("#print").click(function () {
        const view = document.getElementById("printview");
        const pdf = new jsPDF();

        pdf.fromHTML(view, 15, 15, {
          'width': 170
        });
        pdf.save("fiche.pdf");
    });


</script>
@endsection
