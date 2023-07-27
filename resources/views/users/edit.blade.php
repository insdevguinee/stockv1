@extends('layouts.app')

@section('title')
  Modifier un utilisateur
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modifier </strong> {{ $user->name }}</h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="{{ route('users.update',$user->id) }}" method="POST" role="form">
                    @method('PUT')
                    @csrf

                  <div class="form-group @if($errors->has('name')) has-error @endif">
                    <label for="name">Username</label>
                    <input value="{{ $user->name }}" {{ old('name') }} type="text" class="form-control "  name="name">
                      @if($errors->has('name')) <div class="help-block">
                         {{ $errors->first('name') }}
                      </div>
                    @endif
                  </div>
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                    <label for="email">Email</label>
                    <input value="{{ $user->email }}" {{ old("email") }} type="email" class="form-control" name="email">
                    @if($errors->has('email')) <div class="help-block">
                       {{ $errors->first('email') }}
                    </div>
                    @endif
                  </div>
                  <div class="form-group @if($errors->has('nom')) has-error @endif">
										<label for="nom">Nom</label>
										<input value="{{ $user->nom }}" {{ old("nom") }} type="text" class="form-control" name ="nom">
                    @if($errors->has('nom')) <div class="help-block">
                       {{ $errors->first('nom') }}
                    </div>
                  @endif
                  </div>
                  <div class="form-group @if($errors->has('prenom')) has-error @endif">
                    <label for="prenom">Prenom(s)</label>
                    <input value="{{ $user->prenom }}" {{ old("prenom") }} type="text" class="form-control" name ="prenom">
                    @if($errors->has('prenom')) <div class="help-block">
                       {{ $errors->first('prenom') }}
                    </div>
                  @endif
                  </div>
                
                  <div class="form-group @if($errors->has('phone')) has-error @endif">
                    <label for="phone">Contact</label>
                    <input value="{{ $user->phone }}" {{ old("phone") }} type="text" class="form-control" name ="phone">
                    @if($errors->has('phone')) <div class="help-block">
                       {{ $errors->first('phone') }}
                    </div>
                    @endif
                  </div>
                  @can('edit_users')
                  <div class="form-group">
                    @foreach ($chantiers as $chantier)
                       <label class="switch switch switch-round block">
                          <input type="checkbox" name="chantiers[]" value="{{ $chantier->id }}" {{ ($user->chantiers->contains($chantier) ) ? 'checked':'' }} >
                          <span class="switch-label" data-on="YES" data-off="NO"></span>
                          <span>{{ Form::label($chantier->name, ucfirst($chantier->name)) }}</span>
                      </label>
                    @endforeach
                  </div>
                  <div class="form-group @if($errors->has('type_id')) has-error @endif">
                    <label for="type_id">Roles</label>
                    <select class="form-control" name="role">
                      @foreach($roles as $role)
                      <option value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected':'' }}>{{ $role->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  @endcan
                   {{-- <div class="form-group @if($errors->has('password')) has-error @endif">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name ="password">
                    @if($errors->has('password')) <div class="help-block">
                       {{ $errors->first('password') }}
                    </div>
                    @endif
                  </div>
                   <div class="form-group @if($errors->has('password')) has-error @endif">
                    <label for="password">Confirmation MDP</label>
                    <input type="password" class="form-control" name ="password_confirmation">
                  </div> --}}
                
									  <button type="submit" class="btn btn-default">Modifier</button>
									</form>
								</div>
							</div>
						</div>

           
					</div>
          <div class="col-md-6  portlets ui-sortable">
             <div class="widget">
              <div class="widget-header transparent">
                <h2><strong>Modifier le mot de passe </strong> {{ $user->name }}</h2>
              </div>
              <div class="widget-content padding">
                <form action="{{ route('user.passwordReset',$user->id) }}" method="POST">
                   @csrf
                    <div class="form-group @if($errors->has('nom')) has-error @endif">
                      <label for="newPassword">Mot de passe</label>
                      <input type="password" class="form-control" name ="newPassword">
                      @if($errors->has('newPassword')) <div class="help-block">
                         {{ $errors->first('newPassword') }}
                      </div>
                    @endif
                    </div>
                    <div class="form-group @if($errors->has('newPassword_confirmation')) has-error @endif">
                      <label for="newPassword_confirmation">Confirmation</label>
                      <input type="password" class="form-control" name ="newPassword_confirmation">
                      @if($errors->has('newPassword_confirmation')) <div class="help-block">
                         {{ $errors->first('newPassword_confirmation') }}
                      </div>
                    @endif
                    </div>
                    <button type="submit" class="btn btn-default">Modifier</button>
                </form>
              </div>
            </div>
          </div>
      </div>
      
@endsection
@section('scripts')
  <script src="{{ URL::to('assets/libs/d3/d3.v3.js')}}"></script>
  <script src="{{ URL::to('assets/libs/rickshaw/rickshaw.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/raphael/raphael-min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/morrischart/morris.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-knob/jquery.knob.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-clock/clock.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-easypiechart/jquery.easypiechart.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js')}}"></script>
  <script src="{{ URL::to('assets/libs/bootstrap-calendar/js/bic_calendar.min.js')}}"></script>
  <script src="{{ URL::to('assets/js/apps/calculator.js')}}"></script>
  <script src="{{ URL::to('assets/js/apps/todo.js')}}"></script>
  <script src="{{ URL::to('assets/js/apps/notes.js')}}"></script>
  <script src="{{ URL::to('assets/js/pages/index.js')}}"></script>
  <script>
       $('#active-users').addClass('active');
</script>
@endsection
