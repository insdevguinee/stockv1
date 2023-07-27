@extends('layouts.app')

@section('title')
  Faire un bon de caisse
@endsection
@php
$numero = ( count(\App\Boncaisse::where('chantier_id',session('chantier'))->get()) !=0 ) ?  sprintf("%04d",explode('/',@\App\Bon::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon)[0] + 1 ).'/'.explode('/',@\App\Boncaisse::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon)[1] : "0001/".date('Y');
@endphp
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Caisse</strong></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="{{ route('boncaisses.store') }}" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
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
                        <label for="numerobon"><strong> Dernier N°:{{ @\App\Boncaisse::where('chantier_id',session('chantier'))->orderBy('created_at','desc')->first()->numerobon }}</strong></label>
                        <input type="text" class="form-control numero" name="numerobon" value="{{ old('numerobon') }}" required data-mask="9999/9999"
                        placeholder="{{ $numero }}">
                        @if($errors->has('numerobon')) <div class="help-block">
                          {{ $errors->first('numerobon') }}
                          </div>
                        @endif
                      </div>
                 </div>
                 <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="">Objet du reglement</label>
                    <textarea name="motif" class="form-control" rows="4"></textarea>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="">Montant</label>
                    <input type="number" name="cout" class="form-control">
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="">Bénéficiaire</label> - <strong id="personnel">Personnel</strong>----------------- <strong id="benef">autre</strong>
                    <select name="user_id" class="form-control" id="sbenef">
                      {{-- <option value="0">Autre</option> --}}
                      @foreach ($personnels as $personnel)
                          <option value="{{$personnel->id}}">
                            {{$personnel->nom.' '.$personnel->prenom}}[{{@$personnel->matricule}}]
                          </option>
                      @endforeach
                    </select>
                    <input type="text" class="form-control" name="beneficiaire" id="autre">
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="">Chantier</label>
                    <div class="form-control">
                      {{@\App\Chantier::findOrFail(session('chantier'))->name}}
                    </div>
                  </div>
                 </div>
                  </div>
									  <button type="submit" class="btn btn-default">Demander</button>
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
      $("#autre").hide();

      $("#benef").click(function (e) { 
        $("#autre").show().val("");
        $('#basic-form .select2').hide();
      });

      $("#personnel").click(function (e) { 
        $("#autre").hide().val("");
        $('#basic-form .select2').show();
      });


        $(".numero").inputmask({"mask": "9999/9999"});
         $('#active-boncaisses').addClass('active');
    });

  </script>
@endsection
