@php
$note_finale= 0;
@endphp
<div id="printview" style="background-color: #fff;padding: 20px;">
    <div class="row">
        <div class="col-md-6 float-left">
            <img src="{{ URL::to('assets/img/logo_socoexim.png')}}" style="height: 70px;" alt="Logo">
            <p class="text-justify">Société de Construction et Expertise Immobilière</p>
        </div>
    </div>
    <p class="text-right">Année : {{$fiche->annee}}</p>
    <h4 class="text-center text-uppercase" style="margin-top: 20px;">FICHE : {{$fiche->name}}</h4>
    <div class="row">
        <div class="col-md-12" style="margin-top: 50px;">
            <table class="table table-bordered">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <td width="400">NOM ET PRENOM(S) DE L'EMPLOYE :</td>
                        <td>{{$personnel->nom.' '.$personnel->prenoms}}</td>
                        <td width="300">EMAIL :</td>
                        <td>{{$personnel->email}}</td>

                        <td width="100">DATE</td>
                    </tr>
                    <tr>
                        <td>NATURE DU CONTRAT / DATE DE SIGNATURE :</td>
                        <td>{{$personnel->embauche}}</td>
                        <td>FONCTION :</td>
                        <td>{{$personnel->poste}}</td>
                        <td>{{date('d-m-y')}}</td>
                    </tr>
                    <tr>
                        <td>Catégorie :</td>
                        <td></td>
                        <td>SERVICE </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Matricule:</td>
                        <td>{{$personnel->matricule}}</td>
                        <td>CONTRAT </td>
                        <td>{{$personnel->contrat_id}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach ($fiche->categories as $key => $cat)
            <h4  style="margin-top: 50px;">{{ $key + 1 .'-'.$cat->name}}</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">DESIGNATION</th>
                        <th rowspan="2">QUALITE</th>
                        @foreach ($fiche->evaluateurs as $e)
                            <th colspan="2">{{@$e->user->nom.' '.@$e->user->prenom}} </th>
                        @endforeach
                        <th rowspan="2">NOTE FINALE</th>
                    </tr>
                    <tr>
                        @foreach ($fiche->evaluateurs as $k => $e)
                            <th>NOTE /{{$fiche->notation}}</th>
                            <th>NOTE PONDERE A {{$p = $e->ponderation}}'%'</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="{{count($cat->criteres) + 1 }}">{{$cat->name}}</td>
                    </tr>
                    @php
                    $total = 0;
                         foreach ($fiche->evaluateurs as $key => $e) {
                           $notes[$key] = 0;
                           $ponderations[$key] = 0;
                         }
                    @endphp
                    @foreach ($cat->criteres as $c)
                     <tr>
                        <td>{{$c->name}}</td>
                        @php
                            $sumN = $sumP = 0;
                        @endphp
                        @foreach ($fiche->evaluateurs  as $key => $e)
                            <td>{{ $n = @\App\Critere::note($e->user->id,$personnel->id,$c->id)->note}}</td>
                            <td>{{ $n1 = $p * $n /100 }}</td>
                            @php
                                $notes[$key] += $n;
                                $sumN += $n;
                                $ponderations[$key] +=$n1;
                            @endphp
                        @endforeach

                        <td> {{$sumN / count($fiche->evaluateurs)}} / {{$fiche->notation}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-uppercase">MOYENNE NOTE {{$cat->name}} sur {{$fiche->notation}}</th>
                        @foreach ($fiche->evaluateurs as $key => $e)
                        <th>
                            {{ $notes[$key] / count($cat->criteres)}}
                        </th>
                        <th>
                            {{$ponderations[$key] / count($cat->criteres)}}
                        </th>
                        @php
                            $total += $notes[$key] / count($cat->criteres);
                            $note_finale += $total / count($fiche->evaluateurs);
                        @endphp
                        @endforeach
                        <th>
                           {{$total / count($fiche->evaluateurs)}}
                        </th>
                    </tr>
                </tfoot>
            </table>
            @endforeach
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr class="">
                            <th scope="row">MOYENNE TOTALE</th>
                            <td> {{ $n = round($note_finale*20 / ($fiche->notation * 3*2),0)}} / 20</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <h4  style="margin-top: 50px;">AVIS ET DECISION DIRECTION</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            @foreach ($fiche->evaluateurs as $e)
                                <th colspan="2" class="text-uppercase text-center">
                                    {{@$e->user->nom.' '.@$e->user->prenom}}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td scope="row">AVIS</td>
                            @foreach ($fiche->evaluateurs as $e)
                                <td colspan="2">
                                    {{@\App\Critere::note($e->user->id,$personnel->id,@$fiche->categories()->first()->criteres()->first()->id)->avis}}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>DECISION</td>
                            <td colspan="{{count($fiche->evaluateurs)*2}}">
                                @php
                                    if($personnel->contrat_id == "CDD"){
                                        if ($n < 12) {
                                            echo "Fin de contrat";
                                        }elseif($n >= 12 and $n < 14){
                                            echo "Non avancement";
                                        }elseif($n>=14 and $n<16){
                                            echo "Sur deux années successive pour un avance";
                                        }else{
                                            echo "Promotion direct CDI";
                                        }
                                    }elseif ($personnel->contrat_id =="prestataire") {
                                        if ($n < 12) {
                                            echo "Fin de contrat";
                                        }elseif($n >= 12 and $n < 14){
                                            echo "Non avancement";
                                        }elseif($n>=14 and $n<16){
                                            echo "Passe en CCD ";
                                        }else{
                                            echo "Promotion direct";
                                        }
                                    }else{

                                    }
                                @endphp
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h4  style="margin-top: 50px;">AVIS DU PERSONNEL</h4>
            <form action="{{route('avisuser',['fiche'=> @$fiche->id, 'personnel'=> $personnel->id])}}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="monavis" id="" cols="30" rows="2" class="form-control">
                        {{ @\App\Notes::where([['fiche_id',$fiche->id,'personnel_id'=>$personnel->id]])->first()->avis_utilisateur }}
                    </textarea>
                </div>
                <button class="btn btn-xs btn-success" type="submit">
                    Envoyer
                </button>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center mt-2" style="margin-top: 10px">
        <a href="{{route('evaluation.print',[$personnel->id,'fiche'=>$fiche->id])}}" class="btn btn-default"> Imprimer </a>
    </div>
</div>



