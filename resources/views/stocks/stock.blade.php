@extends('layouts.app')
@section('title')
Gestion de Stock
@endsection

@php
  $mois = (isset($_GET['mois'])) ? $_GET['mois'] : date('m');
  $months = \App\Option::months();
  $categories = \App\Categorie::where([['parent_id',0],['type',0]])->get();
  $minStock = \App\Setting::findOrFail(1)->notifnumb;
  $cat = (isset($_GET['cat'])) ? $_GET['cat'] : @$catego->id;
  $min = (@$_GET['datedebut']) ? @$_GET['datedebut'] : \Carbon\Carbon::now()->startOfWeek();
  $max = (@$_GET['datefin']) ? @$_GET['datefin'] : \Carbon\Carbon::now()->endOfWeek()->subDays(1);
  $materiels = (@$_GET['article']) ? \App\Materiel::where('id',$_GET['article'])->get() : $materiels ;
@endphp
@section('contents')
<div class="row">
  <div class="col-md-3">
    <div class="panel panel-default">
      <a class="panel-body btn-block text-center" href='{{ route('sorties.index') }}'>
        <i class="fa fa-arrow-left" aria-hidden="true"></i> 
        Effectuer une consommation
      </a>
    </div>
  </div>

</div>
<div class="row">
  <div class="col-md-12">
    <div class="widget panel panel-default">
      <div class="widget-header">
        <div class="additional-btn"  style="left:15px !important; right: none">
          <form action="" method="GET"  style="display: inline-block;">
            <div class="" style="display: inline-block;">
              <select name="cat" id="cat" class="search_select" style="display: block;margin:0px; width: 100%;height: 34px;">
                @foreach($categories as $categorie)
                  <option value="{{ $categorie->id }}" class="text-capitalize"  {{ (@$_GET['cat'] == $categorie->id)?'selected':'' }}>{{ $categorie->name }}</option>
                @endforeach
              </select>
              <input type="text" placeholder="Date debut"  value="{{ @$min }}" name="datedebut" required class="datepicker-input" style="display: none">
              <input type="text" placeholder="Date fin" value="{{ @$max }}" name="datefin" required class="datepicker-input" style="display: none">
              <input type="text" name="article" value="{{@$_GET['article']}}" style="display: none;">
            </div>
            <button type="submit" class="btn btn-default"  style="display: inline-block;position: absolute;margin-left: 7px;">Selecte</button>
          </form>
        </div>
        <h2 class="text-center"><strong>Stock <span class="text-capitalize">{{ @$materiels->first()->categorie->name }}</span>{{--  {{$months[$mois] }} --}}</strong> [ {{ $min.' au '.$max }} ] </h2>

        <div class="additional-btn">
           <div class="date-input">
             <form action="" method="GET" style="margin-right: 80px;position: relative;" autocomplete="off">
                <input type="text" placeholder="Date debut"  value="{{ @$_GET['datedebut'] }}" name="datedebut" required class="datepicker-input">
                <input type="text" placeholder="Date fin" value="{{ @$_GET['datefin'] }}" name="datefin" required class="datepicker-input">
              <input type="text" name="article" value="{{@$_GET['article']}}" style="display: none;">
                
                <input type="text" value="{{ @$cat }}" name="cat" style="display: none;">
                <button type="submit" class="btn-default btn" style="display: inline-block; position: absolute;top: 0;right: -35px">ok</button>
             </form>
           </div>
           @can('download_stocks')
            <form id="downloadPDF" action="{{ route('stock.pdf') }}" method="GET"  style="display: none;" autocomplete="off">
                <input type="text" placeholder="Date debut"  value="{{ @$_GET['datedebut'] }}" name="datedebut" required class="datepicker-input">
                <input type="text" placeholder="Date fin" value="{{ @$_GET['datefin'] }}" name="datefin" required class="datepicker-input">
                <input type="text" value="{{ @$cat }}" name="cat">
                <input type="text" name="article" value="{{@$_GET['article']}}" style="display: none;">
             </form>
           <a href="#" class="btn btn-default" onclick="document.getElementById('downloadPDF').submit();"  style="display: inline-block;position: absolute;margin-left: 7px;right: 0px;height: 33px; color: #fff;">
             <i class="fa fa-download"></i>
           </a>
           @endcan
          {{--  <a href="{{ route('logout') }}"  class="btn btn-success md-close">Oui, je me deconnecte</a> --}}
        </div>
      </div>
      <div class="panel-body">
        <form action="" method="GET">

        <div class="input-group col-md-12">
          <select name="article" id="article" class="form-control search_select">
            <option value="">Recherche par materiel...</option>
            @foreach($catego->materiels as $mat)
              <option value="{{$mat->id}}" {{($mat->id == @$_GET['article'])? 'selected':' ' }}>{{$mat->name}}</option>
            @endforeach
          </select>
          <div style="display: none">
            <input type="text" placeholder="Date debut"  value="{{ @$min }}" name="datedebut" required class="datepicker-input">
              <input type="text" placeholder="Date fin" value="{{ @$max }}" name="datefin" required class="datepicker-input" >
          <input type="text" value="{{ @$cat }}" name="cat">

          </div>
          <div class="input-group-append" style="position: absolute;z-index: 2; right: 0;">
            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
          </div>
        </div>

        </form>
      <br>
        <div class="table-responsive">
          {{-- <form class='form-horizontal' role='form'> --}}
            {{-- <input type="text" name="produit" id="produit" class="form-control" placeholder="Rechercher un article..." style="margin-bottom: 10px;"> --}}

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
                       
                        {{ $stockini = round (  $materiel->entres()->whereDate('date_ajout','<',$min)->where([['chantier_id','=',session('chantier')]])->sum('quantite') ,3)}}

                      </td>
                      <td> {{ @$materiel->unite }} </td>

                      <td>
                        <table  class="table table-bordered table-hover" style="background: transparent;">
                          <tbody>
                            @foreach($materiel->entreDate($min,$max)->where([['mode','=','entre'],['chantier_id','=',session('chantier')]])->get() as $entre)
                              
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
                       <td>{{ $qteEntre = $materiel->entreDate($min,$max)->where([['mode','=','entre'],['chantier_id','=',session('chantier')]])->sum('quantite') + $stockini }}</td>
                       <td>
                         <table class="table table-bordered table-hover" style="background: transparent;">
                           <tbody>
                             @foreach($materiel->entreDate($min,$max)->where([['mode','=','sortie'],['chantier_id','=',session('chantier')]])->get() as $entre)

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
                       <td>{{ $qteSortie = -$materiel->entreDate($min,$max)->where([['mode','=','sortie'],['chantier_id','=',session('chantier')]])->sum('quantite') }}</td>
                       <td
                      @php $stock = $qteEntre - $qteSortie @endphp
                      @if($stock > $minStock ) style="background: #c8ffc8;@endif " @if($stock <= $minStock) style="background: #ffc8c8; @endif "
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

@include('partials.modalEntre')
@endsection
@section('scripts')
  <script>
       $('#active-stocks').addClass('active');
</script>
@endsection
