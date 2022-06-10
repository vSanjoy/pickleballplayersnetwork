<!DOCTYPE html>
<html dir="ltr" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Administrator :: @if($title){{$title}} @else {{ getAppName() }} @endif</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <!-- Custom CSS -->
    <link href="{{ asset('css/admin/dist/style.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('css/admin/plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('js/admin/dist/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/jquery.validate.min.js') }}"></script>
    <!-- Toastr css -->
    <link href="{{ asset('css/admin/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <!-- Tooltip -->
    <link href="{{ asset('css/admin/plugins/tooltip/microtip.min.css') }}" rel="stylesheet">
    <!-- Development css -->
    <link href="{{ asset('css/admin/development.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>    
    @include('admin.includes.notification')

    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url({{asset('images/admin/big/auth-bg.jpg')}}) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url({{asset('images/admin/background/img5.jpg')}});">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    @yield('content')                    
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    {{-- <script src="assets/libs/jquery/dist/jquery.min.js "></script> --}}
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('js/admin/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('js/admin/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script type="text/javascript">
        $(".preloader").fadeOut();
    </script>

    <!-- Toastr js & rendering -->
    <script src="{{ asset('js/admin/plugins/toastr/toastr.min.js') }}"></script>
    @toastr_render
    <script src="{{ asset('js/admin/development.js') }}"></script>
</body>
</html>