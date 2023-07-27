@extends('layouts.app')

@section('title')
  Ajouter du Materiel
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">

						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Modification</strong>  d'entrée</h2>

							</div>
							<div class="widget-content padding">
								<div id="basic-form">
                  {{ Form::model($entre, ['route' => array('entres.update', $entre->id), 'method' => 'PUT','style'=>'width:100%;display:contents !important', 'enctype'=>"multipart/form-data",'autocomplete'=>'off','onsubmit'=>'return show_alert();']) }}
									{{-- <form action="{{ route('entres.store') }}" method="POST" role="form">
                    @csrf --}}
                    <div class="form-group">
                    <label for="">Numero de bon de commande</label>
                    <select name="nfacture" id="nfacture" class="form-control search_select">
                            <option value="0000/2021">Retour</option>
                            @foreach(\App\Bon::where([['chantier_id','=',session('chantier')],['etat',"=","valider"]])->orderBy('numerobon','desc')->groupBy('numerobon')->distinct()->get('numerobon') as $bon)
                            <option value="{{ $bon->numerobon }}" {{ ($bon->numerobon=$entre->nfacture)?'selected':'' }} >{{ $bon->numerobon }}</option>
                            @endforeach
                          </select>
                  </div>
                    <div class="form-group @if($errors->has('type_id')) has-error @endif">
										<label for="type_id">Materiel</label>
  									<select class="form-control search_select" name="materiel_id">
                      <option value=""></option>
                      @foreach($types as $type)
    									  <option value="{{ $type->id }}" {{ ($type->id == $entre->materiel->id)?'selected':"" }}>{{ $type->name }}</option>
                      @endforeach
  									</select>
                  </div>
                  <div class="form-group @if($errors->has('date')) has-error @endif">
                  <label for="date">Date</label>
                  <input type="text" value="{{ $entre->date_ajout }}" class="form-control datepicker-input"  name="date" data-mask="9999-99-99" autocomplete="no">
                    @if($errors->has('date')) <div class="help-block">
                       {{ $errors->first('date') }}
                    </div>
                  @endif
                </div>
                  
                    <div class="form-group @if($errors->has('quantite')) has-error @endif">
                    <label for="quantite">Quantité</label>
                    <input type="number" step="0.01" value="{{ $entre->quantite }}" class="form-control" name="quantite" data-mask="0" placeholder="0">
                    @if($errors->has('quantite')) <div class="help-block">
                       {{ $errors->first('quantite') }}
                    </div>
                  @endif
                  </div>
                 {{--  <div class="form-group @if($errors->has('prix_uni')) has-error @endif">
                  <label for="prix_uni">Prix Unitaire</label>
                  <input type="text" class="form-control" name="prix_uni" data-mask="0" placeholder="0">
                  @if($errors->has('prix_uni')) <div class="help-block">
                     {{ $errors->first('prix_uni') }}
                  </div>
                @endif
                </div> --}}
                <div class="form-group @if($errors->has('fourni')) has-error @endif">
                <label for="fourni">Direction</label>
                <select name="fournisseur_id" class="form-control search_select">
                  @foreach($fournisseurs as $fournisseur)
                  <option value="{{ $fournisseur->id }}" {{ ($entre->fournisseur->id = $fournisseur->id)? 'selected' :'' }}>{{ $fournisseur->name }}</option>
                  @endforeach
                </select>
                @if($errors->has('fourni')) <div class="help-block">
                   {{ $errors->first('fourni') }}
                </div>
                @endif
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
  <script src="{{ URL::to('assets/js/pages/inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/jquery.inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
  <script>
      $(".numero").inputmask({"mask": "9999/9999"});

       $('#active-generation').addClass('active');
</script>
@endsection
