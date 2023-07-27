@extends('layouts.app')
@section('title')
Liste du personnel
@endsection
@section('contents')
@php

$n = @\App\Personnel::where('id', '>', $personnel->id)->orderBy('id')->first()->id;
$p = @\App\Personnel::where('id', '<', $personnel->id)->orderBy('id','desc')->first()->id;

@endphp
<div class="row">
    <div class="col-md-12">
        <div class="d-grid gap-2" style="margin-bottom: 10px">
            @isset($p)
                <a href="{{route('personnels.show',$p)}}" class="btn btn-primary float-right btn-sm">< Précedent</a>
            @endisset
            <span class="">PERSONNEL</span>
            @isset($n)
            <a href="{{route('personnels.show',$n)}}" class="btn btn-primary float-left btn-sm">Suivant ></a>
            @endisset
        </div>
        <div class="panel">
            <div class="panel-body">

                @if (Auth::user()->hasRole('admin|ADMIN') AND $personnel->numero_equipe !=1)

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                      Nommer responsable du departement
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('personnels.update',$personnel->id) }}" method="POST" role="form">
                                    @method('PUT')
                                    @csrf

                                <div class="modal-body">
                                    <input type="number" value="1" name="numero_equipe" style="display: none">
                                    {{$personnel->nom." ".$personnel->prenoms}} responsable du département {{@$personnel->departement->name}}

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Confirmer</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endif
                @if ($personnel->numero_equipe == 1)
                    <span class="">Responsable du département</span>
                @endif
                <h5>Matricule : {{$personnel->matricule}} | Email : {{$personnel->email}} | Departement : {{@$personnel->departement->name}}</h5>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="bg-gray">NOM</th>
                                <td class="text-uppercase">{{$personnel->civilite.'. '.$personnel->nom}}</td>
                                <th scope="row" class="bg-gray">PRENOM(S)</th>
                                <td  class="text-uppercase">{{$personnel->prenoms}}</td>
                                <th scope="row" class="bg-gray">DATE NAISSANCE</th>
                                <td  class="text-uppercase">{{$personnel->naissance}}</td>
                            </tr>
                            <tr>

                                <th scope="row" class="bg-gray">DATE EMBAUCHE</th>
                                <td  class="text-uppercase">{{$personnel->embauche}}</td>
                                <th scope="row" class="bg-gray">POSTE</th>
                                <td  class="text-uppercase">{{$personnel->poste}}</td>
                                <th scope="row" class="bg-gray">SALAIRE BRUT</th>
                                <td  class="text-uppercase">{{$personnel->salaire}}</td>

                            </tr>
                            <tr>

                            </tr>
                            <tr>
                                <th scope="row" class="bg-gray">NATIONNALITÉ</th>
                                <td  class="text-uppercase">{{$personnel->nationnalite}}</td>
                                <th scope="row" class="bg-gray">LIEU NAISSANCE</tH>
                                <td  class="text-uppercase">{{$personnel->lieu_n}}</td>
                                <th scope="row" class="bg-gray">ADRESSE</th>
                                <td  class="text-uppercase">{{$personnel->adresse}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-gray">SITUATION MATRIMONIALE</tH>
                                <td  class="text-uppercase">{{$personnel->st_matri}}</td>
                                <th scope="row" class="bg-gray">NBRE ENFANT</th>
                                <td  class="text-uppercase">{{$personnel->enfant}}</td>
                                 <th scope="row" class="bg-gray">
                                    CONTRAT
                                 </th>
                                <td  class="text-uppercase">
                                    {{@$personnel->contrat_id}}
                                </td>
                            </tr>
                             <tr>
                                <th scope="row" class="bg-gray">CONTACT</tH>
                                <td  class="text-uppercase">{{$personnel->contact}}</td>

                                <th scope="row" class="bg-gray">N°CNPS</tH>
                                <td  class="text-uppercase">{{$personnel->cnps}}</td>
                                <th scope="row" class="bg-gray">N°CMU</th>
                                <td  class="text-uppercase">{{$personnel->cmu}}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-center">
                                     <a href="{{route('personnels.edit',$personnel->id)}}" class="btn btn-default">Modifier</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Fiche d'evaluation</th>
                                <th scope="col"></th>
                                <th scope="col">Evaluer</th>
                                <th scope="col">Consulter</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fiches as $f)
                            <tr class="">
                                <td scope="row">
                                   {{$f->name.' - '.$f->annee}}
                                </td>
                                <td>
                                    <form method="POST" action="{{route('emailnote.send',[$personnel->id,$f->id])}}" style='display:inline-block !important;margin:0;float:right;' onsubmit='return show_alert();'>
                                        @csrf
                                         <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-info btn-xs">Email</button>
                                    </form>
                                </td>
                                <td>
                                    @if ($f->evaluateurs->contains('user_id',Auth::id()))
                                    <a href="{{route('evaluation.index',[$personnel->id,'fiche'=>$f->id])}}" class="btn btn-default btn-sm btn-xs"> Noter </a>
                                    @endif
                                </td>
                                <td class="">
                                    <a href="{{route('evaluation.show',[$personnel->id,'fiche'=>$f->id])}}" class="btn btn-default btn-sm btn-xs"> Afficher </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div> <!-- end row -->


@endsection
@section('scripts')
  <!-- Page Specific JS Libraries -->
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
  <script>
       $('#active-personnels').addClass('active');
</script>
@endsection
