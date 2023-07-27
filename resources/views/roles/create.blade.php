@extends('layouts.app')

@section('title')
  Creer un role
@endsection
@section('contents')
<div class="row">
        <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                {{ Form::open(array('route' => array('roles.store'))) }}
                <div class="form-group">
                    {{ Form::label('name', 'Nom') }}
                    {{ Form::text('name', null, ['class' => 'form-control','placeholder'=>'Nom du role'])}}
                </div>
            </div>
        </div>
            @foreach ($permissionNames as $permissionName)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="elipsis"><!-- panel title -->
                                <strong style="text-transform: uppercase;">{{ $permissionName }}</strong>
                            </span>
                            <ul class="options pull-right list-inline">
                                <li class=""><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Colapse"></a></li>
                                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>
                        
                            </ul>
                        </div>
                       <div class="panel-body">
                            @foreach ($permissions as $permission)
                                @if (str_contains($permission->name, $permissionName))
                                     <label class="switch switch switch-round">
                                        {{ Form::checkbox('permissions[]',  $permission->id) }}
                                        <span class="switch-label" data-on="YES" data-off="NO"></span>
                                        <span>{{ Form::label($permission->name, ucfirst($permission->name)) }}</span>
                                    </label>
                                @endif
                            @endforeach
                       </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
            <div class="col-12">
            {{ Form::submit('Enregistrer', array('class' => 'btn btn-primary')) }}
            </div>
            {{ Form::close() }}
 
    </div>
</div>
@endsection
@section('scripts')
<script>
       $('#active-roles').addClass('active');
</script>
@endsection