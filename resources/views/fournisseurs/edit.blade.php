@extends('layouts.app')
@section('title')
Fournisseurs
@endsection


@section('contents')
    <div class="row">

      <div class="col-md-8 col-md-offset-2">
        <div class="widget  panel panel-default">
          <div class="widget-header">
            <h2 class="text-center"><strong>Modification {{
              $fournisseur->name}}</strong></h2>
          </div>
          <div class="panel-body">
            <form action="{{ route('fournisseurs.update',[$fournisseur->id]) }}" method="POST" role="form" autocomplete="off" class="pb-3">
                        @method('PUT')
                        @csrf

                        <div class="form-group @if($errors->has('name')) has-error @endif">
                          <label for="name">Entreprise</label>
                          <input type="text" class="form-control" name ="name" value="{{$fournisseur->name}}" />
                          @if($errors->has('name')) <div class="help-block">
                             {{ $errors->first('name') }}
                          </div>
                          @endif
                        </div>
                        <div class="form-group">
                          <label for="pays">Pays</label>
                          <select name="pays_id" id="pays" class="form-control">
                            @foreach($pays as $p)
                              <option value="{{$p->id}}">{{$p->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group @if($errors->has('ville')) has-error @endif">
                          <label for="name">Ville</label>
                          <input type="text" class="form-control" value="{{$fournisseur->ville}}" name ="ville"/>
                          @if($errors->has('ville')) <div class="help-block">
                             {{ $errors->first('ville') }}
                          </div>
                          @endif
                        </div>
                        <div class="form-group @if($errors->has('contact')) has-error @endif">
                          <label for="contact">Contact</label>
                          <input type="text" class="form-control" value="{{$fournisseur->contact}}" name="contact"/>
                          @if($errors->has('contact')) <div class="help-block">
                             {{ $errors->first('contact') }}
                          </div>
                          @endif
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;margin-left: 20px;">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                      <button type="submit" class="btn btn-default">Enregistrer</button>
                    </div>
                  </form>
          </div>
        </div>
      </div>
    </div>


@endsection
@section('scripts')
  <!-- Page Specific JS Libraries -->
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
  <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script>
  <script>
       $('#active-fournisseurs').addClass('active');
</script>
@endsection
