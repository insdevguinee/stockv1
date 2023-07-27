@extends('layouts.app')

@section('title')
  Transfert de materiel
@endsection
@section('contents')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                <strong>Info</strong>
                <p>Pour tous les transferts de stock entre site de stock, le numéro de Bon en réception pour le site de destination  est 0000/2023 et le fournisseur est le site de départ.</p>
            </div>
        </div>
    </div>

    <form action="{{ route('transfert.multiple') }}" method="POST" role="form" autocomplete="off" onsubmit='return show_alert();'>
    @csrf
    <div class="row">
        <div class="col-md-4 portlets ui-sortable">
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>Transfert</strong>  de Materiel</h2>
                </div>

                <div class="widget-content padding">
                    <div id="basic-form">
                        <div class="form-group @if($errors->has('nfacture')) has-error @endif">
                        <label for="nfacture">N°BON DE SORTIE ( Dernier numero : {{ @\App\Entre::sortie()->orderBy('created_at','desc')->first()->nfacture }} )</label>
                        <input type="text" class="form-control numero" name ="nfacture" placeholder="{{ @\App\Entre::sortie()->orderBy('created_at','desc')->first()->nfacture }}" required>
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

                        <div class="form-group @if($errors->has('date')) has-error @endif">
                        <label for="date">Date du transfert</label>
                        <input type="text" class="form-control datepicker-input"  name="date" data-mask="9999-99-99" autocomplete="off" required>
                            @if($errors->has('date')) <div class="help-block">
                            {{ $errors->first('date') }}
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
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8 portlets ui-sortable">
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>Transfert</strong>  de Materiel</h2>
                </div>

                <div class="widget-content padding">

                        <div id="materiel">
                    <div class="mat">
                        <div class="form-group col-md-10 @if($errors->has('type_id')) has-error @endif">
                        <label for="type_id">Materiel</label>
                        <select class="form-control search_select" name="materiel[]" value="{{ old('materiel_id') }}">
                          <option value=""></option>
                          @foreach($materiels as $materiel)
                          <option value="{{ $materiel->id }}">{{ $materiel->name.' ('.\App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite') .')' }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-2 @if($errors->has('quantite')) has-error @endif">
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
                    <button type="submit" class="btn btn-default">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('scripts')

  <script src="{{ URL::to('assets/js/pages/inputmask.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/jquery.inputmask.min.js') }}"></script>
  <script>
    $('#addLine').click(function(event) {

          var code = "<div class='mat'> <div class='form-group col-md-10 @if($errors->has('type_id')) has-error @endif'> <label for='type_id'>Materiel</label> <select class='form-control search_select' name='materiel[]' value='{{ old('materiel_id') }}'> <option selected></option> @foreach($materiels as $materiel) <option value='{{ $materiel->id }}'>{{ $materiel->name.' ('.\App\Entre::where([['materiel_id','=',$materiel->id],['chantier_id','=',session('chantier')]])->groupBy('materiel_id')->sum('quantite') .')' }}</option> @endforeach </select> </div> <div class='form-group col-md-2 @if($errors->has('quantite')) has-error @endif'> <label for='quantite'>Quantité </label> <input type='number' step='0.01' class='form-control' name='quantite[]' required value='{{ old('quantite') }}' data-mask='0' placeholder='0'> @if($errors->has('quantite')) <div class='help-block'> {{ $errors->first('quantite') }} </div> @endif </div><span class='btn btn-xs btn-info remove btn-danger'><i class='fa fa-remove'></i></span> <div class='clearfix'></div> </div>";

          $('#materiel').append("<div class='mat'>"+code+"</div>");
            $('select').select2({
              placeholder: "Search for a repository",
            });
          $('.remove').click(function(event) {
            $(this).parent('.mat').remove();
          });
        });
     $(".numero").inputmask({"mask": "9999"});
       $('#active-transfert').addClass('active');
</script>
@endsection
