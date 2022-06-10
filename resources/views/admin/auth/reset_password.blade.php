@extends('admin.layouts.forgot_password', ['title' => $pageTitle])

@section('content')

    <div class="p-3">
        <div class="text-center">
            <img src="{{asset('images/admin/logo.png')}}" alt="" style="width: 250px;">
        </div>
        <h2 class="mt-3 text-center mb-3">@lang('custom_admin.label_reset_password')</h2>
        <p class="text-center">@lang('custom_admin.message_enter_new_password')</p>

        {{ Form::open([
                    'method'=> 'POST',
                    'class' => '',
                    'route' => [$routePrefix.'.reset-password', $token],
                    'name'  => 'resetPasswordForm',
                    'id'    => 'resetPasswordForm',
                    'files' => true,
                    'novalidate' => true]) }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="font-bold">@lang('custom_admin.label_new_password')<span class="red_star">*</span></label>
                        {{ Form::password('password', array(
                                                            'id' => 'password',
                                                            'class' => 'form-control',
                                                            'placeholder' => '',
                                                            'required' => 'required' )) }}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="font-bold">@lang('custom_admin.label_confirm_password')<span class="red_star">*</span></label>
                        {{ Form::password('confirm_password', array(
                                                            'id' => 'confirm_password',
                                                            'class' => 'form-control',
                                                            'placeholder' => '',
                                                            'required' => 'required' )) }}
                    </div>
                </div>
                <div class="col-lg-12 text-center margintop20">
                    <button type="submit" id="btn-processing" class="btn btn-block waves-effect waves-light btn-rounded btn-primary shadow-md">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> @lang('custom_admin.btn_submit')
                    </button>
                </div>
                <div class="col-lg-12 text-center mt-5">
                    @lang('custom_admin.label_already_have_an_account') <a href="{{ route($routePrefix.'.login') }}" class="text-danger">@lang('custom_admin.message_admin_click_here')</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection