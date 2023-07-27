@extends('layouts.app')

@section('title')
  Chantiers
@endsection
@section('contents')
  <div class="row">

      <div class="col-md-8">
        <div class="panel">
          <div class="widget-header transparent">
             

          </div>
          <div class="panel-body widget-content">
             {{-- <span class="badge-primary badge" >{{ @$chantiers->count() }}</span> --}}
            <div class="table-responsive">
              <table data-sortable class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                   <th>Nom</th>
                   <th>Description</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($chantiers as $chantier)
                  <tr>
                    <td>
                      {{ $chantier->id }}
                    </td>
                   

                    <td>
                      {{ $chantier->name }}
                    </td>
                    <td>
                      {{ @$chantier->description }}
                    </td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        
                        @can("edit_chantiers")
                        <form action="{{ route('chantiers.update',$chantier->id) }}" method="POST" style="display: inline-block;">
                          @method('PUT')
                          @csrf
                          <input type="submit" value="archiver" class="btn btn-default  btn-sm" style="padding: 2px 5px;font-size: 10px;display: block;"name="archive">
                        </form>
                        {{-- <a href="#" class="btn btn-default" title="Archiver"><i class="fa fa-save"></i></a> --}}
                        <a href="{{ route('chantiers.edit',[$chantier->id]) }}" class="btn btn-info" title="Modifier"><i class="fa fa-edit"></i></a>
                        @endcan
                       {{--  {!! Form::open(['method' => 'DELETE', 'route' => ['chantiers.destroy', $chantier->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
                          <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        {!! Form::close() !!} --}}
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
                </table>
              </div>
                </div>
                <hr>
              </div>

          <div class="panel">
          <div class="panel-body widget-content">
            {{-- <h4 class="text-center">Archive</h4> --}}
            <div class="table-responsive">
              <table data-sortable class="table table-hover table-striped">
                <thead>
                  {{-- <tr>
                    <th>N°</th>
                   <th>Nom</th>
                   <th>Description</th>
                    <th></th>
                  </tr> --}}
                </thead>

                <tbody>
                 {{--  @foreach($archives as $chantier)
                  <tr>
                    <td>
                      {{ $chantier->id }}
                    </td>
                   

                    <td>
                      {{ $chantier->name }}
                    </td>
                    <td>
                      {{ @$chantier->description }}
                    </td>
                    <td>
                      <div class="btn-group btn-group-xs">
                         <form action="{{ route('chantiers.update',$chantier->id) }}" method="POST" style="display: inline-block;">
                          @method('PUT')
                          @csrf
                          <input type="submit" value="Désarchiver " class="btn btn-default  btn-sm" style="padding: 2px 5px;font-size: 10px;display: block;"name="archive">
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach --}}
                </tbody>
                </table>
              </div>
                </div>
                <hr>
              </div>

            </div>

          <div class="col-md-4">
            <div class="widget clearfix">
              <div class="widget-header transparent clearfix">
                <h2 class="text-center"><strong>Créer</strong> Zones de travail </h2>

              </div>
              <div class="widget-content padding clearfix">
                <div id="basic-form">
                  <form action="{{ route('chantiers.store') }}" method="POST" role="form">
                    @csrf

                    <div class="form-group @if($errors->has('name')) has-error @endif">
                      <label>Designation</label>
                      <input type="text" class="form-control"  name="name">

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
    </div>
@endsection
@section('scripts')
<script>
       $('#active-chantiers').addClass('active');
</script>
@endsection