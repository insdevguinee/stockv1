{{-- @if(Auth::user()->hasRole('admin|Admin')) --}}
@extends('layouts.app')
{{-- @else
@extends('personnels.profil._body')
@endif --}}

@section('title')
  Modifier un personnel
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modifier </strong> {{ $personnel->matricule }}</h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="{{ route('personnels.update',$personnel->id) }}" method="POST" role="form">
                    @method('PUT')
                    @csrf
                    <div class="form-group @if($errors->has('matricule')) has-error @endif">
                      <label for="matricule">Matricule</label>
                      <input type="text" class="form-control" value="{{$personnel->matricule}}" name="matricule" disabled>
                      @if($errors->has('matricule')) <div class="help-block">
                         {{ $errors->first('matricule') }}
                      </div>
                    @endif
                    </div>

                  <div class="form-group @if($errors->has('nom')) has-error @endif">
										<label for="nom">Nom</label>
										<input type="text" class="form-control" value="{{$personnel->nom}}" name="nom">
                    @if($errors->has('nom')) <div class="help-block">
                       {{ $errors->first('nom') }}
                    </div>
                  @endif
                  </div>
                  <div class="form-group @if($errors->has('prenoms')) has-error @endif">
                    <label for="prenoms">Prenom(s)</label>
                    <input type="text" class="form-control" value="{{$personnel->prenoms}}" name="prenoms">
                    @if($errors->has('prenoms')) <div class="help-block">
                       {{ $errors->first('prenoms') }}
                    </div>
                  @endif
                  </div>
                  <div class="form-group @if($errors->has('email')) has-error @endif">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="{{$personnel->email}}" name="email">
                    @if($errors->has('email')) <div class="help-block">
                       {{ $errors->first('email') }}
                    </div>
                  @endif
                  </div>
                  <div class="form-group ">
                        <label for="example-url-input" class="">Civilité </label>
                            <select class="form-control" name="civilite">
                                <option value="m" {{$personnel->civilite == "m" ? 'selected':' ' }} >Monsieur</option>
                                <option value="mme" {{$personnel->civilite == "mme" ? 'selected':' ' }} >Madame</option>
                                <option value="mlle" {{$personnel->civilite == "mlle" ? 'selected':' ' }} >Mademoiselle</option>
                            </select>
                    </div>
                  <div class="form-group @if($errors->has('contact')) has-error @endif">
                    <label for="contact">Contact</label>
                    <input  type="text" class="form-control" value="{{$personnel->contact}}" name="contact">
                    @if($errors->has('contact')) <div class="help-block">
                       {{ $errors->first('contact') }}
                    </div>
                    @endif
                  </div>
                    <div class="form-group">
                        <label for="example-url-input">Date de naissance </label>
                        <input class="form-control" type="date" value="{{$personnel->naissance}}" name="naissance"   placeholder="Date de naissance">
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Lieu de naissance </label>
                        <input class="form-control" type="text" value="{{$personnel->lieu_n}}" name="lieu_n"    placeholder="Lieu de naissance">
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Nationnalité </label>
                            <select class="form-control" value="{{$personnel->nationnalite}}" name="nationnalite"  >
                                <option></option>
                                <option value="ivoirienne">Ivoirienne</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Adresse Habitation </label>

                            <input class="form-control" type="text" value="{{$personnel->adresse}}" name="adresse"    placeholder="Adresse d'habitation">

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Situation Matrimoniale </label>

                            <select class="form-control" value="{{$personnel->st_matri}}"name="st_matri" >
                                <option value="marie">Marié</option>
                                <option value="celibataire" selected>Célibataire</option>
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Nombre d'enfant </label>

                            <input class="form-control" type="number" value="{{$personnel->enfant}}" name="enfant" value="0"  >

                    </div>

                     <div class="form-group">
                        <label for="example-url-input">Departement </label>

                            <select class="form-control"name="departement_id" >
                                <option></option>
                                @foreach ($departements as $d)
                                <option value="{{$d->id}}" {{$personnel->departement_id == $d->id ?"selected":"

                                "}} >{{$d->name}}</option>
                                @endforeach
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Poste </label>

                            <input class="form-control" type="text" value="{{$personnel->poste}}" name="poste"   placeholder="Poste Occupé">

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Type de Contrat </label>

                            <select class="form-control" value="{{$personnel->contrat_type}}" name="contrat_id" >
                                {{-- @foreach($contrats  as $c) --}}
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                <option value="prestataire">Prestataire</option>
                                {{-- @endforeach --}}
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="example-url-input">Salaire Brut</label>

                            <input class="form-control" type="number" value="{{$personnel->salaire}} "name="salaire" value="0">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">N°CNPS</label>

                            <input class="form-control" type="text" value="{{$personnel->cnps}}" name="cnps">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">CMU</label>

                            <input class="form-control" type="text" value="{{$personnel->cmu}}" name="cmu">

                    </div>
                    <div class="form-group">
                        <label for="example-url-input">Date d'embauche </label>

                            <input class="form-control" type="date" value="{{$personnel->embauche}}" name="embauche"  placeholder="Date d'embauche">

                    </div>


                  <div class="form-group @if($errors->has('numero_equipe')) has-error @endif">
                    <label for="numero_equipe">Numéro Equipe</label>
                    <input  value="{{ old("numero_equipe") }}" type="text" class="form-control" value="{{$personnel->numero_equipe}}" name="numero_equipe">
                    @if($errors->has('numero_equipe')) <div class="help-block">
                       {{ $errors->first('numero_equipe') }}
                    </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <p><strong>Travail sur le / les Chantier(s)</strong></p>
                    @foreach ($chantiers as $chantier)
                       <label class="switch switch switch-round block">
                          <input type="checkbox" name="chantiers[]" value="{{ $chantier->id }}" {{ ($personnel->chantiers->contains($chantier) ) ? 'checked':'' }} >
                          <span class="switch-label" data-on="YES" data-off="NO"></span>
                          <span>{{ Form::label($chantier->name, ucfirst($chantier->name)) }}</span>
                      </label>
                    @endforeach
                  </div>



									  <button type="submit" class="btn btn-default">Modifier</button>
									</form>
								</div>
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
       $('#active-personnels').addClass('active');
</script>
@endsection
