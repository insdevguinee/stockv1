@extends('layouts.app')
@section('title')
Demandes
@endsection
 @php $array[]= Null @endphp

@section('contents')
    <div class="row">

      <div class="col-md-12">
        <div class="panel panel-default  widget">
          <div class="widget-header">
            <h2 class="text-center"><strong>BONS DE CAISSE {{@$_GET['boncaisses']}}</strong></h2>
            @can('add_boncaisses')
            <div class="additional-btn">
             <a href="{{ route('boncaisses.create') }}"><button class="btn btn-success pull-right">Faire un bon de caisse</button></a>
            </div>
            @endcan
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              {{-- <form class='form-horizontal' role='form'> --}}
              <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                            <th>BON DE CAISSE</th>
                            <th>NUMERO BON</th>
                            <th>Date de demande</th>
                            <th>Bénéficiaire</th>
                            <th>Montant</th>
                            <th width="100px">Etat</th>
                            <th>Valider par</th>
                            <th></th>
                          </tr>
                      </thead>

                      <tbody>
                        @foreach($boncaisses as $boncaisse)
                          <tr class="bon">
                              <td>{{$boncaisse->name}}</td>
                              <td>{{$boncaisse->numerobon}}</td>
                              <td>{{$boncaisse->created_at}}</td>
                              <td>
                                @if ($boncaisse->user_id == 0)
                                    {{$boncaisse->beneficiaire}}
                                @else
                                {{@$boncaisse->user->nom.' '.@$boncaisse->user->prenoms}}
                                @endif
                              </td>
                              <td>{{$boncaisse->cout}} FCFA</td>
                              <td>{{$boncaisse->etat}}</td>
                              <td>{{@$boncaisse->valide->nom.' '.@$boncaisse->valide->prenom}}</td>
                              <td>
                                <a href="{{ route('boncaisses.show',$boncaisse->id) }}" class="btn btn-info btn-xs" >
                                  <i class="fa fa-eye"></i>
                                </a>
                              </td>
                          </tr>
                        @endforeach

                      </tbody>
                  </table>
              {{-- </form> --}}
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
    $(document).ready(function() {
        $('#datatables').DataTable( {
            "order": [[ 1, "desc" ]]
        } );
    } );

        $('#active-boncaisses').addClass('active');
</script>
@endsection
@section('style')
<style>
  .attente{
    background-color: orange;
    color: #fff;
  }
  .annuler{
    background-color: red;
    color: #fff;
  }
  .valider{
    background-color: green;
    color: #fff;
  }
  .terminer{
    background-color: gray;
    color: #fff;
  }
</style>
@endsection
