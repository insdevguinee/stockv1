<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Entrée de Marchandise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="basic-form">
                  <form action="<?php echo e(route('entres.store')); ?>" method="POST" role="form" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class="form-group <?php if($errors->has('type_id')): ?> has-error <?php endif; ?>">
                        <label for="type_id">Materiel</label>
                        <select class="form-control" name="materiel_id">
                          <option value=""></option>
                          <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                      <div class="form-group <?php if($errors->has('date')): ?> has-error <?php endif; ?>">
                      <label for="date">Date</label>
                      <input type="text" class="form-control datepicker-input date" placeholder="aaaa-mm-jj"  name="date" data-mask="9999-99-99" value="<?php echo e(date('yy/m/d')); ?>">
                        <?php if($errors->has('date')): ?> <div class="help-block">
                           <?php echo e($errors->first('date')); ?>

                        </div>
                      <?php endif; ?>
                      </div>
                        <div class="form-group <?php if($errors->has('nfacture')): ?> has-error <?php endif; ?>">
                        <label for="nfacture">N°BON</label>
                        <input type="number" class="form-control" name ="nfacture" data-inputmask="'mask': '9999'" />
                        <?php if($errors->has('nfacture')): ?> <div class="help-block">
                           <?php echo e($errors->first('nfacture')); ?>

                        </div>
                        <?php endif; ?>
                        </div>
                        <div class="form-group <?php if($errors->has('quantite')): ?> has-error <?php endif; ?>">
                        <label for="quantite">Quantité</label>
                        <input type="number" step='0.01' class="form-control" name="quantite" data-mask="0" placeholder="0">
                        <?php if($errors->has('quantite')): ?> <div class="help-block">
                           <?php echo e($errors->first('quantite')); ?>

                        </div>
                      <?php endif; ?>
                      </div>
                     
                    <div class="form-group <?php if($errors->has('fourni')): ?> has-error <?php endif; ?>">
                    <label for="fourni">Fournisseur</label>
                    <input type="text" class="form-control" name ="fourni">
                    <?php if($errors->has('fourni')): ?> <div class="help-block">
                       <?php echo e($errors->first('fourni')); ?>

                    </div>
                    <?php endif; ?>
                    </div>
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-default">Enregistrer</button>
                  </form>
          </div>
      </div>
    </div>
  </div>
</div><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/partials/modalEntre.blade.php ENDPATH**/ ?>