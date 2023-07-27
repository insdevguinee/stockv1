@extends('layouts.app')

@section('title')
  Faire un bon de commande
@endsection
@php
$numero = ( count(\App\Bon::where('chantier_id',session('chantier'))->get()) !=0 ) ?  sprintf("%04d",explode('/',@\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon)[0] + 1 ).'/'.explode('/',@\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon)[1] : "0001/2021";
@endphp
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Commande</strong></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="{{ route('bons.store') }}" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
                    @csrf

                 <div class="row">
                      <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
                      <label for="name">Objet </label>
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                      @if($errors->has('name')) <div class="help-block">
                         {{ $errors->first('name') }}
                        </div>
                      @endif
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
                      <label for="numerobon">(Numero / Année) <strong> Dernier N°:{{ @\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon }}</strong></label>
                      <input type="text" class="form-control numero" name="numerobon" value="{{ old('numerobon') }}" required data-mask="9999/9999"
                       placeholder="{{ $numero }}">
                      @if($errors->has('numerobon')) <div class="help-block">
                         {{ $errors->first('numerobon') }}
                        </div>
                      @endif
                    </div>
                 </div>

                 <div class="row">
                    <div id="materiel">
                    <div class="mat">
                        <div class="form-group col-md-4 @if($errors->has('type_id')) has-error @endif">
                        <label for="type_id">Materiel</label>
                        <select class="form-control select2" name="materiel[]" value="{{ old('materiel_id') }}">
                          <option value=""></option>
                          @foreach($types as $type)
                            <option value="{{ $type->id }}">{!! $type->name.' ('.$type->unite.')' !!} </option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-4 @if($errors->has('quantite')) has-error @endif">
                          <label for="quantite">Quantité </label>
                          <input type="number" step="0.01" class="form-control" name="quantite[]" required value="{{ old('quantite') }}" data-mask="0" placeholder="0">
                          @if($errors->has('quantite')) <div class="help-block">
                             {{ $errors->first('quantite') }}
                          </div>
                        @endif
                      </div>

                      {{-- <div class="form-group col-md-4 @if($errors->has('cout')) has-error @endif">
                          <label for="cout">Prix/U </label>
                          <input type="number" class="form-control" name="cout[]" required value="{{ old('cout') }}" data-mask="0" placeholder="0">
                          @if($errors->has('cout')) <div class="help-block">
                             {{ $errors->first('cout') }}
                          </div>
                        @endif
                      </div> --}}


                       <div class="clearfix"></div>
                    </div>
                  </div>
                       <div class="clearfix"></div>
                    <p class="text-center">
                       <a href="#end" id="addLine" class="add btn btn-xs btn-info"><span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                    </p>
                 </div>
                  <div class="row">
                    <div id="end" class="form-group col-md-12 @if($errors->has('date')) has-error @endif">
                  <label for="date">Date du bon</label>
                  <input type="text" required class="form-control datepicker-input"  name="date" value="{{ old('date') }}" data-mask="9999-99-99" autocomplete>
                    @if($errors->has('date')) <div class="help-block">
                       {{ $errors->first('date') }}
                    </div>
                  @endif
                </div>
                <div class="form-group col-md-12 @if($errors->has('fournisseur')) has-error @endif">
                      <label for="fournisseur">Direction </label>
                      <select name="fournisseur" id="fournisseur" class="form-control">
                        @foreach($fournisseurs as $fournisseur)
                        <option value="{{$fournisseur->id}}">{{$fournisseur->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('fournisseur')) <div class="help-block">
                         {{ $errors->first('fournisseur') }}
                      </div>
                    @endif
                  </div>
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
    jQuery(document).ready(function($) {

        $('#addLine').click(function(event) {

          var code = "<div class='mat'> <div class='form-group col-md-4 @if($errors->has('type_id')) has-error @endif'> <label for='type_id'>Materiel</label> <select class='form-control select2' name='materiel[]' value='{{ old('materiel_id') }}'> <option selected></option> @foreach($types as $type) <option value='{{ $type->id }}'>{!! $type->name !!} </option> @endforeach </select> </div> <div class='form-group col-md-4 @if($errors->has('quantite')) has-error @endif'> <label for='quantite'>Quantité </label> <input type='number' step='0.01' class='form-control' name='quantite[]' required value='{{ old('quantite') }}' data-mask='0' placeholder='0'> @if($errors->has('quantite')) <div class='help-block'> {{ $errors->first('quantite') }} </div> @endif </div> <div class='form-group col-md-4 @if($errors->has('cout')) has-error @endif'> </div><span class='btn btn-xs btn-info remove btn-danger'><i class='fa fa-remove'></i></span> <div class='clearfix'></div> </div>";

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
    });

  </script>
@endsection
