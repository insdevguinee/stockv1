@extends('layouts.app')
@section('title')
Liste du personnel
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
            <h2 class="text-center"><strong>Liste du personnel</strong></h2>
            @can('add_personnels')
            <div class="additional-btn">
           <a href="{{ route('personnels.create') }}"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
            @endcan
          </div>
          <div class="panel-body">
          <br>
            <div class="">
              {{-- <form class='form-horizontal' role='form'> --}}
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0">
                  <thead>
            <tr>
              <th>Matricule</th>
              <th>Nom</th>
              <th>Prenoms</th>
              {{-- <th>Fonction</th> --}}
              {{-- <th>MOMO_numero</th> --}}
              <th>Contact</th>
              {{-- <th>direction</th> --}}
              {{-- <th>Numero_equipe</th> --}}
              <th>Site</th>
              {{-- <th>Departement</th> --}}
              <th>Poste</th>
              {{-- <th>Outils</th> --}}
              <th>Statut</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($personnels as $personnel)
              <tr>
                <td> <a href="#"> {{ $personnel->matricule }} </a> </td>
                <td>{{ $personnel->nom }}</td>

                <td>{{ $personnel->prenoms }}</td>
                {{-- <td>{{ @$personnel->fonction_id }}</td> --}}
                {{-- <td>{{ $personnel->mm_numero }}</td> --}}
                <td>{{ $personnel->contact }}</td>
                {{-- <td>{{ @$personnel->direction->libelle }}</td> --}}
                {{-- <td>{{ $personnel->numero_equipe }}</td> --}}
                <td>
                  @foreach($personnel->chantiers as $chantier)
                    <span class="badge badge-info">
                      {{ $chantier->name }}
                    </span>
                  @endforeach
                </td>
                <td>{{ @$personnel->departement->name }}</td>
                <td>{{ $personnel->poste }}</td>
                {{-- <td>
                  {{ $personnel->outils->count() }}
                </td> --}}
                <td>
                  <div class="btn-group btn-group-xs"  style="width: 70px;">
                    @can('edit_personnels')
                    <a href="{{ route('personnels.show',$personnel->id) }}" class="btn btn-info" style="padding: 2px 5px;font-size: 10px;">
                      <i class="fa fa-eye"></i>
                    </a>
                   <a href="{{ route('personnels.edit',$personnel->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                   @endcan
                   @can('delete_personnels')
                    {!! Form::open(['method' => 'DELETE', 'route' => ['personnels.destroy', $personnel->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
                          <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    @endcan
                  </div>
                </td>
                <td>
                  @if (@$personnel->user->id)
                  <i class="text-success fa fa-lock fa-2x"></i>    
                  @else
                  <form action="{{route('user.personnel',$personnel->id)}}" method="POST">
                    @csrf
                    <button class="btn btn-default btn-xssle" type="submit">
                      <i class="fa fa-unlock" aria-hidden="true"></i> Compte
                    </button>
                  </form>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
              </table>
             {{ $personnels->links() }}
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
       $('#active-personnels').addClass('active');
</script>
@endsection
