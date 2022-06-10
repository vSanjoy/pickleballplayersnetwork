<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="keywords" content="{!! $metaKeywords !!}" />
	    <meta name="description" content="{!! $metaDescription !!}" />
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/site/favicon.ico') }}"/>
        <title>{!! $title !!}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/site/plugins.css')}}">
        <link rel="stylesheet" href="{{ asset('css/site/fullpage.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/site/custom.css')}}">
        <link rel="stylesheet" href="{{ asset('css/site/responsive.css')}}">
        <!-- Toastr css -->
        <link href="{{ asset('css/admin/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />
        <!-- Development css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/site/development.css') }}" />
    </head>
    <body class="clicked">
        <div class="bodyWrap">
            <div class="bodyOverlay"></div>
            <span class="responsiveBtn bOff"><span></span></span>
            <div class="mainBody">
                @yield('content')
            </div>
        </div>

        <script type="text/javascript">
        var jsUrl = "{{asset('js/site')}}";
        var jsWebsiteUrl = "{{ getBaseUrl() }}";
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="{{ asset('js/site/plugins.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/site/fullpage.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/site/custom.js')}}"></script>
        <script type="text/javascript">
        var myFullpage = new fullpage('#fullpage', {
            sectionSelector: '.fpSection',
            //menu: '#resMenu',
            //anchors: ['home', 'gastro', 'the-science', 'contact'],
            navigation: true,
            navigationTooltips: ['Home', 'Gastro', 'The Science', 'Contact'],
            showActiveTooltip: true,
            verticalCentered: false,
            //responsiveHeight: 480,
            normalScrollElements: '.scrollable-element',
            afterLoad: function(origin, destination, direction) {
                if (destination.index == 3) {
                    document.querySelector('#contact').querySelector('.formBg4').style.bottom = 0 + 'px';
                } else if(origin && origin.index == 3){
                    document.querySelector('#contact').querySelector('.formBg4').style.bottom = '-' + 100 + '%';
                }
            }
        });
        </script>
        <script type="text/javascript" src="{{ asset('js/site/jquery.validate.min.js') }}"></script>
        <!-- Toastr js & rendering -->
        <script src="{{ asset('js/admin/plugins/toastr/toastr.min.js') }}"></script>
        @toastr_render
        <script src="{{asset('js/site/development.js')}}"></script>

        @stack('scripts')

    </body>
</html>