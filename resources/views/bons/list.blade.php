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
            <h2 class="text-center"><strong>Liste des demandes</strong></h2>
            @can('add_bons')
            <div class="additional-btn">
             <a href="{{ route('bons.create') }}"><button class="btn btn-success pull-right">Ajouter</button></a>
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
                            <th>BON</th>
                            <th>NUMERO BON</th>
                            <th>Date execution</th>
                            <th>Utilisateur</th>
                            <th>Materiel</th>
                            <th>Site</th>
                            <th width="100px">Etat</th>
                            <th>Direction</th>
                            {{-- @if(!Auth::user()->hasRole('manager|Manager')) --}}
                            <th></th>
                            {{-- @endif --}}
                          </tr>
                      </thead>


                      <tbody>
                        @foreach($bons->unique('numero') as $bon)
                          {{-- @if(!in_array($bon->numero, $array)) --}}
                          <tr class="bon">

                              <td class="{{ $bon->etat }}">{{ $bon->name }}</td>
                              <td>{{ $bon->numerobon }}</td>
                              <td> {{-- {{explode('00:00',\Carbon\Carbon::parse('06-10-2020','UTC')->locale('fr_FR')->isoFormat('LLLL'))[0]}} <br> {{ $bon->date_execution }} --}}{{$bon->date_execution}}</td>
                              <td>Commande de : {{ @$bon->user->name }} <br> Traité par : {{ @$bon->manager->name }}</td>
                              <td>
                                <table class="table table-bordered">
                                  <tbody>
                                      @foreach(\App\bon::where('numero',$bon->numero)->where('chantier_id',session('chantier'))->get() as $t)
                                      <tr>
                                        <td>{{ @$t->materiel->name }}</td>
                                        <td>{{ @$t->quantite }}</td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                              </td>
                              <td>{{ @$bon->chantier->name }}</td>
                              <td>
                                 <span class="badge-primary badge {{ $bon->etat }}"> {{ $bon->etat }}</span>
                                 <hr>
                                @if($bon->etat == "attente" )

                                  {{-- @if(Auth::user()->hasRole('admin|Admin|Manager|manager')) --}}
                                  @can('valide_bons')
                                   {!! Form::open(['method' => 'PUT', 'route' => ['bons.update', $bon->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
                                  {{-- <input type="text" class="form-control" name="motif"> --}}

                                  <input type="submit" value="valider" class="btn btn-success btn-xs"  name="etat">
                                  <input type="submit" value="annuler" class="btn btn-danger btn-xs"  name="etat">
                                  {!! Form::close() !!}
                                  @endcan

                                  @else

                                    @if($bon->etat == "valider" )
                                      @if($bon->etat != 'terminer')
                                        @can('traiter_bons')
                                          <a href="{{ route('bon.traiter',$bon->id) }}" class="btn btn-success" >
                                            Traiter <i class="fa fa-arrow-right"></i>
                                          </a>
                                          {{-- <hr> --}}
                                    {!! Form::open(['method' => 'PUT', 'route' => ['bons.update', $bon->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}

                                  <input type="submit" value="terminer" class="btn btn-default" name="etat">
                                  {!! Form::close() !!}

                                        @endcan
                                      @endif
                                    @endif

                                  @endif
                              </td>
                              <td><a href="{{ route('fournisseurs.show', @$bon->fournisseur->id) }}">{{ @$bon->fournisseur->name }}</a></td>
                              {{-- @if(!Auth::user()->hasRole('manager|Manager')) --}}
                              <td>
                                <a href="{{ route('bons.show',$bon->id) }}" class="btn btn-info btn-xs" >
                                  <i class="fa fa-eye"></i>
                                </a>

                                @if($bon->etat != "terminer" AND $bon->etat != "valider" )
                                  @if($bon->etat == 'attente' OR Auth::user()->roles()->first()->name == 'admin' OR $bon->etat =="annuler")

                                    @can('edit_bons')
                                    <a href="{{ route('bons.edit',$bon->id) }}" class="btn btn-outline-info btn-xs" >
                                      <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan

                                    @can('delete_bons')
                                    <div class="btn-group ">
                                     {{-- <a href="{{ route('bons.edit',$bon->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a> --}}
                                      {!! Form::open(['method' => 'DELETE', 'route' => ['bons.destroy', $bon->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
                                            <button  type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                          {!! Form::close() !!}
                                    </div>
                                    @endcan
                                  @endif
                                @endif
                                @can('download_bons')
                                @if($bon->etat == 'valider' OR $bon->etat == 'terminer')
                                  <a href="{{route('bon.pdf',$bon->id)}}" title="Telecharger le bon"  class="btn btn-default btn-xs"><i class="fa fa-download"></i></a>
                                @endif
                                @endcan
                              </td>
                              {{-- @endif --}}
                          </tr>
                          {{-- @endif --}}
                          {{-- @php $array[]=$bon->numero @endphp --}}

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

        $('#active-bons').addClass('active');
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
