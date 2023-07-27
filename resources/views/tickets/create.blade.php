@extends('layouts.app')

@section('title')
  Faire un bon de commande
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Commande</strong></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="{{ route('tickets.store') }}" method="POST" role="form" autocomplete="off">
                    @csrf

                    <div class="form-group @if($errors->has('name')) has-error @endif">
                      <label for="name">Bon </label>
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                      @if($errors->has('name')) <div class="help-block">
                         {{ $errors->first('name') }}
                      </div>
                    @endif
                  </div>
                  <a href="#" class="add text-success" id="addLine"><span class="fa fa-2x fa-plus-square-o"></span></a>
                  <div id="materiel">
                    <div class="mat">
                        <div class="form-group col-md-6 @if($errors->has('type_id')) has-error @endif">
                        <label for="type_id">Materiel</label>
                        <select class="form-control" name="materiel[]" value="{{ old('materiel_id') }}">
                          <option value=""></option>
                          @foreach($types as $type)
                            <option value="{{ $type->id }}">{!! $type->name !!} </option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-6 @if($errors->has('quantite')) has-error @endif">
                          <label for="quantite">Quantité </label>
                          <input type="text" class="form-control" name="quantite[]" required value="{{ old('quantite') }}" data-mask="0" placeholder="0">
                          @if($errors->has('quantite')) <div class="help-block">
                             {{ $errors->first('quantite') }}
                          </div>
                        @endif
                      </div>
                     {{-- <div class='button'> <a href='#' class='remove text-danger'><span class='fa fa-minus-square-o'></span></a> </div> --}}
                      <div class="clearfix"></div>
                    </div>
                  </div>
              {{--      <div class="form-group @if($errors->has('chantier_id')) has-error @endif">
                        <label for="chantier_id">Chantier</label>
                        <select class="form-control" name="chantier_id">
                         
                          @foreach(Auth::user()->chantiers as $chantier)
                            <option value="{{ $chantier->id }}">{!! $chantier->name !!} </option>
                          @endforeach
                        </select>
                      </div> --}}
                  <div class="form-group @if($errors->has('date')) has-error @endif">
                  <label for="date">Date du bon</label>
                  <input type="text" required class="form-control datepicker-input"  name="date" value="{{ old('date') }}" data-mask="9999-99-99" autocomplete>
                    @if($errors->has('date')) <div class="help-block">
                       {{ $errors->first('date') }}
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
