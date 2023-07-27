@extends('layouts.app')
@section('title')
Assignation
@endsection


@section('contents')
<style>
  .datepicker.dropdown-menu{
      z-index: 10000;
      top: 0;
  }
</style>
    <div class="row">
      <div class="col-md-12 portlets ui-sortable">
        <div class="panel panel-default widget">
          <div class="widget-header">
           
            <h2 class="text-center"><strong>Assigner un outil à une personne</strong> <a href="#" data-target="#assiger" data-toggle="modal" class="btn btn-sm btn-info pull-right">Assigner</a></h2>

          </div>
          <div class="panel-body">
             <div class="table-responsive">
              <table  id="datatables-1" data-sortable class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Categorie</th>
                    <th>Appareils</th>
                    <th>Qte/Reste</th>
                    <th>Numero de Serie / Code</th>
                    <th>Etat</th>
                    <th width="100">Utilisateurs</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($outils as $outil)
                    @php 
                     $stock = $outil->qte - $outil->personnels()->wherePivot('selected',1)->count() ;
                    @endphp
                  <tr>
                    <td>{{ @$outil->categorie->name }}</td>
                    <td>{{ $outil->name }}</td>
                    <td>{{ $outil->qte.' / '.$stock}}</td>
                    <td>{{ $outil->description }}</td>
                    <td>{{ ($outil->etat==1)?'Fonctionne':'En panne' }}</td>
                    <td>
                      {{-- <form action="{{ route('assignation.update',[$outil->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                      @foreach($outil->personnels()->get() as $personnel)
                        <span class="badge badge-info">{{ $personnel->matricule.' ('.$personnel->nom.' '.$personnel->prenoms.')' }} 
                          <input type="submit" name="retirer" class="btn btn-xs btn-danger" value="x">
                          <input type="number" name="personnel" value="{{ $personnel->id }}" style="display: none">
                        </span>
                      @endforeach --}}
                      {{ $outil->personnels->count() }}
                    </td>
                    <td>
                      <a href="{{ route('outils.show',$outil->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    </td>
                  </tr>
                 </form>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="assiger">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Fermer</span>
            </button>
            <h4 class="modal-title">Effectuer une assignation</h4>
          </div>
          <form action="{{ route('assignation.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
             {{--    
                  <div class="form-group col-md-2">
                    <label>Qte</label><br>
                    <input type="number" min="1" class="form-control" name="qte" style="width: 100%;">
                  </div> --}}

                  <div class="col-md-6">
                    <label for="">Appareil</label><br>
                    <select name="outil" class="form-control text-capitalize" style="width: 100%;">
                      @foreach($outils as $outil)
                      @if($outil->personnels()->wherePivot("selected",1)->count() < $outil->qte)
                      
                      <option value="{{ $outil->id }}">{{ $outil->name.' ('.$outil->description.')' }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                    <div class="col-md-6 form-group">
                    <label for="">Utilisateur</label><br>
                    <select name="personnel" class="form-control text-capitalize" style="width: 100%;">
                      @foreach($personnels as $personnel)
                      <option value="{{ $personnel->id }}">
                        {{ "(".$personnel->matricule.') '.$personnel->name.' '.$personnel->prenoms }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Assigner</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('scripts')
  <!-- Page Specific JS Libraries -->
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>

  <script src="{{ URL::to('assets/js/pages/inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/jquery.inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
  <script>
       $('#active-assignation').addClass('active');
  </script>
@endsection


