@extends('layouts.app')

@section('title')
  Demandes
@endsection
@section('contents')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default  widget">
            <div class="panel-body">
                  <div class="table-responsive">
                    <table  id="datatables-1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Demande</th>
                                <th>Motif</th>
                                <th width="230px">Date</th>
                                <th>Demandeur</th>
                                <th>Etat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandes as $demande)
                                
                            <tr>
                                <td scope="row">{{$demande->type}}</td>
                                <td>{{$demande->titre}}</td>
                                <td>{{$demande->message}}</td>
                                <td>{{$demande->date_d.' - '.$demande->date_f}}</td>
                                <td>
                                    <a @if (@$demande->user->personnel_id)  href="{{ route('personnels.show',@$demande->user->personnel_id) }}"  @endif>
                                        {{@$demande->user->nom.' '.@$demande->user->prenom}}
                                    </a>
                                </td>
                                <td>{{$demande->status}}</td>
                                <td>
                                    
                                    @if ($demande->status == "en attente")
                                        <form action="{{route('demande.reponse',[$demande->id,'r'=>1])}}"  method="POST" onsubmit='return show_alert();'>
                                            @csrf
                                            <button class="btn btn-success btn-xs">Accorder</button>
                                        </form>
                                        <form action="{{route('demande.reponse',[$demande->id,'r'=>0])}}" method="POST" onsubmit='return show_alert();'>
                                            @csrf
                                            <button class="btn btn-warning btn-xs">Refuser</button>
                                        </form>
                                    @endif

                                    <a href="{{route('demande.pdf',$demande->id)}}" class="btn btn-default btn-xs">
                                        Télechargement
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
      
</div>
@endsection
@section('scripts')
  <!-- Page Specific JS Libraries -->
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
  <script>
       $('#active-demandes').addClass('active');
</script>
@endsection