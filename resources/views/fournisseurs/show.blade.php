@extends('layouts.app')
@section('title')
Fournisseurs {{ $fournisseur->name }}
@endsection
@php $array[]= Null @endphp

@section('contents')
    <div class="row">
      <h1 class="text-center text-capitalize">{{ $fournisseur->name }}</h1>
        @foreach($fournisseur->bons->whereIn('etat',['valider','terminer'])->sortByDesc('id') as $bon)
                    @if(!in_array($bon->numerobon, $array))
      <div class="col-md-12">
        <div class="widget  panel panel-default">
          <div class="widget-header text-center">
             <h3 class="text-center">{{ $bon->numerobon }}  
              <a style="padding: 2px 5px;font-size: 10px;" href="{{ route('fournisseur.exportPdf',[$fournisseur->id,$bon->id]) }}" class="btn btn-info"><i class="fa fa-download"></i></a></h3>
              <small class="text-uppercase"><strong>{{ $bon->etat }}</strong></small>
              <div class="clearfix"></div>
          </div>
          <div class="panel-body">
             <div class="row">
               <div class="col-md-6">
                <h4 class="text-center">Livrés</h4>
                 <div class="table-responsive">
                    <table class="table table-bordered mb-5" cellspacing="0" width="100%" style="margin-bottom: 15px">
                      <thead>
                          <tr>
                              <th>Produit</th>
                              <th>Date</th>
                              <th>Quantite</th>
                              <th>Details</th>
                              {{-- <th>Par</th> --}}
                              <th>Reste</th>
                             
                          </tr>
                      </thead>
                      <tbody>
                      @foreach(collect(\App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id]])->get())->unique('materiel_id') as $en)
                      @php
                        $mat = @$en->materiel_id;
                        $unite = @$en->materiel->unite;
                        $qte = \App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat]])->sum('quantite');
                        $qteBon = \App\Bon::where([['numerobon','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['chantier_id','=',session('chantier')],['materiel_id','=',$mat]])->sum('quantite');
                        $somme = 0;
                      @endphp
                      <tr class="alert {{ ($qte==$qteBon OR $qte >= $qteBon)?'alert-success':'alert-warning' }}">
                          <td>{{ @$en->materiel->name }}</td>
                          <td>
                            @foreach(\App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat ]])->get() as $m)
                            {{ date('d/m/Y',strtotime($m->date_ajout)) }} <br>
                            @endforeach
                          </td>
                          <td>
                             @foreach(\App\Entre::entre()->where([['nfacture','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['materiel_id','=',$mat ]])->get() as $m)
                            {{ $m->quantite.' '.@$m->materiel->unite.'(s)'}} <br>
                            @php
                              $somme += $m->quantite;
                            @endphp
                             @endforeach
                             <br>
                             <hr style="margin-top: -15px; margin-bottom: 0;">
                             {{ "Total : ".$somme.' '.$unite.'(s)' }}
                          </td>
                          <td>
                            {{ $en->motif }}
                          </td>
                          <td>
                            {{ $qteBon - $qte }}
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
               </div>
               <div class="col-md-6">
                 <h4 class="text-center">Commandés</h4>
                 <div class="table-responsive">
             
                    <table class="table table-bordered mb-5" cellspacing="0" width="100%" style="margin-bottom: 15px">
                      <thead>
                          <tr>
                              <th>Produit</th>
                              <th>Date</th>
                              <th>Quantite</th>
                              {{-- <th>Par</th> --}}
                              <th>Prix</th>
                          </tr>
                      </thead>
                      <tbody>
                      @php $i=1;$montant = 0; @endphp
                      @foreach(\App\Bon::where([['numerobon','=',$bon->numerobon],['fournisseur_id','=',$fournisseur->id],['chantier_id','=',session('chantier')]])->get() as $en)
                      <tr>
                          <td>{{ @$en->materiel->name }}</td>
                          <td>{{ date('d/m/Y',strtotime($en->date_execution)) }}</td>
                          <td>{{ $en->quantite.' '.@$en->materiel->unite.'(s)'}}</td>
                          <td>{{ number_format($sum = $en->quantite * $en->cout,0,',',' ') }}</td>
                          {{-- <td>{{ @$en->user->name }}</td> --}}
                      </tr>
                      @php $montant += $sum; @endphp
                      @endforeach
                      <tr>
                        <td colspan="3" class="text-right">Total</td>
                        <td>{{ number_format($montant,0,',',' ') }}</td>
                      </tr>
                  </tbody>
                </table>
            </div>
               </div>
             </div>
          </div>
        </div>
      </div>
       @endif
                @php $array[]=$bon->numerobon @endphp
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
