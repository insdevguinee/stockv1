<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(env('APP_NAME')); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="">

        <!-- Base Css Files -->

        <link rel="stylesheet" href="<?php echo e(URL::to('assets/css/main.css')); ?>">
        <link href="<?php echo e(URL::to('assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/fontello/css/fontello.css')); ?> " rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/animate-css/animate.min.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/nifty-modal/css/component.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/magnific-popup/magnific-popup.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/ios7-switch/ios7-switch.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/pace/pace.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/sortable/sortable-theme-bootstrap.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/bootstrap-datepicker/css/datepicker.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/libs/jquery-icheck/skins/all.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(URL::to('assets/css/select2.min.css')); ?>" rel="stylesheet" />
        <script src="<?php echo e(URL::to('assets/libs/jquery/jquery-1.11.1.min.js')); ?>"></script>

        <script src="<?php echo e(URL::to('assets/libs/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(URL::to('assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js')); ?>"></script>
        <!-- Code Highlighter for Demo -->
        <link href="<?php echo e(URL::to('assets/libs/prettify/github.css')); ?>" rel="stylesheet" />

                <!-- Extra CSS Libraries Start -->
        <link href="<?php echo e(URL::to('assets/libs/rickshaw/rickshaw.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::to('assets/libs/morrischart/morris.css')); ?> " rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::to('assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::to('assets/libs/jquery-clock/clock.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::to('assets/libs/bootstrap-calendar/css/bic_calendar.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::to('assets/libs/sortable/sortable-theme-bootstrap.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::to('assets/libs/jquery-weather/simpleweather.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::to('assets/libs/bootstrap-xeditable/css/bootstrap-editable.css')); ?> " rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::to('assets/css/style.css')); ?> " rel="stylesheet" type="text/css" />
                <!-- Extra CSS Libraries End -->
        <link href="<?php echo e(URL::to('assets/css/style-responsive.css')); ?> " rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="<?php echo e(URL::to('assets/img/favicon.ico')); ?>">
        <link rel="apple-touch-icon" href="<?php echo e(URL::to('assets/img/apple-touch-icon.png')); ?>" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(URL::to('assets/img/apple-touch-icon-57x57.png')); ?>" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(URL::to('assets/img/apple-touch-icon-72x72.png')); ?>" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(URL::to('assets/img/apple-touch-icon-76x76.png')); ?>" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(URL::to('assets/img/apple-touch-icon-114x114.png')); ?>" />
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(URL::to('assets/img/apple-touch-icon-120x120.png')); ?>" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(URL::to('assets/img/apple-touch-icon-144x144.png')); ?>" />
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(URL::to('assets/img/apple-touch-icon-152x152.png')); ?>" />
      <?php echo $__env->yieldContent('style'); ?>
    </head>
    <body class="fixed-left">
    <div id="wrapper">
        <?php if(auth()->guard()->check()): ?>

            <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('partials.left_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <div class="content-page">

            <div class="content">
                <?php echo $__env->make('partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if(session('chantier')): ?>
                    <?php if(@\App\Rapport::where('chantier_id',session('chantier'))->latest()->first()->valider OR Auth::user()->can('view_rapports') OR Auth::user()->roles->contains('name','admin') OR count(@\App\Rapport::where('chantier_id',session('chantier'))->get()) == 0 ): ?>

                        <?php echo $__env->yieldContent('contents'); ?>

                    <?php else: ?>

                    
                        <p class="text-center">Rapport de la semaine du <strong><?php echo e(@\App\Rapport::where('chantier_id',session('chantier'))->latest()->first()->debut .' au '.@\App\Rapport::where('chantier_id',session('chantier'))->latest()->first()->fin); ?></strong> en attente de validation</p>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(@Auth::user()->personnel): ?>
                    <a href="<?php echo e(route('personnel.dashboard')); ?>" class="btn btn-default">
                        Voir votre profil Personnel
                    </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>


            <div class="md-overlay"></div>
        </div>
    </div>
    <script>
        var resizefunc = [];
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="<?php echo e(URL::to('assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/jquery-detectmobile/detect.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/jquery-animate-numbers/jquery.animateNumbers.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/ios7-switch/ios7.switch.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/fastclick/fastclick.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/jquery-blockui/jquery.blockUI.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/bootstrap-bootbox/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/jquery-slimscroll/jquery.slimscroll.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/jquery-sparkline/jquery-sparkline.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/nifty-modal/js/classie.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/nifty-modal/js/modalEffects.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/sortable/sortable.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/bootstrap-fileinput/bootstrap.file-input.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/bootstrap-select/bootstrap-select.min.js')); ?>"></script>

  <script src="<?php echo e(URL::to('assets/js/select2.min.js')); ?>"></script>
    
    <script src="<?php echo e(URL::to('assets/libs/magnific-popup/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/pace/pace.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/libs/jquery-icheck/icheck.min.js')); ?>"></script>

    <script src="<?php echo e(URL::to('assets/libs/prettify/prettify.js')); ?>"></script>

    <script src="<?php echo e(URL::to('assets/js/init.js')); ?>"></script>
    <script src="<?php echo e(URL::to('assets/js/scripts.js')); ?>"></script>
    <script>
        jQuery(document).ready(function($) {
            $.get('<?php echo e(route('commande.notif')); ?>', function(data) {
                console.log(data);
                $('.commande').text(data[1]);
                $('.ntfannuler').text(data[2]);
                $('.allnotif').text( data[1] + data[2] );
            });
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
    </body>
    </html>
<?php /**PATH /Applications/MAMP/htdocs/stockv1/resources/views/layouts/app.blade.php ENDPATH**/ ?>