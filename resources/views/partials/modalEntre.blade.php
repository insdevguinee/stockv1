<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Entrée de Marchandise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="basic-form">
                  <form action="{{ route('entres.store') }}" method="POST" role="form" autocomplete="off">
                        @csrf
                        <div class="form-group @if($errors->has('type_id')) has-error @endif">
                        <label for="type_id">Materiel</label>
                        <select class="form-control" name="materiel_id">
                          <option value=""></option>
                          @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group @if($errors->has('date')) has-error @endif">
                      <label for="date">Date</label>
                      <input type="text" class="form-control datepicker-input date" placeholder="aaaa-mm-jj"  name="date" data-mask="9999-99-99" value="{{ date('yy/m/d') }}">
                        @if($errors->has('date')) <div class="help-block">
                           {{ $errors->first('date') }}
                        </div>
                      @endif
                      </div>
                        <div class="form-group @if($errors->has('nfacture')) has-error @endif">
                        <label for="nfacture">N°BON</label>
                        <input type="number" class="form-control" name ="nfacture" data-inputmask="'mask': '9999'" />
                        @if($errors->has('nfacture')) <div class="help-block">
                           {{ $errors->first('nfacture') }}
                        </div>
                        @endif
                        </div>
                        <div class="form-group @if($errors->has('quantite')) has-error @endif">
                        <label for="quantite">Quantité</label>
                        <input type="number" step='0.01' class="form-control" name="quantite" data-mask="0" placeholder="0">
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
                    <label for="fourni">Fournisseur</label>
                    <input type="text" class="form-control" name ="fourni">
                    @if($errors->has('fourni')) <div class="help-block">
                       {{ $errors->first('fourni') }}
                    </div>
                    @endif
                    </div>
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-default">Enregistrer</button>
                  </form>
          </div>
      </div>
    </div>
  </div>
</div>