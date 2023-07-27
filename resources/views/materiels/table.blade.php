@extends('layouts.app')

@section('title')
  Materiels
@endsection
@section('contents')
  <div class="row">
      @can('add_materiels')
      <div class="col-md-8">
      @else
      <div class="col-md-12">
      @endcan
        <div class="panel">
          <div class="widget-header transparent">
             

          </div>
          <div class="panel-body widget-content">
            
            <div class="table-responsive">
              <table  id="datatables-1" data-sortable class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                   <th>Nom</th>
                   <th>Categorie</th>
                   <th>Unité</th>
                   <th>Code i</th>
                    <th>Crée</th>
                    <th> <span class="badge-primary badge" >{{ @$types->count() }}</span></th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($types as $type)
                  <tr>
                    <td>
                      {{ $type->id }}
                    </td>
                   

                    <td>
                      {{ $type->name }}
                    </td>
                    <td>
                      {{ @$type->categorie->name }}
                    </td>
                    <td>
                      {{ $type->unite }}
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      {{ date('d/m/Y',strtotime($type->updated_at)) }}
                    </td>
                    <td>
                      <div class="btn-group btn-group-xs">
                         @can('edit_materiels')
                           <a href="{{ route('materiels.edit',$type->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           @endcan
                        @can('delete_materiels')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['materiels.destroy', $type->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
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
@can('add_materiels')
<div class="col-md-4">
  <div class="widget clearfix">
    <div class="widget-header transparent clearfix">
      <h2 class="text-center"><strong>Ajouter</strong> un materiel</h2>

    </div>
    <div class="widget-content padding clearfix">
      <div id="basic-form">
        <form action="{{ route('materiels.store') }}" method="POST" role="form" onsubmit='return show_alert();'>
        @csrf

        <div class="form-group @if($errors->has('name')) has-error @endif">
          <label>Designation</label>
          <input type="text" class="form-control"  name="name">

        </div>

        <div class="form-group ">
        <label>Categorie</label>
        <select name="categorie" id="categorie" class="form-control">
          @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
          @endforeach
        </select>

        <div class="form-group ">
        <label>Unité</label>
          <input type="text" class="form-control"  name="unite">
        </div>
        <div class="form-group ">
        <label>Code</label>
          <input type="text" class="form-control"  name="unite">
        </div>
      <button type="submit" class="btn btn-success pull-left">Enregistrer</button>
    </form>
  </div>
</div>




          </div>
    </div>
    @endcan
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
       $('#active-entres-table').addClass('active');
</script>
@endsection