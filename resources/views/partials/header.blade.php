<!-- Modal Logout -->
<div class="md-modal md-just-me" id="logout-modal" style="background: #ddd;">
  <div class="md-content">
    {{-- <h3><strong>Deconnexion</strong> Confirmation</h3> --}}
    <div>
      <p class="text-center">Voulez-vous vraiment vous déconnecter ?</p>
      <p class="text-center">
      <button class="btn btn-danger md-close">Non</button>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="btn btn-success md-close">Oui, je me deconnecte</a>
      </p>
    </div>
  </div>
</div>        <!-- Modal End -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="topbar">
    <div class="topbar-left">
        <div class="logo">
            <h1><a href="/"><img style="width: 75px" src="{{ URL::to('assets/img/logo.png')}}" alt="Logo" style=""></a></h1>
        </div>
        <button class="button-menu-mobile open-left">
        <i class="fa fa-bars"></i>
        </button>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-collapse2">

                <ul class="nav navbar-nav navbar-right top-navbar">
                
                <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                    <li class="dropdown topbar-profile">
                        <a href="#" class="dropdown-toggle text-capitalize" data-toggle="dropdown">{{ Auth::user()->name }} <span  class="badge badge-info commande">{{ @Auth::user()->notifications()->wherePivot('show',1)->count() }}</span><i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">

                            {{-- @if (@Auth::user()->personnel)
                            <li>
                                <a href="{{route('personnel.dashboard')}}" target="_blank">
                                    Mon Profil Personnel
                                </a>
                            </li>
                            @endif --}}
                            <li><a href="{{ route('notifications.index') }}"> Notifications <span class="badge badge-info notif">{{ @Auth::user()->notifications()->wherePivot('show',1)->count() }}</span></a></li>
                            <li><a href="{{ route('users.edit',[Auth::id()]) }}">Mon Profil</a></li>
                            {{-- <li><a href="#"># Modifier mon mot de passe</a></li> --}}
                            {{-- <li><a href="#">Account Setting</a></li> --}}
                            <li class="divider"></li>
                            <li>
                                <a href="{{ URL('#') }}" target="_blank">
                                    Boite Mail
                                </a>
                            </li>
                            <li><a href="{{ route('aide') }}"><i class="icon-help-2"></i>Aide</a></li>
                            {{-- <li><a href="lockscreen.html"><i class="icon-lock-1"></i> Lock me</a></li> --}}
                            
                            <li><a class="md-trigger" data-modal="logout-modal"><i class="icon-logout-1"></i> Deconnexion</a></li>
                        </ul>
                    </li>
                    <li class="right-opener">
                        <a href="javascript:;" class="open-right"><i class="fa fa-angle-double-left"></i><i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</div>
