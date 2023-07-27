@extends('layouts.app')

@section('title')
  Liste des permissions
@endsection
@section('contents')

      <div class="row">
        @if (session('status'))
          <div class="row">
            <div class="col-sm-12">
              <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="material-icons">close</i>
                </button>
                <span>{{ session('status') }}</span>
              </div>
            </div>
          </div>
        @endif
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                {{ __('Permission ') }}
                Gestion de permission                         
                @can('add_roles')
                 <a href="{{ route('permissions.create') }}" class="btn pull-right btn-sm btn-default btn-bordered">Ajouter une permission</a>
                @endcan
              </div>
              <div class="panel-body">
                @foreach ($permissions as $permission)
                   <span class="badge badge-{{ str_contains($permission->name, 'delete') ? 'danger' : '' }} {{ str_contains($permission->name, 'edit') ? 'warning' : 'info' }}" style="margin: 5px;">
                     {{ $permission->name }}
                   

                    @can('edit_permissions')
                    <a href="{{ route('permissions.edit',[$permission->id]) }}" class="btn btn-warning btn-sm" style="    padding: 0px 3px;">M</a>
                    @endcan

                    @can('delete_permissions')
                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id], 'style'=>'display: inline;height:100%','onsubmit'=>'return show_alert();']) !!}
                    <button class="btn btn-sm btn-danger" style="padding: 0px 3px;"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                    @endcan
                  </span>
                @endforeach
                
              </div>
            </div>
        </div>
      </div>

@endsection
@section('scripts')
<script>
       $('#active-permissions').addClass('active');
</script>
@endsection