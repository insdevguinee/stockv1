@extends('layouts.app')

@section('title')
  Outils de Travail
@endsection
@php $i = 1; @endphp
@section('contents')
  <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default widget">
          <div class="widget-header">
             <h2>Outils de travail  </h2>

          </div>
          <div class="panel-body widget-content">
            <div class="table-responsive">
              <table  id="datatables-1" data-sortable class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Categorie</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Etat</th>
                    <th>Numero de serie / Code</th>
                    <th> <span class="badge-primary badge" >{{ @$outils->count() }}</span></th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($outils->sortByDesc('id') as $outil)
                  <tr>
                    <td>
                      {{ $i++ }}
                    </td>
                    <td>
                      {{ @$outil->categorie->name }}
                    </td>
                    <td>{{ $outil->name }}</td>
                    <td>{{ $outil->qte }}</td>
                    <td>
                      {{ ($outil->etat==1)?'Fonctionne':'En panne' }}
                    </td>
                    <td>
                      {{ @$outil->description }}
                    </td>
                    <td>

                      <div class="btn-group btn-group-xs">
                        <a href="{{ route('outils.show',$outil->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                         @can('edit_outils')
                           <a href="{{ route('outils.edit',$outil->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           @endcan
                        @can('delete_outils')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['outils.destroy', $outil->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
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
{{-- @can('add_outils') --}}
<div class="col-md-4">
  <div class="widget clearfix">
    <div class="widget-header transparent clearfix">
      <h2 class="text-center"><strong>Ajouter</strong> un Outil de travail</h2>

    </div>
    <div class="widget-content padding clearfix">
      <div id="basic-form">
        <form action="{{ route('outils.store') }}" method="POST" role="form">
        @csrf

        <div class="form-group @if($errors->has('name')) has-error @endif">
          <label>Nom</label>
          <input required type="text" class="form-control"  name="name">
        </div>
         <div class="form-group ">
        <div class="form-group">
          <label>Quantité</label>
          <input type="number" class="form-control" name="qte">
        </div>
        <label>Categorie</label>
        <select name="categorie" id="categorie" class="form-control" required>
          @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
          @endforeach
        </select>
        </div>
        <div class="form-group ">
        <label>Nuemro de Serie / Description</label>
          <textarea class="form-control"  name="description" required></textarea>
        </div>
      <button type="submit" class="btn btn-success pull-left">Enregistrer</button>
    </form>
  </div>
</div>




          </div>
    </div>
    {{-- @endcan --}}
    </div>
@endsection
@section('scripts')
<script src="{{ URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>

   <script src="{{ URL::to('assets/js/pages/inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/jquery.inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
<script>
       $('#active-outils').addClass('active');
</script>
@endsection