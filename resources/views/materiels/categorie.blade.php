@extends('layouts.app')

@section('title')
  Categorie
@endsection
@section('contents')
  <div class="row">
    @can('add_categories')
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
                   <th>Type</th>
                   <th>Description</th>
                    <th> <span class="badge-primary badge" >{{ @$categories->count() }}</span></th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($categories as $type)
                  <tr>
                    <td>
                      {{ $type->id }}
                    </td>
                   
                   
                    <td>
                      {{ $type->name }}
                    </td>
                     <td>
                      {{ $type->type }}
                    </td>
                    <td>
                      {{ @$type->description }}
                      @foreach($type->childs as $child)
                        <span class="badge badge-info">{{ $child->name }}  
                          @can('edit_categories')
                           <a href="{{ route('categories.edit',$child->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                          @endcan
                          @can('delete_categories')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $child->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
                                  <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                        @endcan</span>
                      @endforeach
                    </td>
                    <td>
                      <div class="btn-group btn-group-xs">
                         @can('edit_categories')
                           <a href="{{ route('categories.edit',$type->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           @endcan
                        @can('delete_categories')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $type->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
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
@can('add_categories')
<div class="col-md-4">
      <div class="widget clearfix">
        <div class="widget-header transparent clearfix">
          <h2 class="text-center"><strong>Ajouter</strong> une Categorie</h2>

        </div>
        <div class="widget-content padding clearfix">
          <div id="basic-form">
            <form action="{{ route('categories.store') }}" method="POST" role="form" onsubmit='return show_alert();'>
            @csrf

            <div class="form-group @if($errors->has('name')) has-error @endif">
              <label>Nom</label>
              <input type="text" class="form-control"  name="name">

            </div>
            <div class="form-group">
              <select name="type" class="form-control">
                <option value="0" selected>Pour les materiaux</option>
                <option value="1">Outils pour le travail</option>
              </select>
            </div>
            <div class="form-group ">
            <label>Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
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
       $('#active-categories').addClass('active');
</script>
@endsection