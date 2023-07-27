@extends('layouts.app')

@section('title')
  Liste des roles
@endsection
@section('contents')
      <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-body">
                 @can('add_roles')
                   <a href="{{ route('roles.create') }}" class="btn btn-sm btn-default float-right">
                   <i class="fa fa-plus-circle" aria-hidden="true"></i> Creer un role
                  </a>
                  @endcan
                </div>
            </div>
          </div>
      </div>
      <div class="row">
        @foreach ($roles as $role)
        <div class="col-md-6">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title text-capitalize">{{ $role->name }}</h4>
                <p class="card-category"> Gestion du role {{ $role->name }} </p>
              </div>
              <div class="card-body">
                  @foreach($role->permissions as $permission)
                    <span class="badge badge-primary">
                     {{ $permission->name }}
                   </span>
                  @endforeach
              </div>
              <div class="card-footer">
                 @can('edit_roles')
                    <a href="{{ route('roles.edit',[$role->id]) }} " class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil"></i>
                        <span>Modifier</span>
                    </a>
                    @endcan
                    @can('delete_roles')
                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id],'style'=>'display:inline-block !important','onsubmit'=>'return show_alert();' ]) !!}
                     <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Supprimer</button>
                    {!! Form::close() !!}
                    @endcan
              </div>
            </div>
        </div>
        @endforeach
      </div>

@endsection
@section('scripts')
<script>
       $('#active-roles').addClass('active');
</script>
@endsection