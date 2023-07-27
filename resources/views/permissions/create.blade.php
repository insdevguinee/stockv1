@extends('layouts.app')

@section('title')
  Creer une permission
@endsection
@section('contents')

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                    <div class="panel-body">
                        {{ Form::open(array('route' => array('permissions.store'))) }}
                        <div class="form-group">
                            {{ Form::label('name', 'Nom') }}
                            {{ Form::text('name', '', array('class' => 'form-control')) }}
                        </div><br>
                        @if(!$roles->isEmpty()) 
                            <h3>Assign Permission to Roles</h3>
                            @foreach ($roles as $role) 
                                 <label class="switch switch switch-round">
                                    {{ Form::checkbox('roles[]',  $role->id) }}
                                    <span class="switch-label" data-on="YES" data-off="NO"></span>
                                    <span>{{ Form::label($role->name, ucfirst($role->name)) }}</span>
                                </label>
                            @endforeach
                        @endif
                        <br>
                        {{ Form::submit('Enregistrer', array('class' => 'btn btn-default')) }}
                        {{ Form::close() }}
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