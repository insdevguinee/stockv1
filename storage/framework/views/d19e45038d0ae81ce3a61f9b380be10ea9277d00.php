<?php
$Userchantiers = (Auth::user()->hasRole('admin|Admin') ? \App\Chantier::where('archive','<>',1)->get() : Auth::user()->chantiers()->where('archive','<>',1)->get() ) ;
?>
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        
        <!--- Profile -->
        <div class="profile-info text-center">
            <div class="mt-1" style="margin-top: 5px;">
                
                <br>
                <div class="col-xs-12">
                    <div class="profile-text">Bienvenue <b class="text-capitalize"><?php echo e(@Auth::user()->name.'('.@Auth::user()->roles()->first()->name.')'); ?></b></div>
                </div>
                 <hr class="divider">
            </div>

            <div class="col-xs-12">
                <form action="<?php echo e(route('chantier.select')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="profile-text">
                        <select name="chantierselect" style="width: 80%; ">
                            <option value=""></option>
                            <?php $__currentLoopData = $Userchantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($chantier->id); ?>" <?php if($chantier->id == session('chantier')): ?> selected <?php endif; ?>><?php echo e($chantier->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php if(session('chantier')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_stocks')): ?>
               
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_stocks')): ?>
                <li>
                    <a href='<?php echo e(route('stocks.index')); ?>' id="active-stocks">
                        <i class='fa fa-table'></i>
                        <span>Point de stock</span> 
                    </a>
                </li>
                <?php endif; ?>
                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                          <i class='fa fa-table'></i>
                            <span>Gestion de stock</span>
                            <span class="pull-right">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_sorties')): ?>
                        <li><hr class="divider" style="margin:0px;width:100%"></li>
                        <li>
                            <a href='<?php echo e(route('sorties.index')); ?>' id="active-sorties">
                            <span> <i class="fa fa-arrow-left" aria-hidden="true"></i> Consommation </span>
                        </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_entres')): ?>
                        <li>
                            <a href='<?php echo e(route('entres.index')); ?>' id="active-generation">
                                <span><i class="fa fa-arrow-right" aria-hidden="true"></i>  Réception</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_entres')): ?>
                        <li>
                            <a href='<?php echo e(route('entre2')); ?>' id="active-generation">
                                <span><i class="fa fa-arrow-right" aria-hidden="true"></i>  Retour</span> 
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_transferts')): ?>
                        <li><hr class="divider" / style="margin:0px;width:100%"></li>
                        <li>
                            <a href="<?php echo e(route('transfert')); ?>" id="active-transfert">
                                <span><i class="fa fa-exchange" aria-hidden="true"></i>Transfert </span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_rapports')): ?>
                        <li>
                            <a href="<?php echo e(route('rapports.index')); ?>" id="active-rapports">
                                Rapports
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_bons')): ?>
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
                            <a href="<?php echo e(route('bons.index',['bons'=>'attente'])); ?>">
                                <span><i class='fa fa-folder'></i> En attente de validation  <span class="badge badge-info commande">0</span></span>
                            </a>
                        </li>
                         <li>
                            <a href="<?php echo e(route('bons.index',['bons'=>'valider'])); ?>">
                                <span><i class='fa fa-folder'></i> valider </span>
                            </a>
                        </li>
                         
                        <li>
                            <a href="<?php echo e(route('bons.index',['bons'=>'annuler'])); ?>">
                                <span><i class='fa fa-folder'></i> Annuler    <span class="badge badge-info ntfannuler">0</span></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_materiels')): ?>
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
                            <a href='<?php echo e(route('materiels.index')); ?>' id="active-entres-table">
                            <span>Materiels</span>
                            </a>
                        </li>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_categories')): ?>
                        <li>
                            <a href='<?php echo e(route('categories.index')); ?>' id="active-categories">
                            <span>Categories</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_outils')): ?>
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
                            <a href='<?php echo e(route('outils.index')); ?>' id="active-outils">
                            <span>Liste des outils</span>
                            </a>
                        </li>
                        <li><hr class="divider" / style="margin:0px;width:100%"></li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_assignations')): ?>
                        <li>
                            <a href="<?php echo e(route('assignation')); ?>" id="active-assignation">
                                <span>Assigner un outil</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_personnels')): ?>
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
                            <a href='<?php echo e(route('personnels.index')); ?>' id="active-personnels">
                            <span>Liste du personnel</span>
                            </a>
                        </li>

                        
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_chantiers')): ?>
                <li>

                    <a href="<?php echo e(route('chantiers.index')); ?>" id="active-chantiers">
                        <i class='fa fa-home'></i>
                        <span>Zone de stockage </span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_fournisseurs')): ?>
                <li>
                    <a href="<?php echo e(route('fournisseurs.index')); ?>" id="active-fournisseurs">
                        <i class="fa fa-building"></i>
                        <span>Direction</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_users')): ?>
                <li>
                    <a href='<?php echo e(route('users.index')); ?>' id="active-users">
                        <i class='fa fa-users'></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_settings')): ?>
                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa  fa-cogs'></i>
                            <span>Parametres</span>
                            <span class="pull-right">
                        <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <?php if(Auth::user()->hasRole('admin|Admin')): ?>
                        <li>
                            <a href="<?php echo e(route('settings.index')); ?>" id="active-apps">
                                <span>Application</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_permissions')): ?>
                        <li>
                            <a href='<?php echo e(route('permissions.index')); ?>' id="active-permissions">
                            <span>Permissions</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_roles')): ?>
                        <li>
                            <a href='<?php echo e(route('roles.index')); ?>' id="active-roles">
                            <span>Roles</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                

                 <?php endif; ?>

            </ul>
            <div class="clearfix"></div>
        </div>

    <div class="clearfix"></div>
      <p>V1.0</p>
</div>
</div>
<?php /**PATH /home/damaro/Bureau/stockv1/resources/views/partials/left_side.blade.php ENDPATH**/ ?>