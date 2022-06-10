@extends('site.layouts.app', [])
@section('content')

    @if (Session::get('cityId'))
        @include('site.includes.city_header')
    @else
        @include('site.includes.header')
    @endif

    <div class="innerContentArea minheight">
        <div class="container">
            <div class="sec-title">
                <h2>Change Password</h2>            
            </div>
            <div class="editProfileForm">
                <div class="contact-form">
                    <form name="changePasswordForm" id="changePasswordForm">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <input type="password" placeholder="Current Password*" name="current_password" id="current_password" value="" required>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-6 form-group">
                                <input type="password" placeholder="New Password*" name="password" id="password" value="" required>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-6 form-group">
                                <input type="password" placeholder="Confirm Password*" name="confirm_password" id="confirm_password" value="" required>
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="submit" class="btnMain">Update</button>
                            </div>
                            <div class="col-lg-12 form-group required-fields-position">
                                <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @include('site.includes.footer')

@endsection