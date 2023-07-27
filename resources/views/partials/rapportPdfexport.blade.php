<h4 class="text-center text-uppercase" style="margin-top: 20px;"><u><strong>{{ @$categorie->name }}</span></strong></u></h4>
      <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0">
          <thead>
              <tr>
                  <th >Designation</th>
                  <th >Qte i</th>
                  <th >Unité</th>
                  <th class="text-center">Reception
                    <table class="table table-bordered">
                          <tr>
                            <td>N°S</td>
                            <td>Date</td>
                            <td>N°BON</td>
                            <td>Qte</td>
                          </tr>
                    </table>
                  </th>
                  <th >Qte Re Totale</th>
                  <th class="text-center">Consommation
                    <table class=" table-bordered table">
                          <tr>
                            <td>N°Sem</td>
                            <td>Date</td>
                            <td>Qte</td>
                          </tr>
                    </table>
                  </th>
                  <th>Cons. Totale</th>
                  <th>Stock</th>
              </tr>
          </thead>
          
          <tbody>
            @foreach($categorie->materiels as $materiel)
              @php

              $stockini =  $materiel->entres()->whereDate('date_ajout','<',$min)->where([['chantier_id','=',session('chantier')]])->sum('quantite');

                $qteSortie = -$materiel->entreDate($min,$max)->where([['mode','=','sortie'],['chantier_id','=',session('chantier')]])->sum('quantite');

                $qteEntre = $materiel->entreDate($min,$max)->where([['mode','=','entre'],['chantier_id','=',session('chantier')]])->sum('quantite') + $stockini ;
                $stock = $qteEntre - $qteSortie;
              @endphp
              @if($qteEntre != 0 AND $stockini != 0 )
              <tr class="entre">
                  <td class="middle">{{ @$materiel->name }}</td>
                  <td class="middle">
                   
                    {{ $stockini }}

                  </td>
                  <td class="middle"> {{ @$materiel->unite }} </td>

                  <td>
                    <table  class="table table-bordered table-hover" style="background: transparent;">
                      <tbody>
                        @foreach($materiel->entreDate($min,$max)->where([['mode','=','entre'],['chantier_id','=',session('chantier')]])->get() as $entre)
                          
                          @isset($_GET['semaine'])
                          @if(@$_GET['semaine']== \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth )
                          <tr>
                            <td class="text-center">{{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}</td>
                            <td class="text-center">
                              {{ date('d/m/Y',strtotime($entre->date_ajout)) }}
                            </td>
                            <td class="text-center">{{ $entre->nfacture }}</td>
                            <td class="text-center">{{ $entre->quantite}}</td>
                          </tr>

                          @endif
                          @else
                          <tr>
                            <td class="text-center">{{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}</td>
                            <td class="text-center">
                              {{ date('d/m/Y',strtotime($entre->date_ajout)) }}
                            </td>
                            <td class="text-center">{{ $entre->nfacture }}</td>
                            <td class="text-center">{{ $entre->quantite}}</td>
                          </tr>
                          @endisset
                          
                        @endforeach
                      </tbody>
                    </table>
                  </td>
                   <td class="middle">{{ $qteEntre }}</td>
                   <td>
                     <table class="table table-bordered table-hover" style="background: transparent;">
                       <tbody>
                         @foreach($materiel->entreDate($min,$max)->where([['mode','=','sortie'],['chantier_id','=',session('chantier')]])->get() as $entre)

                            @isset($_GET['semaine'])
                             @if(@$_GET['semaine']== \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth )
                            <tr title="{{ $entre->motif }}">
                              <td class="text-center">{{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}</td>
                              <td class="text-center">
                                {{ date('d/m/Y',strtotime($entre->date_ajout)) }}
                              </td>
                              <td class="text-center">{{ -$entre->quantite}}</td>
                            </tr>
                            @endif
                            @else
                             <tr title="{{ $entre->motif }}">
                              <td class="text-center">{{ \Carbon\Carbon::parse($entre->date_ajout)->weekOfMonth }}</td>
                              <td class="text-center">
                                {{ date('d/m/Y',strtotime($entre->date_ajout)) }}
                              </td>
                              <td class="text-center">{{ -$entre->quantite}}</td>
                            </tr>
                            @endisset

                        @endforeach
                       </tbody>
                     </table>
                   </td>
                   <td class="middle">{{ $qteSortie }}</td>
                   <td class="middle"
                    @if($stock > $minStock ) style="background: #c8ffc8;@endif " @if($stock <= $minStock) style="background: #ffc8c8; @endif "
                   ><strong>{{ $stock }}</strong></td>
              </tr>
              @endif
            @endforeach
          </tbody>
      </table>
