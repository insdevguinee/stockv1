

<?php $__env->startSection('title'); ?>
  Outils de Travail
<?php $__env->stopSection(); ?>
<?php $i = 1; ?>
<?php $__env->startSection('contents'); ?>
  <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default widget">
          <div class="widget-header">
             <h2>Outils de travail  </h2>

          </div>
          <div class="panel-body widget-content">
            <div class="table-responsive">
              <table  id="datatables-1" data-sortable class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Categorie</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Etat</th>
                    <th>Numero de serie / Code</th>
                    <th> <span class="badge-primary badge" ><?php echo e(@$outils->count()); ?></span></th>
                  </tr>
                </thead>

                <tbody>
                  <?php $__currentLoopData = $outils->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                      <?php echo e($i++); ?>

                    </td>
                    <td>
                      <?php echo e(@$outil->categorie->name); ?>

                    </td>
                    <td><?php echo e($outil->name); ?></td>
                    <td><?php echo e($outil->qte); ?></td>
                    <td>
                      <?php echo e(($outil->etat==1)?'Fonctionne':'En panne'); ?>

                    </td>
                    <td>
                      <?php echo e(@$outil->description); ?>

                    </td>
                    <td>

                      <div class="btn-group btn-group-xs">
                        <a href="<?php echo e(route('outils.show',$outil->id)); ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_outils')): ?>
                           <a href="<?php echo e(route('outils.edit',$outil->id)); ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                           <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_outils')): ?>
                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['outils.destroy', $outil->id] ,'style'=>'display:inline-block !important;margin:0;float:right;','onsubmit'=>'return show_alert();' ]); ?>

                                  <button style="padding: 2px 5px;font-size: 10px;" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                <?php echo Form::close(); ?>

                        <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>

<div class="col-md-4">
  <div class="widget clearfix">
    <div class="widget-header transparent clearfix">
      <h2 class="text-center"><strong>Ajouter</strong> un Outil de travail</h2>

    </div>
    <div class="widget-content padding clearfix">
      <div id="basic-form">
        <form action="<?php echo e(route('outils.store')); ?>" method="POST" role="form">
        <?php echo csrf_field(); ?>

        <div class="form-group <?php if($errors->has('name')): ?> has-error <?php endif; ?>">
          <label>Nom</label>
          <input required type="text" class="form-control"  name="name">
        </div>
         <div class="form-group ">
        <div class="form-group">
          <label>Quantité</label>
          <input type="number" class="form-control" name="qte">
        </div>
        <label>Categorie</label>
        <select name="categorie" id="categorie" class="form-control" required>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($categorie->id); ?>"><?php echo e($categorie->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
        <div class="form-group ">
        <label>Nuemro de Serie / Description</label>
          <textarea class="form-control"  name="description" required></textarea>
        </div>
      <button type="submit" class="btn btn-success pull-left">Enregistrer</button>
    </form>
  </div>
</div>




          </div>
    </div>
    
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/js/dataTables.bootstrap.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js')); ?>"></script>

   <script src="<?php echo e(URL::to('assets/js/pages/inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/jquery.inputmask.min.js')); ?>"></script>
  <script src="<?php echo e(URL::to('assets/js/pages/datatables.js')); ?>"></script>
<script>
       $('#active-outils').addClass('active');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/outils/index.blade.php ENDPATH**/ ?>