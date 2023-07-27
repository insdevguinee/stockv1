<div class="panel">
    <div class="panel-body">
        <h5>Matricule : <?php echo e($personnel->matricule); ?> | Email : <?php echo e($personnel->email); ?></h5>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                    <tr>
                        <th scope="row" class="bg-gray">NOM</th>
                        <td class="text-uppercase"><?php echo e($personnel->civilite.'. '.$personnel->nom); ?></td>
                        <th scope="row" class="bg-gray">PRENOM(S)</th>
                        <td  class="text-uppercase"><?php echo e($personnel->prenoms); ?></td>
                        <th scope="row" class="bg-gray">DATE NAISSANCE</th>
                        <td  class="text-uppercase"><?php echo e($personnel->naissance); ?></td>
                    </tr>
                    <tr>

                        <th scope="row" class="bg-gray">DATE EMBAUCHE</th>
                        <td  class="text-uppercase"><?php echo e($personnel->embauche); ?></td>
                        <th scope="row" class="bg-gray">POSTE</th>
                        <td  class="text-uppercase"><?php echo e($personnel->poste); ?></td>
                        <th scope="row" class="bg-gray">SALAIRE BRUT</th>
                        <td  class="text-uppercase">#</td>

                    </tr>
                    <tr>

                    </tr>
                    <tr>
                        <th scope="row" class="bg-gray">NATIONNALITÉ</th>
                        <td  class="text-uppercase"><?php echo e($personnel->nationnalite); ?></td>
                        <th scope="row" class="bg-gray">LIEU NAISSANCE</tH>
                        <td  class="text-uppercase"><?php echo e($personnel->lieu_n); ?></td>
                        <th scope="row" class="bg-gray">ADRESSE</th>
                        <td  class="text-uppercase"><?php echo e($personnel->adresse); ?></td>
                    </tr>
                    <tr>
                        <th scope="row" class="bg-gray">SITUATION MATRIMONIALE</tH>
                        <td  class="text-uppercase"><?php echo e($personnel->st_matri); ?></td>
                        <th scope="row" class="bg-gray">NBRE ENFANT</th>
                        <td  class="text-uppercase"><?php echo e($personnel->enfant); ?></td>
                         <th scope="row" class="bg-gray">
                            CONTRAT
                         </th>
                        <td  class="text-uppercase">
                            <?php echo e(@$personnel->contrat_id); ?>

                        </td>
                    </tr>
                     <tr>
                        <th scope="row" class="bg-gray">CONTACT</tH>
                        <td  class="text-uppercase"><?php echo e($personnel->contact); ?></td>

                        <th scope="row" class="bg-gray">N°CNPS</tH>
                        <td  class="text-uppercase"><?php echo e($personnel->cnps); ?></td>
                        <th scope="row" class="bg-gray">N°CMU</th>
                        <td  class="text-uppercase"><?php echo e($personnel->cmu); ?></td>
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
                <?php $__currentLoopData = $fiches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="">
                    <td scope="row">
                       <?php echo e($f->name.' - '.$f->annee); ?>

                    </td>
                    
                    <td class="">
                        <a href="<?php echo e(route('personnel_evaluation',[$personnel->id,'fiche'=>$f->id])); ?>" class="btn btn-default btn-sm btn-xs"> Afficher </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div><?php /**PATH /home/damaro/Bureau/stockv1/resources/views/personnels/profil/partials/_personnelshow.blade.php ENDPATH**/ ?>