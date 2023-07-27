@php
$Userchantiers = (Auth::user()->hasRole('admin|Admin') ? \App\Chantier::where('archive','<>',1)->get() : Auth::user()->chantiers()->where('archive','<>',1)->get() ) ;
@endphp
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        {{-- <div class="clearfix"></div> --}}
        <!--- Profile -->
        <div class="profile-info text-center">
            <div class="mt-1" style="margin-top: 5px;">
                {{-- <div class="col-xs-12">
                  <a href="{{route('home')}}" class="rounded-image profile-image"><img src="{{asset('assets/img/logo-cercle.png')}}"></a>
                </div> --}}
                <br>
                <div class="col-xs-12">
                    <div class="profile-text">Bienvenue <b class="text-capitalize">{{ @Auth::user()->name.'('.@Auth::user()->roles()->first()->name.')' }}</b></div>
                </div>
                 <hr class="divider">
            </div>

            <div class="col-xs-12">
                <form action="{{ route('chantier.select') }}" method="POST">
                    @csrf
                    <div class="profile-text">
                        <select name="chantierselect" style="width: 80%; ">
                            <option value=""></option>
                            @foreach($Userchantiers as $chantier )
                            <option value="{{ $chantier->id }}" @if($chantier->id == session('chantier')) selected @endif>{{ $chantier->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success" style="padding: 2px 10px;">Ok</button>
                    </div>
                </form>
            </div>
        </div>
        <!--- Divider -->

        <div class="clearfix"></div>
        <hr class="divider">
        <div id="sidebar-menu">
            <ul>
                @if(session('chantier'))
                @can('view_stocks')
               {{--  <li>
                    <a href="{{ route('home') }}" id="active-tb">
                        <i></i>
                        <span> Tableau de bord</span>
                    </a>
                </li> --}}
                @can('view_stocks')
                <li>
                    <a href='{{ route('stocks.index') }}' id="active-stocks">
                        <i class='fa fa-table'></i>
                        <span>Point de stock</span> 
                    </a>
                </li>
                @endcan
                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                          <i class='fa fa-table'></i>
                            <span>Gestion de stock</span>
                            <span class="pull-right">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        {{-- @can('view_stocks')
                         <li>
                            <a href='{{ route('stocks.index') }}' id="active-stocks">
                            <span>Point de Stock</span>
                        </a>
                        </li>
                        @endcan --}}

                        @can('view_sorties')
                        <li><hr class="divider" style="margin:0px;width:100%"></li>
                        <li>
                            <a href='{{ route('sorties.index') }}' id="active-sorties">
                            <span> <i class="fa fa-arrow-left" aria-hidden="true"></i> Consommation </span>
                        </a>
                        </li>
                        @endcan
                        @can('view_entres')
                        <li>
                            <a href='{{ route('entres.index') }}' id="active-generation">
                                <span><i class="fa fa-arrow-right" aria-hidden="true"></i>  Réception</span>
                            </a>
                        </li>
                        @endcan

                        @can('view_entres')
                        <li>
                            <a href='{{ route('entre2') }}' id="active-generation">
                                <span><i class="fa fa-arrow-right" aria-hidden="true"></i>  Retour</span> 
                            </a>
                        </li>
                        @endcan

                        @can('view_transferts')
                        <li><hr class="divider" / style="margin:0px;width:100%"></li>
                        <li>
                            <a href="{{ route('transfert') }}" id="active-transfert">
                                <span><i class="fa fa-exchange" aria-hidden="true"></i>Transfert </span>
                            </a>
                        </li>
                        @endcan

                        @can('view_rapports')
                        <li>
                            <a href="{{ route('rapports.index') }}" id="active-rapports">
                                Rapports
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('view_bons')
                <li class="has_sub">
                    <a href='javascript:void(0);'  id="active-bons">
                          <i class='fa fa-folder'></i>
                            <span>Bon de demande  <span class="badge badge-info allnotif">0</span></span>
                            <span class="pull-right">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('bons.index',['bons'=>'attente']) }}">
                                <span><i class='fa fa-folder'></i> En attente de validation  <span class="badge badge-info commande">0</span></span>
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('bons.index',['bons'=>'valider']) }}">
                                <span><i class='fa fa-folder'></i> valider {{--  <span class="badge badge-info commande">0</span> --}}</span>
                            </a>
                        </li>
                         {{-- <li>
                            <a href="{{ route('bons.index',['bons'=>'terminer']) }}">
                                <span><i class='fa fa-folder'></i> Terminer  <span class="badge badge-info commande">0</span></span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('bons.index',['bons'=>'annuler']) }}">
                                <span><i class='fa fa-folder'></i> Annuler    <span class="badge badge-info ntfannuler">0</span></span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                {{-- @can('view_boncaisses')
                <li class="has_sub">
                    <a href='javascript:void(0);'  id="active-boncaisses">
                          <i class='fa fa-folder'></i>
                            <span>Bon de Caisse </span>
                            <span class="pull-right">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('boncaisses.index',['boncaisses'=>'attente']) }}">
                                <span><i class='fa fa-folder'></i> En attente de validation </span>
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('boncaisses.index',['boncaisses'=>'valider']) }}">
                                <span><i class='fa fa-folder'></i> Valider</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('boncaisses.index',['boncaisses'=>'annuler']) }}">
                                <span><i class='fa fa-folder'></i> Annuler </span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan --}}

                {{-- @can('view_tickets')
                 <li class='has_sub'>
                    <a href='javascript:void(0);'>
                          <i class='fa fa-tags'></i>
                            <span>Tickets</span>
                            <span class="pull-right">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a href="#" id="active-rapports">
                                <span><i class="fa fa-history" aria-hidden="true"></i> #Liste des tickets</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="active-rapports">
                                <span><i class="fa fa-history" aria-hidden="true"></i> #Nouveau ticket</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="active-rapports">
                                <span><i class="fa fa-history" aria-hidden="true"></i> #Mes tickets</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="active-rapports">
                                <span><i class="fa fa-history" aria-hidden="true"></i> #Statistiques</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan --}}
                @can('view_materiels')
                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa  fa-cube'></i>
                        <span>Gestions du matéreils</span>
                        <span class="pull-right">
                        <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a href='{{ route('materiels.index') }}' id="active-entres-table">
                            <span>Materiels</span>
                            </a>
                        </li>

                        @can('view_categories')
                        <li>
                            <a href='{{ route('categories.index') }}' id="active-categories">
                            <span>Categories</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('view_outils')
                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa  fa-cog'></i>
                            <span>Outils d'assignation</span>
                            <span class="pull-right">
                        <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>

                        <li>
                            <a href='{{ route('outils.index') }}' id="active-outils">
                            <span>Liste des outils</span>
                            </a>
                        </li>
                        <li><hr class="divider" / style="margin:0px;width:100%"></li>
                        @can('view_assignations')
                        <li>
                            <a href="{{ route('assignation') }}" id="active-assignation">
                                <span>Assigner un outil</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('view_personnels')
                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa fa-users'></i>
                            <span>Gestion Personnel</span>
                            <span class="pull-right">
                        <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>

                        <li>
                            <a href='{{ route('personnels.index') }}' id="active-personnels">
                            <span>Liste du personnel</span>
                            </a>
                        </li>

                        {{-- <li>
                            <a href='{{route('demande.index')}}' id="active-demandes">
                            <span>Les demandes</span>
                            </a>
                        </li>

                        <li>
                            <a href='{{route('document.index')}}' id="active-documents">
                            <span>Documents</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                @endcan
                @can('view_chantiers')
                <li>

                    <a href="{{ route('chantiers.index') }}" id="active-chantiers">
                        <i class='fa fa-home'></i>
                        <span>Zone de stockage </span>
                    </a>
                </li>
                @endcan
                @can('view_fournisseurs')
                <li>
                    <a href="{{route('fournisseurs.index')}}" id="active-fournisseurs">
                        <i class="fa fa-building"></i>
                        <span>Direction</span>
                    </a>
                </li>
                @endcan
                @can('view_users')
                <li>
                    <a href='{{ route('users.index') }}' id="active-users">
                        <i class='fa fa-users'></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
                @endcan
                @can('view_settings')
                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa  fa-cogs'></i>
                            <span>Parametres</span>
                            <span class="pull-right">
                        <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        @if(Auth::user()->hasRole('admin|Admin'))
                        <li>
                            <a href="{{ route('settings.index') }}" id="active-apps">
                                <span>Application</span>
                            </a>
                        </li>
                        @endif

                        @can('view_permissions')
                        <li>
                            <a href='{{ route('permissions.index') }}' id="active-permissions">
                            <span>Permissions</span>
                            </a>
                        </li>
                        @endcan
                        @can('view_roles')
                        <li>
                            <a href='{{ route('roles.index') }}' id="active-roles">
                            <span>Roles</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                {{-- <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa  fa-cogs'></i>
                            <span>Evaluation</span>
                            <span class="pull-right">
                        <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        @if(Auth::user()->hasRole('admin|Admin'))
                        <li>
                            <a href="{{route('fiches.index')}}" id="active-fiches">
                                <span>Fiche Evaluative</span>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li> --}}

                 @endif

            </ul>
            <div class="clearfix"></div>
        </div>

    <div class="clearfix"></div>
      <p>V1.0</p>
</div>
</div>
