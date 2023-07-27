@extends('layouts.app')
@section('title')

@endsection


@section('contents')
<style>
  .datepicker.dropdown-menu{
      z-index: 10000;
      top: 0;
  }
</style>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default widget">
          <div class="widget-header">
            <div class="additional-btn"  style="left:15px !important; right: none">
              <div class="date-input">
                <form action="" method="GET" style="margin-right: 80px;position: relative;" autocomplete="off">
                    <input type="text" placeholder="Date debut"  value="{{ @$_GET['datedebut'] }}" name="datedebut" required class="datepicker-input">
                    <input type="text" placeholder="Date fin" value="{{ @$_GET['datefin'] }}" name="datefin" required class="datepicker-input">
                    <button type="submit" class="btn-default btn" style="display: inline-block; position: absolute;top: 0;right: -35px">ok</button>
                 </form>
              </div>
            </div>
            <h2 class="text-center"><strong>Retour de Materiel</strong></h2>
            <div class="additional-btn">
            @can('add_entremultiple')
           {{--  <a class="btn btn-success text-light" href="{{ route('entre.multiple') }}" style="color: #fff;">Ajouter Plusieurs</a> --}}
            @endcan
            @can('add_entres')
            <button class="btn btn-success" data-target="#exampleModalLong" data-toggle="modal">Retour</button>
            @endcan
            @can('download_entres')
            <a type="submit" href="{{ route('entre.exportXls',['min' => @$_GET['datedebut'],'max'=> @$_GET['datefin' ]]) }}" class="btn btn-default  pull-right"  style="display: inline-block;margin-left: 7px;color:#fff"><i class="fa fa-download"></i> xls</a>
            @endcan
            {{-- <button type="submit" class="btn btn-default  pull-right"  style="display: inline-block;margin-left: 7px;"><i class="fa fa-download"></i> pdf</button> --}}
            </div>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>N° BON</th>

                        <th>Produit</th>
                        <th>Date</th>
                        {{-- <th>N° Semaine</th> --}}
                        <th>Quantite</th>
                        <th>Etat</th>
                        <th>Fournisseur</th>
                        <th>Details</th>
                        <th>Par</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($entres->sortByDesc('id') as $entre)
                    @php
                        $transfert = ($entre->transfert_id != 0)?' <strong> (TRANSFERT)</strong>':'';
                        @endphp
                     
                    <tr class="entre">
                       <td>{!! $entre->nfacture.$transfert  !!}</td>

                        <td>{{ @$entre->materiel->name }}</td>
                        <td>{{ date('d/m/Y',strtotime($entre->date_ajout)) }}</td>
                        {{-- <td>
                          {{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}
                        </td> --}}
                        <td>{{ $entre->quantite.' '.@$entre->materiel->unite.'(s)'}}</td>
                        <td>{{ ($entre->pu==0)?'Fonctionne':'En panne' }}</td>
                      
                        <td>
                          @if($entre->transfert_id == 0)
                          <a href="{{ route('fournisseurs.show', @$entre->fournisseur->id) }}">{{ @$entre->fournisseur->name }}</a>
                          @else
                          {{"Sous p ".\App\Chantier::findOrFail($entre->transfert_id)->name }}
                          @endif
                        </td>
                        <td>{{ $entre->motif }}</td>
                        <td>{{ @$entre->user->name }}</td>
                        <td>
                          <div class="btn-group btn-group-xs">
                            @can('edit_entres')
                           <a href="{{ route('entres.edit',$entre->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           @endcan
                           @can('delete_entres')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['entres.destroy', $entre->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
                                  <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                              @endcan
                          </div>
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
<!-- Modal -->
<div class="modal fade" id="exampleModalLong">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Retour de Matériel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form action="{{ route('entres.store') }}" method="POST" role="form" autocomplete="off">
              @csrf
              <div class="form-group @if($errors->has('nfacture')) has-error @endif">
                <label for="nfacture">Option de retour</label>
              
                <select name="nfacture"  id="numbon" style="width: 100%;" class="form-control">
                  <option value="retour">Retour</option>
                  {{-- @foreach(\App\Bon::where([['chantier_id','=',session('chantier')],['etat',"=","valider"]])->orderBy('numerobon','desc')->groupBy('numerobon')->distinct()->get('numerobon') as $bon)
                  <option value="{{ $bon->numerobon }}">{{ $bon->numerobon }}</option>
                  @endforeach --}}
                </select>
              </div>
              <div class="form-group @if($errors->has('type_id')) has-error @endif">
              <label for="type_id">Materiel</label>
              <select  class="form-control" style="width: 100%;" name="materiel_id">
                <option value=""></option>
                @foreach($types as $type)
                  <option value="{{ $type->id }}">{{ $type->name.' ('.\App\Entre::where([['materiel_id','=',$type->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite') .')' }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group @if($errors->has('date')) has-error @endif">
            <label for="date">Date</label>
            <input type="text" class="form-control datepicker-input" placeholder="aaaa-mm-jj"  name="date">
              @if($errors->has('date')) <div class="help-block">
                 {{ $errors->first('date') }}
              </div>
              @endif
              </div>

                <div class="form-group @if($errors->has('quantite')) has-error @endif">
                  <label for="quantite">Quantité</label>
                  <input type="number" step="0.01" class="form-control" name="quantite" data-mask="0" placeholder="0">
                  @if($errors->has('quantite')) <div class="help-block">
                     {{ $errors->first('quantite') }}
                  </div>
                @endif
                </div>

              <div class="form-group @if($errors->has('fourni')) has-error @endif">
              <label for="fourni">Direction</label>
              {{-- <input type="text" class="form-control" name ="fourni"> --}}
              <select name="fourni" style="width: 100%;" class="form-control">
                @foreach($fournisseurs as $fournisseur)
                  <option value="{{$fournisseur->id}}">{{$fournisseur->name}}</option>
                @endforeach
              </select>
              @if($errors->has('fourni')) 
              <div class="help-block">
                 {{ $errors->first('fourni') }}
              </div>
              @endif
              </div>

              <div class="form-group">
              <label for="pu">Etat</label>
              <select name="pu" style="width: 100%;" class="form-control" >
                <option value="0" selected> Fonctionnel</option>
                <option value="1"> En panne</option>
              </select>
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" rows="5"></textarea>
              </div>
               <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-default">Enregistrer</button>
        </form>
        
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

  <script src="{{ URL::to('assets/js/pages/inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/jquery.inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
  <script>
      $(":input").inputmask();
      $(".numero").inputmask({"mask": "9999/9999"});
      $('#active-generation').addClass('active');
</script>
@endsection
