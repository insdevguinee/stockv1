<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Connexion | Gestion </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="">
        <meta name="keywords" content="Login, connexion">
        <meta name="author" content="Evrard ACHI">

        <!-- Base Css Files -->
        {{-- <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" /> --}}
        <link href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/libs/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
        {{-- <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" /> --}}
        <link href="{{asset('assets/libs/animate-css/animate.min.css')}}" rel="stylesheet" />
        {{-- <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" /> --}}
        {{-- <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> --}}
        {{-- <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" /> --}}
        {{-- <link href="assets/libs/pace/pace.css" rel="stylesheet" /> --}}
        {{-- <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" /> --}}
        {{-- <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" /> --}}
        <link href="{{asset('assets/libs/jquery-icheck/skins/all.css')}}" rel="stylesheet" />
        <!-- Code Highlighter for Demo -->
        {{-- <link href="assets/libs/prettify/github.css" rel="stylesheet" /> --}}

                <!-- Extra CSS Libraries Start -->
                <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
                <!-- Extra CSS Libraries End -->
        <link href="{{asset('assets/css/style-responsive.css')}}" rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="assets/img/favicon.ico">
        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png" />
    </head>
    <body class="fixed-left login-page">
    <!-- Begin page -->
    <div class="container">
        <div class="full-content-center">
            {{-- <p class="text-center"><a href="#"><img src="assets/img/login-logo.png" alt="Logo"></a></p> --}}
            <div class="login-wrap animated flipInX">
                <div class="login-block">
                    <img src="{{asset('assets/img/logo-cercle.png')}}" class="img-circle not-logged-avatar" style="border: solid 2px #68C39F; background: white;">
                      <form method="POST" action="{{route('login.personnel')}}" autocomplete="off">
                        @csrf
                        <div class="form-group login-input">
                            <i class="fa fa-user overlay"></i>
                            <input type="text" class="form-control text-input @error('matricule') is-invalid @enderror" placeholder="MATRICULE" required autofocus name="matricule">
                            @error('matricule')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group login-input">
                            <i class="fa fa-user overlay"></i>
                            <input type="text" class="form-control text-input @error('password') is-invalid @enderror" placeholder="Mot de passe" required autofocus name="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-success">CONSULTER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- the overlay modal element -->
    <div class="md-overlay"></div>
    <!-- End of eoverlay modal -->
    <script>
        var resizefunc = [];
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('assets/libs/jquery/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.min.js')}}"></script>
    </body>
</html>
