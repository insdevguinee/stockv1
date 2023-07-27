@extends('layouts.app')

@section('title')
  Transfert de materiel
@endsection
@section('contents')
      <div class="row">

        <div class="col-md-6 col-md-offset-3 portlets ui-sortable">
            <div class="alert alert-info">
                <strong>Info</strong>
                <p>Pour tous les transferts de stock entre site de stock, le numéro de Bon en réception pour le site de destination  est 0000/2023 et le fournisseur est le site de départ.</p>
            </div>
               {{-- @can('add_entremultiple') --}}
                    <a class="btn btn-success text-light " href="{{ route('transfert.multiple') }}" style="color: #fff;margin-bottom:10px">Transfert Plusieurs</a>
                {{-- @endcan --}}
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>Transfert</strong>  de Materiel</h2>
                </div>

                <div class="widget-content padding">

                    <div id="basic-form">
                        <form action="{{ route('transferts.store') }}" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
                    @csrf
                    <div class="form-group @if($errors->has('nfacture')) has-error @endif">
                      <label for="nfacture">N°BON DE SORTIE ( Dernier numero : {{ @\App\Entre::sortie()->orderBy('created_at','desc')->first()->nfacture }} )</label>
                      <input type="text" class="form-control numero" name ="nfacture" placeholder="{{ @\App\Entre::sortie()->orderBy('created_at','desc')->first()->nfacture }}">
                      @if($errors->has('nfacture')) <div class="help-block">
                         {{ $errors->first('nfacture') }}
                      </div>
                    @endif
                    </div>

                    <div class="form-group">
                      <label for="chantier">Site départ</label>
                      <div class="form-control">
                        {{ \App\Chantier::findOrFail(session('chantier'))->name }}
                      </div>
                      <input class="form-control" name="chantier1" value="{{ session('chantier') }}" style="display: none;" required>
                    </div>

                    <div class="form-group @if($errors->has('materiel_id')) has-error @endif">
  										<label for="materiel_id">Materiel à transferer</label>
    									<select class="form-control" name="materiel_id">
                        <option value=""></option>
                        @foreach($materiels as $materiel)
                          @php
                            $qte = \App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite');
                          @endphp
                          @if($qte != 0)
      									  <option value="{{ $materiel->id }}">{{ $materiel->name.' ('.$qte.')'  }}</option>
                          @endif
                        @endforeach
    									</select>
                    </div>
                    <div class="form-group @if($errors->has('date')) has-error @endif">
                      <label for="date">Date du transfert</label>
                      <input type="text" class="form-control datepicker-input"  name="date" data-mask="9999-99-99" autocomplete="off">
                        @if($errors->has('date')) <div class="help-block">
                           {{ $errors->first('date') }}
                        </div>
                      @endif
                    </div>

                    <div class="form-group @if($errors->has('quantite')) has-error @endif">
                      <label for="quantite">Quantité à transferer</label>
                      <input type="text" class="form-control" name="quantite" data-mask="0" placeholder="0" required>
                      @if($errors->has('quantite')) <div class="help-block">
                         {{ $errors->first('quantite') }}
                      </div>
                    @endif
                  </div>
                  <div class="form-group @if($errors->has('chantier2')) has-error @endif">
                    <label for="chantier2">Site arrivé</label>
                    <select class="form-control" name="chantier2">
                      <option value=""></option>
                      @foreach($chantiers as $chantier)
                        @if($chantier->id != session('chantier'))
                          <option value="{{ $chantier->id }}">{{ $chantier->name }}</option>
                        @endif
                      @endforeach
                    </select>
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
     $(".numero").inputmask({"mask": "9999"});
       $('#active-transfert').addClass('active');
</script>
@endsection
