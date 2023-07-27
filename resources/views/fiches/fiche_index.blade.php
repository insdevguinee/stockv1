@extends('layouts.app')
@section('title')
Fiche Evaluation
@endsection
@section('contents')
    <div class="row">

      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header">
            {{-- <div class="additional-btn"  style="left:15px !important; right: none">
              <form action="" method="GET">
                  <select name="mois" id="mois" class="form-group">
                    @foreach($roles as $role)
                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                  </select>
                  <button type="submit" class="btn btn-default">Selecte</button>
              </form>
            </div> --}}
            <h2 class="text-center"><strong>Liste </strong></h2>
            @can('add_personnels')
            <div class="additional-btn">
           <a href="{{ route('fiches.create') }}"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
            @endcan
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
                <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                        <tr>
                            <th>Année</th>
                            <th>Nom</th>
                            <th>Notation</th>
                            <th>Nbre Evaluateurs</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                </thead>
                <tbody>
                    @foreach ($fiches as $fiche)
                    <tr>
                        <td>{{$fiche->annee}}</td>
                        <td>{{$fiche->name}}</td>
                        <td>sur {{$fiche->notation}}</td>
                        <td>{{@$fiche->evaluateurs->count()}}</td>
                        <td>
                            <a href="{{route('fiches.show',$fiche->id)}}" class="btn btn-default">Consulter</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary">Evaluer le personnel</a>
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['fiches.destroy', $fiche->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
                          <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
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
       $('#active-fiches').addClass('active');
</script>
@endsection
