<?php
  $mois = (isset($_GET['mois'])) ? $_GET['mois'] : date('m');
  $minStock = \App\Setting::findOrFail(1)->notifnumb;
  $cat = $getDate['cat'];
  $min = $getDate['min'];
  $max = $getDate['max'];
?>

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo e(URL::to('assets/libs/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
		<title>Rapport <?php echo e($min.' au '.$max); ?></title>
    <style>
      body{
        background: #fff;
      }
      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .middle {
          vertical-align: middle;
          text-align: center;
      }
      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        padding: 5px;
      }
      .table {
        margin-bottom: 0px;
      }
    </style>
	</head>
	<body>
    <div id="content">
		<div class="row">
			<div class="col-md-6 float-left">
				<img src="<?php echo e(URL::to('assets/img/logo_socoexim.png')); ?>" style="height: 70px;" alt="Logo"> <br>
        <strong>CHANTIER : <?php echo e(\App\Chantier::findOrFail(session('chantier'))->name); ?></strong>
			</div>
      <div class="col-md-6 float-right text-right">
        Date : <?php echo e($min.' au '.$max); ?>

      </div>
		</div>

      <?php if($rapport): ?>
        <?php $__currentLoopData = \App\Categorie::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  		    <?php echo $__env->make('partials.rapportPdfexport',['categorie'=>$categorie], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <?php echo $__env->make('partials.rapportPdfexport',['categorie'=>$categorie], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
       

      
      </div>
      
	</body>
</html>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<?php /**PATH /home/damaro/Bureau/stockv1/resources/views/exports/pdfresume.blade.php ENDPATH**/ ?>