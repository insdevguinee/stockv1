<!-- Modal Logout -->
<div class="md-modal md-just-me" id="logout-modal" style="background: #ddd;">
  <div class="md-content">
    
    <div>
      <p class="text-center">Voulez-vous vraiment vous déconnecter ?</p>
      <p class="text-center">
      <button class="btn btn-danger md-close">Non</button>
      <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="btn btn-success md-close">Oui, je me deconnecte</a>
      </p>
    </div>
  </div>
</div>        <!-- Modal End -->
<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>

<div class="topbar">
    <div class="topbar-left">
        <div class="logo">
            <h1><a href="/"><img style="width: 75px" src="<?php echo e(URL::to('assets/img/logo.png')); ?>" alt="Logo" style=""></a></h1>
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
                        <a href="#" class="dropdown-toggle text-capitalize" data-toggle="dropdown"><?php echo e(Auth::user()->name); ?> <span  class="badge badge-info commande"><?php echo e(@Auth::user()->notifications()->wherePivot('show',1)->count()); ?></span><i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">

                            
                            <li><a href="<?php echo e(route('notifications.index')); ?>"> Notifications <span class="badge badge-info notif"><?php echo e(@Auth::user()->notifications()->wherePivot('show',1)->count()); ?></span></a></li>
                            <li><a href="<?php echo e(route('users.edit',[Auth::id()])); ?>">Mon Profil</a></li>
                            
                            
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo e(URL('#')); ?>" target="_blank">
                                    Boite Mail
                                </a>
                            </li>
                            <li><a href="<?php echo e(route('aide')); ?>"><i class="icon-help-2"></i>Aide</a></li>
                            
                            
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
<?php /**PATH /home/damaro/Bureau/stockv1/resources/views/partials/header.blade.php ENDPATH**/ ?>