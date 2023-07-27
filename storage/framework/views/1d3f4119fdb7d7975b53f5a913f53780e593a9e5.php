<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href='<?php echo e(route('personnel.dashboard')); ?>' id="active-sorties">
                        <span> Mon Profil </span>
                    </a>
                </li>

                <li>
                    <a href='<?php echo e(route('demandes')); ?>' id="active-generation">
                        <span>Demande de permission</span>
                    </a>
                </li>

                <li>
                    <a href='<?php echo e(route('personnel.fichier')); ?>' id="active-fichiers">
                        <span>Mes Documents</span>
                    </a>
                </li>
               
                <li><hr class="divider" style="margin:0px;width:100%"></li>
                <li>
                    <a href='<?php echo e(route('personnel.edit')); ?>' id="active-fichiers">
                        <span>Modifier mon profil</span>
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
</div>
</div>
<?php /**PATH /home/damaro/Bureau/stockv1/resources/views/personnels/profil/partials/_left_side.blade.php ENDPATH**/ ?>