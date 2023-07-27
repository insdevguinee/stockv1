<div class="panel">
    <div class="panel-body">
        <h5>Matricule : {{$personnel->matricule}} | Email : {{$personnel->email}}</h5>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                    <tr>
                        <th scope="row" class="bg-gray">NOM</th>
                        <td class="text-uppercase">{{$personnel->civilite.'. '.$personnel->nom}}</td>
                        <th scope="row" class="bg-gray">PRENOM(S)</th>
                        <td  class="text-uppercase">{{$personnel->prenoms}}</td>
                        <th scope="row" class="bg-gray">DATE NAISSANCE</th>
                        <td  class="text-uppercase">{{$personnel->naissance}}</td>
                    </tr>
                    <tr>

                        <th scope="row" class="bg-gray">DATE EMBAUCHE</th>
                        <td  class="text-uppercase">{{$personnel->embauche}}</td>
                        <th scope="row" class="bg-gray">POSTE</th>
                        <td  class="text-uppercase">{{$personnel->poste}}</td>
                        <th scope="row" class="bg-gray">SALAIRE BRUT</th>
                        <td  class="text-uppercase">#</td>

                    </tr>
                    <tr>

                    </tr>
                    <tr>
                        <th scope="row" class="bg-gray">NATIONNALITÉ</th>
                        <td  class="text-uppercase">{{$personnel->nationnalite}}</td>
                        <th scope="row" class="bg-gray">LIEU NAISSANCE</tH>
                        <td  class="text-uppercase">{{$personnel->lieu_n}}</td>
                        <th scope="row" class="bg-gray">ADRESSE</th>
                        <td  class="text-uppercase">{{$personnel->adresse}}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="bg-gray">SITUATION MATRIMONIALE</tH>
                        <td  class="text-uppercase">{{$personnel->st_matri}}</td>
                        <th scope="row" class="bg-gray">NBRE ENFANT</th>
                        <td  class="text-uppercase">{{$personnel->enfant}}</td>
                         <th scope="row" class="bg-gray">
                            CONTRAT
                         </th>
                        <td  class="text-uppercase">
                            {{@$personnel->contrat_id}}
                        </td>
                    </tr>
                     <tr>
                        <th scope="row" class="bg-gray">CONTACT</tH>
                        <td  class="text-uppercase">{{$personnel->contact}}</td>

                        <th scope="row" class="bg-gray">N°CNPS</tH>
                        <td  class="text-uppercase">{{$personnel->cnps}}</td>
                        <th scope="row" class="bg-gray">N°CMU</th>
                        <td  class="text-uppercase">{{$personnel->cmu}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Fiche d'evaluation</th>
                    <th scope="col">Consulter</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fiches as $f)
                <tr class="">
                    <td scope="row">
                       {{$f->name.' - '.$f->annee}}
                    </td>
                    
                    <td class="">
                        <a href="{{route('personnel_evaluation',[$personnel->id,'fiche'=>$f->id])}}" class="btn btn-default btn-sm btn-xs"> Afficher </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>