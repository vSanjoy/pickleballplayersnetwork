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
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
        <title>{!! $title !!}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/site/bootstrap.min.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

        <!-- Custom styles for this template -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/site/style.css') }}" />
        
        <!-- Datepicker -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
        <!-- Sweetalert -->
        <link href="{{ asset('css/admin/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
        <!-- Toastr css -->
        <link href="{{ asset('css/admin/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />
        <!-- Development css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/site/development.css') }}" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="header_take_place"></div>
        @yield('content')
        
        <!-- Pre-loader start -->
        <div class="preloader" style="display: none;">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- Pre-loader end -->
        
        <input type="hidden" name="website_link" id="website_link" value="{{ url('/') }}" />
        <input type="hidden" name="current_city" id="current_city" value="{{ Session::get('citySlug') }}" />
        
        @if(!Auth::user())
            @php
            $redirectTo = '';
            if (isset($_GET['popup']) && isset($_GET['redirect']) && $_GET['popup'] == 'login' && $_GET['redirect'] == 'join-a-league') {
                $redirectTo = 'join-a-league';
            }
            $states = getStates();
            @endphp
        <!-- Login modal start -->
        <div class="modal fade loginModal" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="loginForm">
                            <form name="loginForm" id="loginForm">
                                {{ Form::hidden('redirect_to', $redirectTo, [
                                                'id' => 'redirect_to',
                                            ]) }}
                                <div class="holder-inner">
                                    <label class="placeholder-label-popup">Email<span class="text-red">*</span></label>
                                    {{ Form::text('email', null, [
                                                    'placeholder' => '',
                                                    'class' => 'placeholder-input',
                                                    'required' => true,
                                                ]) }}
                                </div>
                                <div class="show-password">
                                    <div class="holder-inner">
                                        <label class="placeholder-label-popup">Password<span class="text-red">*</span></label>
                                        <input type="password" name="password" value="" placeholder="" class="togglePassword placeholder-input" required>
                                        <span toggle=".togglePassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>
                                <button type="submit">Login</button>
                            </form>
                            <div class="createHolder">
                                <div class="createAcount"><a href="{{ route('site.registration') }}">Create Account</a></div>
                                <div class="forgetPass"><a id="openForgotPasswordModal" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a></div>
                            </div>
                            <div class="required-fields-position">
                                <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login modal end -->
        <!-- Forgot Password modal start -->
        <div class="modal fade loginModal" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="loginForm">
                            <form name="forgotPasswordForm" id="forgotPasswordForm">
                                <div class="holder-inner">
                                    <label class="placeholder-label-popup">Email<span class="text-red">*</span></label>
                                    {{ Form::text('email', null, [
                                                    'placeholder' => '',
                                                    'class' => 'placeholder-input',
                                                    'required' => true,
                                                ]) }}
                                </div>
                                <button type="submit">Submit</button>
                            </form>
                            <div class="createHolder">
                                <div class="createAcount"><a href="{{ route('site.registration') }}">Create Account</a></div>
                                <div class="forgetPass"><a id="openLoginModal" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></div>
                            </div>
                            <div class="required-fields-position">
                                <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Forgot Password modal end -->
        <!-- Reset Password modal start -->
        <div class="modal fade loginModal" id="resetPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="loginForm">
                            <form name="resetPasswordForm" id="resetPasswordForm">
                                <div class="holder-inner">
                                    <label class="placeholder-label-popup">OTP<span class="text-red">*</span></label>
                                    {{ Form::password('otp', [
                                                        'id'    => 'otp',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                </div>
                                <div class="holder-inner">
                                    <label class="placeholder-label-popup">New Password<span class="text-red">*</span></label>
                                    {{ Form::password('password', [
                                                        'id'    => 'reset_password',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                </div>
                                <div class="holder-inner">
                                    <label class="placeholder-label-popup">Confirm Password<span class="text-red">*</span></label>
                                    {{ Form::password('confirm_password', [
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                </div>
                                <button type="submit">Submit</button>
                            </form>
                            <div class="createHolder">
                                <div class="createAcount"><a href="{{ route('site.registration') }}">Create Account</a></div>
                                <div class="forgetPass"><a id="openLoginModal" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></div>
                            </div>
                            <div class="required-fields-position">
                                <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reset Password modal end -->
        <!-- Pickleball Court modal start -->
        <div class="modal fade loginModal" id="pickleballCourtModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add A Pickleball Court</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="loginForm">
                            <form name="pickleballCourtForm">
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Court Name<span class="text-red">*</span></label>
                                            {{ Form::text('court_name', null, [
                                                            'placeholder' => '',
                                                            'class' => 'placeholder-input',
                                                            'required' => true,
                                                        ]) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">City<span class="text-red">*</span></label>
                                            {{ Form::text('city', null, [
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">State<span class="text-red">*</span></label>
                                            <select name="state_id" class="placeholder-input">
                                                <option value=""></option>
                                            @foreach ($states as $item)
                                                <option value="{{ $item->id }}">{!! $item->title !!}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Address</label>
                                            {{ Form::text('address', null, [
                                                            'placeholder' => '',
                                                            'class' => 'placeholder-input',
                                                        ]) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Zip</label>
                                            {{ Form::text('zip', null, [
                                                            'placeholder' => '',
                                                            'class' => 'placeholder-input',
                                                        ]) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Number of Courts</label>
                                            <select name="number_of_courts" id="number_of_courts" class="placeholder-input">
                                                <option value=""></option>
                                            @for ($courts = 1; $courts <= 30; $courts++)
                                                <option value="{{$courts}}">{{$courts}}</option>
                                            @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Accessibility</label>
                                            <select name="accessibility" class="placeholder-input">
                                                <option value=""></option>
                                                <option value="PR">Private</option>
                                                <option value="PL">Public</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Indoor/Outdoor</label>
                                            <select name="indoor_outdoor" class="placeholder-input">
                                                <option value=""></option>
                                                <option value="ID">Indoor</option>
                                                <option value="OD">Outdoor</option>
                                                <option value="B">Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit">Submit</button>

                                <div class="required-fields-position">
                                    <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pickleball Court modal end -->
        <!-- League Signup modal start -->
        <div class="modal fade leagueSignupModal" id="leagueSignupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">League Sign Up</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="loginForm">
                            <form name="leagueSignupForm">
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Team Name<span class="text-red">*</span></label>
                                            {{ Form::text('team_name', null, [
                                                            'placeholder' => '',
                                                            'class' => 'placeholder-input',
                                                            'required' => true,
                                                        ]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <div class="holder-inner">
                                            {{-- <label class="placeholder-label-popup">Player 1 Name<span class="text-red">*</span></label> --}}
                                            {{ Form::text('player_1_name', 'Brian Kostukovsky', [
                                                        'placeholder' => '',
                                                        // 'class' => 'placeholder-input',
                                                        'class' => '',
                                                        'required' => true,
                                                        'readonly' => true,
                                                    ]) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Player 2 Name<span class="text-red">*</span></label>
                                            {{ Form::text('player_2_name', null, [
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                        </div>
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Player 2 Email<span class="text-red">*</span></label>
                                            {{ Form::text('player_2_email', null, [
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                        </div>
                                        <label class="league-signup-message">Don't have a partner?<br />
                                            <a href="javascript: void(0);" id="need-partner"><u>Click here to add yourself to the players who need a partner list</u></a>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-6 col-8 form-group">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-popup">Promo Code</label>
                                            {{ Form::text('player_1_name', null, [
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-4 form-group">
                                        <button type="button" class="apply-promo-code">Apply</button>
                                    </div>
                                    <div class="col-lg-2 form-group">
                                        <span class="text-red registration-amount"><strong>$39.99</strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <div class="form-check" id="leagueSignupAgree">
                                            <input class="form-check-input popup-accept" type="checkbox" value="1" id="signup-agree" name="signup-agree">
                                            <label class="form-check-label" for="signup-agree">Accept <a href="{{ route('site.terms-of-use') }}" target="_blank"><u>Terms of Use</u></a><span class="text-red">*</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 form-group">&nbsp;</div>
                                </div>
                                
                                <button type="submit">Register</button>


                                <div class="required-fields-position">
                                    <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- League Signup modal end -->
        <!-- Need partner modal start -->
        <div class="modal fade needPartnerModal" id="needPartnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="loginForm">
                            <p>You have been added to the <strong>Players who need a partner</strong> list for the <strong>League Name</strong>.</p>
                            <p>Other solo players interested in this league will be able to reach out to you via email to see if you are a good partner match.</p>
                            <p>Good Luck!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Need partner modal end -->
        @endif

        <!-- Bootstrap core JavaScript
        ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/site/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://use.fontawesome.com/4b1a371264.js"></script>
        {{-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> --}}
        {{-- <script src="/path/to/dist/js/a11yAccordion.js"></script> --}}
        <script type="text/javascript" src="{{ asset('js/site/jquery.validate.min.js') }}"></script>

        @if (Route::currentRouteName() == 'site.registration')
        <!-- Selectpicker -->
        {{-- <link href="{{ asset('css/site/bootstrap-select.min.css') }}" rel="stylesheet">
        <script src="{{asset('js/site/bootstrap-select.min.js')}}"></script> --}}
        <link rel="stylesheet" href="{{asset('css/admin/plugins/selectpicker/bootstrap-select.css')}}">
        <script src="{{asset('js/admin/plugins/selectpicker/bootstrap-select.js')}}"></script>
        <script type="text/javascript">
        $(function () {
            $('.selectpicker').select2({}).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
                $(".select2-results:not(:has(a))").append('<div class="dropdown_devider"></div>'+
                '<div class="fixed_dropdown">'+
                    '<a href="javascript: void(0);" class="link-text-black padding_left_6">Private Residence / At Home Court</a><br>'+
                    '<div class="dropdown_separator"></div>'+
                    '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#pickleballCourtModal" class="add_new_pickleball_court">'+
                        // '<i class="fa fa-plus-circle green-plus" aria-hidden="true"></i> Can’t find your court, click here to add it</a>'+
                        '<img src="{{ asset("images/site/plus-circle.png") }}" style="width: 18px;" /> Can’t find your court, click here to add it</a>'+
                '</div>');
                $('.select2-search__field').attr('placeholder', 'Start Typing Here...');
            });
        });
        </script>
        <style>
        .select2-container {width: 100% !important; z-index: 9;}
        .select2-container--default .select2-selection--single {border: 1px solid #e7e6e6 !important; border-radius: 0px !important;}
        .select2-container .select2-selection--single {height: 58px !important;}
        .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 36px; font-size: 14px; padding: 10px 22px; background: none; color: #000000;}
        .select2-container--default .select2-selection--single .select2-selection__arrow {top: 17px;}
        .select2-container--open .select2-dropdown--above {z-index: 10 !important;}
        .select2-dropdown{ z-index: 9 !important;}
        .select2-container--default .select2-search--dropdown .select2-search__field{outline: none !important;}
        </style>
        @endif
        
        <!-- date-range-picker -->
        <!-- Bootstrap Date-Picker Plugin -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script type="text/javascript">
        // var jsWebsiteUrl = $('#website_link').val();
        var jsWebsiteUrl = "{{ getBaseUrl() }}";
        $(document).ready(function() {
            // Tooltip
            $('[data-toggle="tooltip"]').tooltip();
        });
        </script>

        <!-- Custom -->
        <script src="{{asset('js/site/custom.js')}}"></script>
        <!-- Sweetalert -->
        <script src="{{ asset('js/admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <!-- Fancybox -->
        <link href="{{ asset('css/admin/plugins/fancybox/jquery.fancybox.min.css') }}" rel="stylesheet">
        <!-- Fancybox -->
        <script src="{{ asset('js/admin/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
        <!-- Toastr js & rendering -->
        <script src="{{ asset('js/admin/plugins/toastr/toastr.min.js') }}"></script>
        @toastr_render
        <script src="{{asset('js/site/development.js')}}"></script>

        @stack('scripts')
        <script type="text/javascript">
        @if(!Auth::user())
            @if (isset($_GET['popup']) && $_GET['popup'] == 'login')
            $(document).ready(function() {
                $('#loginModal').modal('show');
            });
            @endif
        @else
            @if (isset($_GET['popup']) && isset($_GET['redirect']) && $_GET['popup'] == 'login' && $_GET['redirect'] == 'join-a-league')
                window.location.href = $('#website_link').val() + '/users/join-a-league';
            @elseif (isset($_GET['popup']) && $_GET['popup'] == 'login')
                window.location.href = $('#website_link').val() + '/users/profile';
            @endif
            
        @endif
        </script>

        @stack('stripe-payment')

    </body>
</html>