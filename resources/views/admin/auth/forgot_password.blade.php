@extends('admin.layouts.forgot_password', ['title' => $pageTitle])

@section('content')

    <div class="p-3">
        <div class="text-center">
            <img src="{{asset('images/admin/logo.png')}}" alt="" style="width: 250px;">
        </div>
        <h2 class="mt-3 text-center mb-3">@lang('custom_admin.label_forgot_password')</h2>
        <p class="text-center">@lang('custom_admin.message_registered_email')</p>

        {{ Form::open([
                    'method'=> 'POST',
                    'class' => '',
                    'route' => [$routePrefix.'.forgot-password'],
                    'name'  => 'forgotPasswordForm',
                    'id'    => 'forgotPasswordForm',
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
                <div class="col-lg-12"><label class="text-dark font-bold paddingmargin0">&nbsp;</label></div>
                <div class="col-lg-12 text-center">
                    <button type="submit" id="btn-processing" class="btn btn-block waves-effect waves-light btn-rounded btn-primary shadow-md">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i> @lang('custom_admin.btn_reset')
                    </button>
                </div>
                <div class="col-lg-12 text-center mt-5">
                    @lang('custom_admin.label_already_have_an_account') <a href="{{ route($routePrefix.'.login') }}" class="text-danger">@lang('custom_admin.message_admin_click_here')</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection