@extends('layouts.app')
@section('title')
Sorties
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
        <div class="panel panel-default  widget">
          <div class="widget-header">
            <div class="additional-btn"  style="left:15px !important; right: none">
               <div class="date-input">
                <form action="" method="GET" style="margin-right: 80px;position: relative;" autocomplete="off">
                    <input type="text" placeholder="Date debut"  value="{{ @$_GET['datedebut'] }}" name="datedebut" required class="datepicker-input">
                    <input type="text" placeholder="Date fin" value="{{ @$_GET['datefin'] }}" name="datefin" required class="datepicker-input">
                    {{-- <input type="text" value="{{ @$cat }}" name="cat" style="display: none;"> --}}
                    <button type="submit" class="btn-default btn" style="display: inline-block; position: absolute;top: 0;right: -35px">ok</button>
                 </form>
              </div>

            </div>
            <h2 class="text-center"><strong>Sortie de Marchandise</strong></h2>

            <div class="additional-btn">
            @can('add_sortiemultiple')
            <a class="btn btn-success text-light" href="{{ route('sortie.multiple') }}" style="color: #fff;">Ajouter Plusieurs</a>
            @endcan
            @can('add_sorties')
            {{-- <button class="btn btn-success" data-target="#newItem" data-toggle="modal">Ajouter</button> --}}

            @endcan
           @can('download_sorties')
           <a type="submit" href="{{ route('sortie.exportXls',['min' => @$_GET['datedebut'],'max'=> @$_GET['datefin' ]]) }}" class="btn btn-default  pull-right"  style="display: inline-block;margin-left: 7px;color:#fff"><i class="fa fa-download"></i> xls</a>
           @endcan
            </div>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              {{-- <form class='form-horizontal' role='form'> --}}
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>N° BON</th>

                              <th>Produit</th>
                              <th>Date</th>
                              {{-- <th>N° Semaine</th> --}}
                              <th>Quantite</th>
                              {{-- <th>Prix Unitaire</th> --}}
                              <th>Utilisation</th>
                              <th>Par</th>

                              <th>Options</th>

                          </tr>
                      </thead>


                      <tbody>
                        @foreach($entres as $entre)

                        @php
                        $transfert = ($entre->transfert_id != 0)?' <strong> (TRANSFERT)</strong>':'';
                        @endphp
                     

                          <tr class="entre">

                              <td>{!! $entre->nfacture.$transfert  !!}</td>

                              <td>{{ @$entre->materiel->name }}</td>
                              <td>{{ date('d/m/Y',strtotime($entre->date_ajout)) }}</td>
                             {{--  <td>
                                {{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}
                              </td> --}}
                              <td>{{ -1*$entre->quantite.' '.@$entre->materiel->unite}}</td>
                              {{-- <td>{{ $entre->prix_uni}}</td> --}}

                              <td>{{ $entre->motif }}
                                @if($entre->transfert_id != 0 )
                                 {{ "Chantier de ".@\App\Chantier::findOrFail($entre->transfert_id)->name }}
                                @endif

                              </td>
                              <td>{{ @$entre->user->name }}</td>
                              <td>
                          <div class="btn-group btn-group-xs">
                            @can('download_sorties')
                             <a href="{{ route('sortie.exportPdf',($entre->nfacture)?$entre->nfacture:0 )}}" title="Telecharger le bon" style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-info"><i class="fa fa-download"></i></a>
                             @endcan
                             @can('edit_sorties')
                           <a href="{{ route('sorties.edit',$entre->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           @endcan
                           @can('delete_sorties')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['entres.destroy', $entre->id] ,'style'=>'display:inline-block !important;margin:0;float:right;margin-left:10px','onsubmit'=>'return show_alert();' ]) !!}
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

    <div class="modal fade" id="newItem">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Sortie de Marchandise</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('sorties.store') }}" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
                @csrf
                <div class="form-group @if($errors->has('nfacture')) has-error @endif">
                    <label for="nfacture">N°BON</label>
                    <input type="text" minlength="4" size="4" class="form-control num" required name ="nfacture" data-inputmask="'mask': '9999'" placeholder="0001" />
                    @if($errors->has('nfacture')) <div class="help-block">
                       {{ $errors->first('nfacture') }}
                    </div>
                    @endif
                  </div>

                <div class="form-group @if($errors->has('type_id')) has-error @endif">
                <label for="type_id">Materiel</label>
                <select class="form-control search_select" required name="materiel_id" style="width: 100%;">
                  <option value=""></option>
                  @foreach($types as $materiel)
                    <option value="{{ $materiel->id }}">{!! $materiel->name .' ('. round ( \App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite'),2) .')'  !!} </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group @if($errors->has('date')) has-error @endif">
              <label for="date">Date</label>
             <input type="text" class="form-control datepicker-input" placeholder="aaaa/mm/jj"  name="date">
                @if($errors->has('date')) <div class="help-block">
                   {{ $errors->first('date') }}
                </div>
              @endif
            </div>

                <div class="form-group @if($errors->has('quantite')) has-error @endif">
                  <label for="quantite">Quantité sortant</label>
                  <input type="number" step="0.01" class="form-control" required name="quantite" value="{{ old('quantite') }}" data-mask="0" placeholder="0">
                  @if($errors->has('quantite')) <div class="help-block">
                     {{ $errors->first('quantite') }}
                  </div>
                @endif
                </div>

           

            <div class="form-group">
              <label for="motif">Utilisation</label>
              <textarea name="motif" id="motif" cols="30" rows="5" class="form-control"></textarea>
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
      $(".num").inputmask({"mask": "9999"});
       $('#active-sorties').addClass('active');
</script>
@endsection
