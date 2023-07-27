@extends('layouts.app')

@section('title')
  Faire une entré
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Entre de materiels</strong></h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
									<form action="{{ route('entres.store') }}" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
                    @csrf
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                      <label for="numerobon">N°BON DE COMMANDE</label>
                       <select name="numerobon" id="numerobon" class="form-control search_select">
                        <option value="0000/2021">Retour</option>
                          @foreach(\App\Bon::where([['chantier_id','=',session('chantier')],['etat',"=","valider"]])->orderBy('numerobon','desc')->groupBy('numerobon')->distinct()->get('numerobon') as $bon)
                          <option value="{{ $bon->numerobon }}">{{ $bon->numerobon }}</option>
                          @endforeach

                        </select>

                      @if($errors->has('numerobon')) <div class="help-block">
                         {{ $errors->first('numerobon') }}
                        </div>
                      @endif
                    </div>

                  <div id="materiel">
                    <div class="mat">
                        <div class="form-group col-md-6 @if($errors->has('type_id')) has-error @endif">
                        <label for="type_id">Materiel</label>
                        <select class="form-control search_select" name="materiel[]" value="{{ old('materiel_id') }}">
                          <option value=""></option>
                          @foreach($materiels as $materiel)
                          <option value="{{ $materiel->id }}">{{ $materiel->name.' ('.\App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite') .')' }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-6 @if($errors->has('quantite')) has-error @endif">
                          <label for="quantite">Quantité </label>
                          <input type="number" step="0.01" class="form-control" name="quantite[]" required value="{{ old('quantite') }}" data-mask="0" placeholder="0">
                          @if($errors->has('quantite')) <div class="help-block">
                             {{ $errors->first('quantite') }}
                          </div>
                        @endif
                      </div>


                      <div class="clearfix"></div>
                    </div>
                  </div>
                   <p class="text-center">
                       <a href="#end" id="addLine" class="add btn btn-xs btn-info"><span class="fa fa-plus-square-o"></span> Ajouter un ligne</a>
                    </p>
                  <div id="end" class="form-group col-md-12 @if($errors->has('date')) has-error @endif">
                  <label for="date">Date du bon</label>
                  <input type="text" required class="form-control datepicker-input"  name="date" value="{{ old('date') }}" data-mask="9999-99-99" autocomplete>
                    @if($errors->has('date')) <div class="help-block">
                       {{ $errors->first('date') }}
                    </div>
                  @endif
                </div>
                 <div class="form-group @if($errors->has('fourni')) has-error @endif">
                    <label for="fourni">Fournisseur</label>
                    {{-- <input type="text" class="form-control" name ="fourni"> --}}
                    <select name="fourni" id="fourni" class="form-control search_select">
                      @foreach($fournisseurs as $fournisseur)
                        <option value="{{$fournisseur->id}}">{{$fournisseur->name}}</option>
                      @endforeach
                    </select>
                    @if($errors->has('fourni'))
                    <div class="help-block">
                       {{ $errors->first('fourni') }}
                    </div>
                    @endif
                    </div>
                {{-- <div class="form-group col-md-12 @if($errors->has('motif')) has-error @endif">
                      <label for="motif">Utilisation </label>
                     <textarea name="motif" id="motif" class="form-control" rows="10"></textarea>
                      @if($errors->has('motif')) <div class="help-block">
                         {{ $errors->first('motif') }}
                      </div>
                    @endif
                  </div> --}}

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

          var code = "<div class='mat'> <div class='form-group col-md-6 @if($errors->has('type_id')) has-error @endif'> <label for='type_id'>Materiel</label> <select class='form-control search_select' name='materiel[]' value='{{ old('materiel_id') }}'> <option selected></option> @foreach($materiels as $materiel) <option value='{{ $materiel->id }}'>{{ $materiel->name.' ('.\App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite') .')' }}</option> @endforeach </select> </div> <div class='form-group col-md-6 @if($errors->has('quantite')) has-error @endif'> <label for='quantite'>Quantité </label> <input type='number' step='0.01' class='form-control' name='quantite[]' required value='{{ old('quantite') }}' data-mask='0' placeholder='0'> @if($errors->has('quantite')) <div class='help-block'> {{ $errors->first('quantite') }} </div> @endif </div><span class='btn btn-xs btn-info remove btn-danger'><i class='fa fa-remove'></i></span> <div class='clearfix'></div> </div>";

          $('#materiel').append("<div class='mat'>"+code+"</div>");
            $('select').select2({
              placeholder: "Search for a repository",
            });
          $('.remove').click(function(event) {
            $(this).parent('.mat').remove();
          });
        });
      $(":input").inputmask();
       $(".numero").inputmask({"mask": "9999/9999"});
        $('#active-generation').addClass('active');
  </script>
@endsection
