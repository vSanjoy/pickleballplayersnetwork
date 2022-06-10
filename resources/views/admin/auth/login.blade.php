@extends('admin.layouts.login', ['title' => $pageTitle])

@section('content')

    @php
    $email = $password = null;
    if ($superAdminDetails) {
        $email      = $superAdminDetails->email ?? null;
        $password   = env('DEMO_LOGIN_PASSWORD') ?? null;
    }
    // Get site settings data
    $getSiteSettings = getSiteSettings();
    @endphp

    <div class="p-3">
        <div class="text-center">
            <img src="{{asset('images/admin/logo.png')}}" alt="" style="width: 250px;">
        </div>
        <h2 class="mt-3 text-center mb-3">@lang('custom_admin.label_sign_in')</h2>
        @if ($superAdminDetails)
        <p class="text-center">
            @lang('custom_admin.label_demo_login_details')<br>
            <a class="clickToCopy" href="javascript: void(0);" data-type="email" data-values="{{ $email }}" data-microtip-position="top" role="tooltip" aria-label="{{ trans('custom_admin.label_click_to_copy') }}">
                {{ $email }}
            </a> / 
            <a class="clickToCopy" href="javascript: void(0);" data-type="password" data-values="{{ $password }}" data-microtip-position="top" role="tooltip" aria-label="{{ trans('custom_admin.label_click_to_copy') }}">
                {{ $password }}
            </a>
        </p>
        @endif

        <div class='copied'></div>

        {{ Form::open([
                    'method'=> 'POST',
                    'class' => '',
                    'route' => [$routePrefix.'.login'],
                    'name'  => 'adminLoginForm',
                    'id'    => 'adminLoginForm',
                    'files' => true,
                    'novalidate' => true]) }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="font-bold">@lang('custom_admin.label_email')<span class="red_star">*</span></label>
                        {{ Form::text('email', null, array(
                                                        'id' => 'email',
                                                        'class' => 'form-control',
                                                        'placeholder' => '',
                                                        'required' => 'required' )) }}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="font-bold">@lang('custom_admin.label_password')<span class="red_star">*</span></label>
                        {{ Form::password('password', array(
                                                            'id' => 'password',
                                                            'class' => 'form-control',
                                                            'placeholder' => '',
                                                            'required' => 'required' )) }}
                    </div>
                </div>
                {{-- <div class="col-lg-12">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input cursor-pointer" id="customCheck2" name="remember_me">
                        <label class="custom-control-label cursor-pointer" for="customCheck2">@lang('custom_admin.label_remember_me')</label>
                    </div>
                </div> --}}
                <div class="col-lg-12 text-center margintop20">
                    <button type="submit" id="btn-processing" class="btn btn-block waves-effect waves-light btn-rounded btn-primary shadow-md">
                        <i class="fa fa-sign-in" aria-hidden="true"></i> @lang('custom_admin.label_sign_in')
                    </button>
                </div>
                <div class="col-lg-12 text-center mt-5">
                    @lang('custom_admin.message_admin_forgot_password') <a href="{{ route($routePrefix.'.forgot-password') }}" class="text-danger">@lang('custom_admin.message_admin_click_here')</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection