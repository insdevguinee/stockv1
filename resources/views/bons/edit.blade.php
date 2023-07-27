@extends('layouts.app')

@section('title')
  Modification
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modification Bon de Commande</strong></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="{{ route('bons.update',$bon->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
                      <label for="name">Objet </label>
                      <input type="text" class="form-control" name="name" value="{{ $bon->name }}" required>
                      @if($errors->has('name')) <div class="help-block">
                         {{ $errors->first('name') }}
                        </div>
                      @endif
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
                      <label for="numerobon">(Nuemro / Année)</label>{{ @\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon }}
                      <input type="text" class="form-control numero" name="numerobon" value="{{ $bon->numerobon }}" required>
                      @if($errors->has('numerobon')) <div class="help-block">
                         {{ $errors->first('numerobon') }}
                        </div>
                      @endif
                    </div>
                    <hr>
                  {{-- <a href="#end" class="add addLine btn btn-xs btn-info"><span class="fa fa-plus-square-o"></span> Ajouter un ligne</a> --}}
                  <div id="materiel">
                    
                      @foreach(\App\bon::where('numero',$bon->numero)->get() as $t)
                        <div class="form-group col-md-4 @if($errors->has('type_id')) has-error @endif">
                          <label for="type_id">Materiel</label>
                          <select class="form-control" name="materiel[]">
                            <option value=""></option>
                            @foreach($materiels as $materiel)
                              <option value="{{ $materiel->id }}" {{ ($materiel->id == $t->materiel_id)?'selected':'' }}>{!! $materiel->name !!} </option>
                            @endforeach
                          </select>
                        </div>

                      <div class="form-group col-md-4 @if($errors->has('quantite')) has-error @endif">
                          <label for="quantite">Quantité </label>
                          <input type="number" step="0.01" class="form-control" name="quantite[]"  value="{{ $t->quantite }}" data-mask="0" placeholder="0">
                          @if($errors->has('quantite')) <div class="help-block">
                             {{ $errors->first('quantite') }}
                          </div>
                        @endif
                      </div>

                      <div class="form-group col-md-4 @if($errors->has('cout')) has-error @endif">
                          <label for="cout">Prix/U </label>
                          <input type="number" class="form-control" name="cout[]"  value="{{ $t->cout }}" data-mask="0" placeholder="0">
                          @if($errors->has('cout')) <div class="help-block">
                             {{ $errors->first('cout') }}
                          </div>
                        @endif
                      </div>

                     {{-- <div class='button'> <a href='#' class='remove text-danger'><span class='fa fa-minus-square-o'></span></a> </div> --}}
                      <div class="clearfix"></div>
                      @endforeach
                      <div class="mat">
                        <div class="form-group col-md-4 @if($errors->has('type_id')) has-error @endif">
                          <label for="type_id">Materiel</label>
                          <select class="form-control" name="materiel[]">
                            <option value=""></option>
                            @foreach($materiels as $materiel)
                              <option value="{{ $materiel->id }}">{!! $materiel->name !!} </option>
                            @endforeach
                          </select>
                        </div>

                      <div class="form-group col-md-4 @if($errors->has('quantite')) has-error @endif">
                          <label for="quantite">Quantité </label>
                          <input type="number" class="form-control" name="quantite[]"  data-mask="0" placeholder="0">
                          @if($errors->has('quantite')) <div class="help-block">
                             {{ $errors->first('quantite') }}
                          </div>
                        @endif
                      </div>

                      {{-- <div class="form-group col-md-4 @if($errors->has('cout')) has-error @endif">
                          <label for="cout">Prix/U </label>
                          <input type="number" class="form-control" name="cout[]"  data-mask="0" placeholder="0">
                          @if($errors->has('cout')) <div class="help-block">
                             {{ $errors->first('cout') }}
                          </div>
                        @endif
                      </div> --}}
                        <div class="clearfix"></div>
                    </div>
                  
                  </div>
                    <p class="text-center">
                       <a href="#end" id="addLine" class="add btn btn-xs btn-info"><span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                    </p>
                  <div id="end" class="form-group col-md-12 @if($errors->has('date')) has-error @endif">
                  <label for="date">Date du bon</label>
                  <input type="text" required class="form-control datepicker-input"  name="date" value="{{ $bon->date_execution }}" data-mask="9999-99-99" autocomplete>
                    @if($errors->has('date')) <div class="help-block">
                       {{ $errors->first('date') }}
                    </div>
                  @endif
                </div>
                <div class="form-group col-md-12 @if($errors->has('fournisseur')) has-error @endif">
                      <label for="fournisseur">Direction </label>
                      <select name="fournisseur" id="fournisseur" class="form-control">
                        @foreach($fournisseurs as $fournisseur)
                        <option value="{{$fournisseur->id}}" {{ ($bon->fournisseur_id == $fournisseur->id)?'selected':'' }}>{{$fournisseur->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('fournisseur')) <div class="help-block">
                         {{ $errors->first('fournisseur') }}
                      </div>
                    @endif
                  </div>

									  <button type="submit" class="btn btn-default">Enregistrer</button>
									</form>
								</div>
							</div>
						</div>

					</div>
      </div>
      
@endsection
@section('scripts')
  <script src="{{ URL::to('assets/js/pages/inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/jquery.inputmask.min.js') }}"></script>
  <script>
       $('#addLine').click(function(event) {

          var code = "<div class='mat'> <div class='form-group col-md-4 @if($errors->has('type_id')) has-error @endif'> <label for='type_id'>Materiel</label> <select class='form-control select2' name='materiel[]' value='{{ old('materiel_id') }}'> <option selected></option> @foreach($materiels as $materiel) <option value='{{ $materiel->id }}'>{!! $materiel->name !!} </option> @endforeach </select> </div> <div class='form-group col-md-4 @if($errors->has('quantite')) has-error @endif'> <label for='quantite'>Quantité </label> <input type='number' class='form-control' name='quantite[]' required value='{{ old('quantite') }}' data-mask='0' placeholder='0'> @if($errors->has('quantite')) <div class='help-block'> {{ $errors->first('quantite') }} </div> @endif </div> <div class='form-group col-md-4 @if($errors->has('cout')) has-error @endif'> <label for='cout'>Prix/U </label> <input type='number' class='form-control' name='cout[]' required value='{{ old('cout') }}' data-mask='0' placeholder='0'> @if($errors->has('cout')) <div class='help-block'> {{ $errors->first('cout') }} </div> @endif </div><span class='btn btn-xs btn-info remove btn-danger'><i class='fa fa-remove'></i></span> <div class='clearfix'></div> </div>";

          $('#materiel').append("<div class='mat'>"+code+"</div>");
            $('select').select2({
            placeholder: "Search for a repository",
          });
          $('.remove').click(function(event) {
            $(this).parent('.mat').remove();
          });

        });

        $(".numero").inputmask({"mask": "9999/9999"});
        $('#active-bons').addClass('active');
  </script>
@endsection
