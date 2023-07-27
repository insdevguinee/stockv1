@extends('layouts.app')
@section('title')
Utilisateurs
@endsection


@section('contents')
    <div class="row">

      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header">
            {{-- <div class="additional-btn"  style="left:15px !important; right: none">
              <form action="" method="GET">
                  <select name="mois" id="mois" class="form-group">
                    @foreach($roles as $role)
                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                  </select>
                  <button type="submit" class="btn btn-default">Selecte</button>
              </form>
            </div> --}}
            <h2 class="text-center"><strong>Liste des Utilisateurs</strong></h2>

            <div class="additional-btn">
           <a href="{{ route('users.create') }}"><button class="btn btn-success pull-right">Ajouter</button></a>
            </div>
          </div>
          <div class="panel-body">
          <br>
            <div class="table-responsive">
              {{-- <form class='form-horizontal' role='form'> --}}
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Username</th>
                              <th>Nom</th>
                              <th>Prenom</th>
                              <th>Email</th>
                              <th>Sites</th>
                              <th>Tel</th>
                              <th>Role</th>
                              @can('edit_users')
                              <th>Status</th>
                              @endcan
                              <th></th>
                          </tr>
                      </thead>


                      <tbody>
                        @foreach($users as $user)
                          <tr class="user">
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->nom }}</td>
                              <td>{{ $user->prenom }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                @foreach($user->chantiers as $chantier)
                                  <span class="badge badge-info">
                                    {{ $chantier->name }}
                                  </span>
                                @endforeach
                              </td>
                              <td>{{ $user->phone }}</td>
                              <td>{{ @$user->roles()->first()->name }}</td>
                              @can('edit_users')
                              <td>
                                <form action="{{ route('user.active',$user->id) }}" method="POST">
                                  @csrf
                                <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                  

                                  
                                  <button class="btn btn-{{ ($user->active==1) ? "success":"" }} {{ ($user->active==1) ? "active":"" }}">Activer</button>
                                  <button type="submit" name="desactiver" value="0" class="btn btn-{{ ($user->active==0) ? "danger":"" }}  {{ ($user->active==0) ? "active":"" }}">Desactiver</button>
                                </div>

                                </form>
                              </td>
                              @endcan
                              <td>
                                <div class="btn-group btn-group-xs"  style="width: 45px;">
                                  @can('edit_users')
                                 <a href="{{ route('users.edit',$user->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                 @endcan
                                 @can('delete_users')
                                  {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]) !!}
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


@endsection
@section('scripts')
  <!-- Page Specific JS Libraries -->
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
  <script>
       $('#active-users').addClass('active');
</script>
@endsection
