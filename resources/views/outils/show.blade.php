@extends('layouts.app')
@section('title')
Outil {{ $outil->name }}
@endsection

@section('contents')
    <div class="row">
      <h1 class="text-center text-capitalize">{{ $outil->name }}</h1>
      <p class="text-center">{{ ($outil->etat==1)?'Fonctionne':'En panne' }}</p>
       <div class="col-md-8">
          <div class="panel panel-default widget">
            <div class="widget-header">
               <h2>Utilisateurs  </h2>
            </div>
            <div class="panel-body widget-content">
                <div class="table-responsive">
                  <table  id="datatables-1" data-sortable class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prenoms</th>
                        <th>Contact</th>
                        <th>Date utilisée</th>
                        <th>Statut</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($outil->personnels as $personnel)
                        <tr>
                          <td> <a href="#"> {{ $personnel->matricule }} </a> </td>
                          <td>{{ $personnel->nom }}</td>
                          
                          <td>{{ $personnel->prenoms }}</td>
                          {{-- <td>{{ $personnel->mm_numero }}</td> --}}
                          <td>{{ $personnel->contact }}</td>
                          <td>
                            {{ $personnel->pivot->created_at }}
                          </td>
                          <td>
                            @if ($personnel->pivot->selected)
                                
                            <form action="{{ route('assignation.update',[$outil->id]) }}" method="POST">
                              @csrf
                              @method('PUT')
                              <span class="badge badge-info"> Retirer 
                                <input type="submit" name="retirer" class="btn btn-xs btn-danger" value="x">
                                <input type="number" name="personnel" value="{{ $personnel->id }}" style="display: none">
                                <input type="number" name="pivotid" value="{{ $personnel->pivot->id }}" style="display: none">
                              </span>
                            </form>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
        </div>
      <div class="col-md-4">
        <div class="panel panel-default widget">
            <div class="widget-header">
               <h2>Informations</h2>
            </div>
            <div class="panel-body widget-content">
              <div class="card" >
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Nom : </strong>{{ $outil->name }}</li>
                  <li class="list-group-item"><strong>Description : </strong>{{ $outil->description }}</li>
                  <li class="list-group-item"><strong>Etat : </strong>{{ ($outil->etat==1)?'Fonctionne':'En panne' }}</li>
                  <li class="list-group-item"><strong>Quantité : </strong>{{ $outil->qte }}</li>
                  <li class="list-group-item"><strong>En stock : </strong>{{ $outil->qte - @$outil->personnels()->wherePivot('selected',1)->count() }}</li>
                </ul>
              </div>
            </div>
            <div class="panel-footer">
              <a href="{{ route('outils.edit',$outil->id) }}" class="btn btn-default">Modifier</a>
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
       $('#active-outils').addClass('active');
</script>
@endsection
