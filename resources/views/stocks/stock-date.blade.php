@extends('layouts.app')
@section('title')
Gestion de Stock
@endsection
<style>
  .date-input{
    display: inline-block;
    position: relative;
  }
  .date-input input{
        display: flex;
    height: 17px;
    width: 100px;
  }
</style>
@php
  $mois = (isset($_GET['mois'])) ? $_GET['mois'] : date('m');
  $months = \App\Option::months();
  $minStock = 9;
  $cat = (isset($_GET['cat'])) ? $_GET['cat'] : @$materiels->first()->categorie->id;
@endphp
@section('contents')
    <div class="row">

      <div class="col-md-12">
        <div class="widget">
          <div class="widget-header">

          <div class="additional-btn"  style="left:15px !important; right: none">
            @include('partials.moisfilter')
          </div>
            <h2 class="text-center"><strong>Stock <span class="text-capitalize">{{ @$materiels->first()->categorie->name }}</span> {{$months[$mois] }}</strong></h2>

            <div class="additional-btn">
               <div class="date-input">
                 <form action="{{ route('datefilter') }}" method="GET" style="margin-right: 30px;" autocomplete="off">
                   
                    <input type="text" placeholder="Date debut" name="datedebut" class="datepicker-input">
                    <input type="text" placeholder="Date fin" name="datefin" class="datepicker-input">
                    <button type="submit" class="btn btn-default btn" style="display: inline-block; position: absolute;top: 0;right: 0;">ok</button>
                 </form>
               </div>
              {{-- <div class="semaine-search" style=" display: inline-block; position: relative; width: 120px;">
                <form action="" style="display: flex; position: absolute; top: -30px">
                   
                  <input type="text" name="cat" value="{{ $cat }}" hidden>
                  <input type="text" name="mois" value="{{ $mois }}" hidden>
                  <select name="semaine" id="semaine" style="display: inline-block;margin:0px; width: 100%">
                    <option></option>
                    <option value="4" {{ @$_GET['semaine']=='4'?'selected':"" }}>Semaine 4 </option>
                    <option value="3" {{ @$_GET['semaine']=='3'?'selected':"" }}>Semaine 3 </option>
                    <option value="2" {{ @$_GET['semaine']=='2'?'selected':"" }}>Semaine 2 </option>
                    <option value="1" {{ @$_GET['semaine']=='1'?'selected':"" }}>Semaine 1 </option>
                  </select>
                  <button type="submit" class="btn btn-default btn" style="display: inline-block;">ok</button>
                </form>
              </div> --}}

            </div>
          </div>
          <div class="widget-content">
          <br>
            <div class="table-responsive">
              {{-- <form class='form-horizontal' role='form'> --}}
              <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th rowspan="2" width="200">Materiel</th>
                              <th rowspan="2" width="50">Qte i</th>
                              <th rowspan="2" width="50">Unité</th>
                              <th class="text-center" width="300">Reception
                                <table class="table table-bordered">
                                      <tr>
                                        <td width="50">N°S</td>
                                        <td width="100">Date</td>
                                        <td width="50">N°BON</td>
                                        <td width="50">Qte</td>
                                      </tr>
                                </table>
                              </th>
                              <th rowspan="2" width="50">Qte Re Totale</th>
                              <th class="text-center" width="250">Consommation
                                <table class=" table-bordered table">
                                      <tr>
                                        <td width="50">N°Sem</td>
                                        <td width="50">Date</td>
                                        <td width="50">Qte</td>
                                      </tr>
                                </table>
                              </th>
                              <th width="50">Cons. Totale</th>
                              <th>Stock</th>
                          </tr>
                          
                      </thead>


                      <tbody>
                        @foreach($materiels as $materiel)

                          <tr class="entre">
                              <td>{{ @$materiel->name }}</td>
                              <td>

                                  {{ $stockini = $materiel->entresMois('<',$mois)->where([['chantier_id','=',session('chantier')]])->sum('quantite') }}

                              </td>
                              <td> {{ @$materiel->unite }} </td>

                              <td>
                                <table  class="table table-bordered table-hover" style="background: transparent;">
                                  <tbody>
                                    @foreach($materiel->entresMois('=',$mois)->where([['mode','=','entre'],['chantier_id','=',session('chantier')]])->whereMonth('date_ajout',$mois)->get() as $entre)
                                      
                                      @isset($_GET['semaine'])
                                      @if(@$_GET['semaine']== \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth )
                                      <tr width="300">
                                        <td width="50" class="text-center">{{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}</td>
                                        <td width="100" class="text-center">
                                          {{ date('d/m/Y',strtotime($entre->date_ajout)) }}
                                        </td>
                                        <td width="50" class="text-center">{{ $entre->nfacture }}</td>
                                        <td width="100" class="text-center"><a href="#" title="{{ $entre->motif }}"> <i class="fa fa-exclamation-circle"></i> </a> {{ $entre->quantite}}</td>
                                      </tr>

                                      @endif
                                      @else
                                      <tr width="300">
                                        <td width="50" class="text-center">{{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}</td>
                                        <td width="100" class="text-center">
                                          {{ date('d/m/Y',strtotime($entre->date_ajout)) }}
                                        </td>
                                        <td width="50" class="text-center">{{ $entre->nfacture }}</td>
                                        <td width="100" class="text-center"><a href="#" title="{{ $entre->motif }}"> <i class="fa fa-exclamation-circle"></i> </a> {{ $entre->quantite}}</td>
                                      </tr>
                                      @endisset
                                      
                                    @endforeach
                                  </tbody>
                                </table>
                              </td>
                               <td>{{ $qteEntre = $materiel->entresMois('=',$mois)->where([['mode','=','entre'],['chantier_id','=',session('chantier')]])->sum('quantite') + $stockini }}</td>
                               <td>
                                 <table class="table table-bordered table-hover" style="background: transparent;">
                                   <tbody>
                                     @foreach($materiel->entresMois('=',$mois)->where([['mode','=','sortie'],['chantier_id','=',session('chantier')]])->get() as $entre)

                                        @isset($_GET['semaine'])
                                         @if(@$_GET['semaine']== \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth )
                                        <tr width="150" title="{{ $entre->motif }}">
                                          <td width="50" class="text-center">{{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}</td>
                                          <td width="100" class="text-center">
                                            {{ date('d/m/Y',strtotime($entre->date_ajout)) }}
                                          </td>
                                          <td width="80" class="text-center"><a href="#" title="{{ $entre->motif }}"> <i class="fa fa-exclamation-circle"></i></a> {{ -$entre->quantite}}</td>
                                        </tr>
                                        @endif
                                        @else
                                         <tr width="150" title="{{ $entre->motif }}">
                                          <td width="50" class="text-center">{{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}</td>
                                          <td width="100" class="text-center">
                                            {{ date('d/m/Y',strtotime($entre->date_ajout)) }}
                                          </td>
                                          <td width="80" class="text-center"><a href="#" title="{{ $entre->motif }}"> <i class="fa fa-exclamation-circle"></i></a> {{ -$entre->quantite}}</td>
                                        </tr>
                                        @endisset

                                    @endforeach
                                   </tbody>
                                 </table>
                               </td>
                               <td>{{ $qteSortie = -$materiel->entresMois('=',$mois)->where([['mode','=','sortie'],['chantier_id','=',session('chantier')]])->sum('quantite') }}</td>
                               <td
                              @php $stock = $qteEntre - $qteSortie @endphp
                                @if($stock > $minStock ) style="background: #c8ffc8;@endif " @if($stock < $minStock) style="background: #ffc8c8; @endif "
                               ><strong>{{ $stock }}</strong></td>
                          </tr>
                        {{-- @endif --}}
                        @endforeach

                      </tbody>
                  </table>
              {{-- </form> --}}
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection
@section('scripts')
  <!-- Page Specific JS Libraries -->
  {{-- <script src="{{ URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script> --}}
  {{-- <script src="{{ URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script> --}}
  {{-- <script src="{{ URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script> --}}
  {{-- <script src="{{ URL::to('assets/js/pages/datatables.js') }}"></script> --}}
  <script>
       $('#active-stocks').addClass('active');
</script>
@endsection
