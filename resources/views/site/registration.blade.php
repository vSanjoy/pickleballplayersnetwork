@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    <div class="innerContentArea">
        <div class="container">
            <div class="sec-title">
                <h2 class="text-center">{!! trans('custom.label_registration_page') !!}</h2>
                <h2 class="text-center">{!! trans('custom.label_registration_page_2') !!}</h2>
            </div>
            <div id="horizontalTab" class="">
                <ul>
                    <li><a href="#tab-1">Account Registration</a></li>
                </ul>
                
                {{-- Start :: League --}}
                <div id="tab-1">
                    {!! $cmsDetails->description !!}
                    
                    <div class="contact-form">
                        <form name="userRegistrationForm" id="userRegistrationForm" autocomplete="off">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">First Name<span class="text-red">*</span></label>
                                        {{ Form::text('first_name', null, [
                                                        'id' => 'first_name',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Last Name<span class="text-red">*</span></label>
                                        {{ Form::text('last_name', null, [
                                                        'id' => 'last_name',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Email<span class="text-red">*</span></label>
                                        {{ Form::email('email', null, [
                                                        'id' => 'email',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Phone<span class="text-red">*</span></label>
                                        {{ Form::text('phone_no', null, [
                                                        'id' => 'phone_no',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group show-password">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Password<span class="text-red">*</span></label>
                                        <input type="password" name="password" id="password" class="togglePassword placeholder-input" value="" placeholder="">
                                        <span toggle=".togglePassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group show-confirm-password">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Confirm Password<span class="text-red">*</span></label>
                                        <input type="password" name="confirm_password" id="confirm_password" class="toggleConfirmPassword placeholder-input" value="" placeholder="">
                                        <span toggle=".toggleConfirmPassword" class="fa fa-fw fa-eye field-icon toggle-confirm-password"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Gender<span class="text-red">*</span></label>
                                        <select name="gender" id="gender" class="placeholder-input" required>
                                            <option value=""></option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                            <option value="U">Prefer not to answer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="row">
                                        <div class="col-lg-4 form-group">
                                            <div class="holder-inner">
                                                <label class="placeholder-label">Month<span class="text-red">*</span></label>
                                                <select name="month" id="month" class="placeholder-input" required>
                                                    <option value=""></option>
                                                    @php for ($month = 1; $month <= 12; $month++) { @endphp
                                                    <option value="{{ sprintf("%02d", $month) }}">{{ sprintf("%02d", $month) }}</option>
                                                    @php } @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <div class="holder-inner">
                                                <label class="placeholder-label">Day<span class="text-red">*</span></label>
                                                <select name="day" id="day" class="placeholder-input" required>
                                                    <option value=""></option>
                                                    @php for ($day = 1; $day <= 31; $day++) { @endphp
                                                    <option value="{{ sprintf("%02d", $day) }}">{{ sprintf("%02d", $day) }}</option>
                                                    @php } @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 form-group">
                                            <div class="holder-inner">
                                                <label class="placeholder-label">Year<span class="text-red">*</span></label>
                                                <select name="year" id="year" class="placeholder-input" required>
                                                    <option value=""></option>
                                                    @php for ($year = (date('Y') - 18); $year >= 1900; $year--) { @endphp
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                    @php } @endphp
                                                </select>
                                            </div>
                                        </div>
                                        <label style="padding: 0 0 0 8px; margin-top: -10px;">Date of Birth</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Player Rating<span class="text-red">*</span></label>
                                        <select name="player_rating" id="player_rating" class="placeholder-input" required>
                                            <option value=""></option>
                                            @php for ($playerRating = 2.0; $playerRating <= 5.5; $playerRating += 0.25) { @endphp
                                                <option value="{{ formatToTwoDecimalPlaces($playerRating) }}">
                                                    {{ formatToTwoDecimalPlaces($playerRating)}} @if ($playerRating == 5.50)+ @endif
                                                </option>
                                            @php } @endphp
                                        </select>
                                    </div>
                                    <label><a href="{{ asset('images/uploads/USAPA-Skill-Rating-Definitions-2020.pdf') }}" target="_blank">Help Me Choose My Rating</a></label>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div id="home-court-div">
                                        <div class="holder-inner">
                                            <label class="placeholder-label-selectpicker" id="pref-home-court">Preferred Home Court<span class="text-red">*</span></label>
                                            <select name="home_court" id="home_court" class="selectpicker form-control bg_transparent" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" data-placeholder="" required>
                                                <option value=""></option>
                                            @foreach ($homeCourts as $homeCourt)
                                                <option value="{{ $homeCourt->id }}">{!! $homeCourt->title.' ('.$homeCourt->city.', '.$homeCourt->stateDetails->code.')' !!}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label><a href="{{ route('site.local-court') }}" target="_blank">@lang('custom.label_find_a_local_court')</a></label>
                                </div>
                                
                                {{-- Address --}}
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Address Line 1<span class="text-red">*</span></label>
                                        {{ Form::text('address_line_1', null, [
                                                        'id' => 'address_line_1',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Address Line 2</label>
                                        {{ Form::text('address_line_2', null, [
                                                        'id' => 'address_line_2',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                    ]) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">City<span class="text-red">*</span></label>
                                        {{ Form::text('city', null, [
                                                        'id' => 'city',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">State<span class="text-red">*</span></label>
                                        <select name="state" id="state" class="placeholder-input" required>
                                            <option value=""></option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{!! $state->title !!}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Zip<span class="text-red">*</span></label>
                                        {{ Form::text('zip', null, [
                                                        'id' => 'zip',
                                                        'placeholder' => '',
                                                        'class' => 'placeholder-input',
                                                        'required' => true,
                                                    ]) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">How Did You Hear About Us?</label>
                                        <select name="how_did_you_find_us" id="how_did_you_find_us" class="placeholder-input">
                                            <option value=""></option>
                                            @foreach (config('global.HOW_DID_YOU_HEAR_ABOUT_US') as $key => $item)
                                            <option value="{!! $key !!}">{!! $item !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                @if ($availabilities && $availabilities->count())
                                <div class="col-lg-12 form-group">
                                    <label class=""><strong>Playing Time Availability<span class="text-red">*</span></strong> <i class="fa fa-question-circle cursor-pointer" aria-hidden="true" data-toggle="tooltip" title="To best facilitate league play, please specify your playing time availability. You will have the opportunity to change this as needed"></i> <i>(Select all that apply)</i></label>
                                    <div class="row" id="availability">
                                        @foreach ($availabilities as $availability)
                                        <div>
                                            <div class="form-check display-inline-block">
                                                <input class="form-check-input available error-checkbox" type="checkbox" value="{!! $availability->id !!}" id="availability_{{ $availability->id }}" name="availability[]" required>
                                                <label class="form-check-label text-uppercase" for="availability_{{ $availability->id }}">{!! $availability->title !!}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if ($cmsDetails->description2)
                                <div class="col-lg-12 form-group">
                                    <label class=""><strong>Waiver</strong></label>
                                    <div class="waiver-content">
                                        {!! $cmsDetails->description2 !!}
                                    </div>
                                </div>
                                @endif

                                {{-- <div class="col-lg-12 form-group">
                                    <div class="form-check" id="accountWaiver">
                                        <input class="form-check-input error-checkbox" type="checkbox" value="Y" id="is_waiver_signed" name="is_waiver_signed">
                                        <label class="form-check-label" for="is_waiver_signed">Accept Waiver<span class="text-red">*</span></label>
                                    </div>
                                </div> --}}

                                <div class="col-lg-12 form-group">
                                    <div class="form-check" id="leagueAgree">
                                        <input class="form-check-input error-checkbox" type="checkbox" value="1" id="agree" name="agree">
                                        <label class="form-check-label" for="agree">By clicking this checkbox, I acknowledge that I have read, understand and agree to the above waiver and <a href="{{ route('site.terms-of-use') }}" target="_blank">Terms of Use</a><span class="text-red">*</span></label>
                                    </div>
                                </div>

                                <div class="col-lg-12 form-group">
                                    <button type="submit" class="btnMain">Register</button>
                                </div>

                                <div class="col-lg-12 form-group required-fields-position">
                                    <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End :: League --}}
            </div>
        </div>
    </div>
    
    @include('site.includes.footer')

@endsection

@push('scripts')
    
@endpush