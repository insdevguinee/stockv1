@extends('layouts.app')
@section('title')
Fournisseurs
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
            <h2 class="text-center"><strong>Liste des Direction</strong></h2>

            <div class="additional-btn">
           <a href="#" data-toggle="modal" data-target="#addfournisseur"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              {{-- <form class='form-horizontal' role='form'> --}}
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Pays</th>
                              <th>Ville</th>
                              <th>Contact</th>
                              <th width="120px"></th>
                          </tr>
                      </thead>


                      <tbody>
                        @foreach($fournisseurs as $fournisseur)
                          <tr class="fournisseur">
                              <td>{{ $fournisseur->name }}</td>
                              <td>{{ @$fournisseur->pays->name }}</td>
                              <td>{{ $fournisseur->ville }}</td>
                              <td>{{ $fournisseur->contact }}</td>
                              <td>
                                <div class="btn-group btn-group-xs"  style="width: 100px;">
                                  <a href="{{ route('fournisseurs.show',$fournisseur->id) }}" class="btn btn-info">
                                    <i class="fa fa-eye"></i> Etat
                                  </a>
                                  @can('edit_fournisseurs')
                                 <a href="{{ route('fournisseurs.edit',$fournisseur->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                 @endcan
                                 @can('delete_fournisseurs')
                                  {!! Form::open(['method' => 'DELETE', 'route' => ['fournisseurs.destroy', $fournisseur->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
                                        <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                      {!! Form::close() !!}
                                  @endcan
                                </div>
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
<!-- Modal -->
<div class="modal fade" id="addfournisseur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Entrée de Marchandise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="basic-form">
                  <form action="{{ route('fournisseurs.store') }}" method="POST" role="form" autocomplete="off">
                        @csrf

                        <div class="form-group @if($errors->has('name')) has-error @endif">
                          <label for="name">Entreprise</label>
                          <input type="text" class="form-control" name ="name"/>
                          @if($errors->has('name')) <div class="help-block">
                             {{ $errors->first('name') }}
                          </div>
                          @endif
                        </div>
                        <div class="form-group">
                          <label for="pays">Pays</label>
                          <select name="pays_id" id="pays" style="width: 100%;" class="form-control">
                            @foreach($pays as $p)
                              <option value="{{$p->id}}" {{ $p->alpha2 =="CI" ? "selected":"" }}>{{$p->nom_fr_fr}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group @if($errors->has('ville')) has-error @endif">
                          <label for="name">Ville</label>
                          <input type="text" class="form-control" name ="ville"/>
                          @if($errors->has('ville')) <div class="help-block">
                             {{ $errors->first('ville') }}
                          </div>
                          @endif
                        </div>
                        <div class="form-group @if($errors->has('contact')) has-error @endif">
                          <label for="contact">Contact</label>
                          <input type="text" class="form-control" name="contact"/>
                          @if($errors->has('contact')) <div class="help-block">
                             {{ $errors->first('contact') }}
                          </div>
                          @endif
                        </div>


                  
                    
                    </div>
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-default">Enregistrer</button>
                  </form>
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
       $('#active-fournisseurs').addClass('active');
</script>
@endsection
