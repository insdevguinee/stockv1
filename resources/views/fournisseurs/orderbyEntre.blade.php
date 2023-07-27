@extends('layouts.app')
@section('title')
Fournisseurs {{ $fournisseur->name }}
@endsection
@php $array[]= Null @endphp

@section('contents')
    <div class="row">
      <h1 class="text-center text-capitalize">{{ $fournisseur->name }}</h1>
        @foreach($fournisseur->entres->sortByDesc('id') as $entre)
                    @if(!in_array($entre->nfacture, $array))
      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header">
             <h3 class="text-center">{{ $entre->nfacture }}</h3>
          </div>
          <div class="panel-body">
             <div class="row">
               <div class="col-md-6">
                <h4 class="text-center">Livrés</h4>
                 <div class="table-responsive">
             
                    <table class="table table-striped table-bordered mb-5" cellspacing="0" width="100%" style="margin-bottom: 15px">
                      <thead>
                          <tr>
                              <th>Produit</th>
                              <th>Date</th>
                              <th>Quantite</th>
                              <th>Details</th>
                              <th>Par</th>
                             
                          </tr>
                      </thead>
                      <tbody>
                      @foreach(\App\Entre::entre()->where([['nfacture','=',$entre->nfacture],['fournisseur_id','=',$fournisseur->id]])->get() as $en)
                      <tr>
                          <td>{{ @$en->materiel->name }}</td>
                          <td>{{ date('d/m/Y',strtotime($en->date_ajout)) }}</td>
                          <td>{{ $en->quantite.' '.@$en->materiel->unite.'(s)'}}</td>
                          <td>{{ $en->motif }}</td>
                          <td>{{ @$en->user->name }}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
               </div>
               <div class="col-md-6">
                 <h4 class="text-center">Commandés</h4>
                 <div class="table-responsive">
             
                    <table class="table table-striped table-bordered mb-5" cellspacing="0" width="100%" style="margin-bottom: 15px">
                      <thead>
                          <tr>
                              <th>Produit</th>
                              <th>Date</th>
                              <th>Quantite</th>
                              <th>Details</th>
                              <th>Par</th>
                             
                          </tr>
                      </thead>
                      <tbody>
                      @foreach(\App\Bon::where([['numerobon','=',$entre->nfacture],['fournisseur_id','=',$fournisseur->id],['chantier_id','=',session('chantier')]])->get() as $en)
                      <tr>
                          <td>{{ @$en->materiel->name }}</td>
                          <td>{{ date('d/m/Y',strtotime($en->date_ajout)) }}</td>
                          <td>{{ $en->quantite.' '.@$en->materiel->unite.'(s)'}}</td>
                          <td>{{ $en->motif }}</td>
                          <td>{{ @$en->user->name }}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
               </div>
             </div>
          </div>
        </div>
      </div>
       @endif
                @php $array[]=$entre->nfacture @endphp
              @endforeach
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
