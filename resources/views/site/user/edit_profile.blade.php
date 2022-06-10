@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    <div class="innerContentArea">
        <div class="container">
            <div class="sec-title">
                <h2>Edit Profile</h2>            
            </div>
            <div class="editProfileForm">
                <div class="contact-form">
                    {{ Form::open([
                                'method'=> 'POST',
                                'class' => '',
                                'route' => ['site.users.edit-profile'],
                                'name'  => 'editProfileForm',
                                'id'    => 'editProfileForm',
                                'files' => true,
                                'autocomplete' => false,
                                'novalidate' => true]) }}
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                {{ Form::text('first_name', Auth::user()->first_name, [
                                            'id' => 'first_name',
                                            'placeholder' => 'First Name*',
                                            'class' => '',
                                            'required' => true,
                                        ]) }}
                            </div>
                            <div class="col-lg-6 form-group">
                                {{ Form::text('last_name', Auth::user()->last_name, [
                                            'id' => 'last_name',
                                            'placeholder' => 'Last Name*',
                                            'class' => '',
                                            'required' => true,
                                        ]) }}
                            </div>
                            <div class="col-lg-6 form-group">
                                {{ Form::email('email', Auth::user()->email, [
                                                'id' => 'email',
                                                'placeholder' => 'Email*',
                                                'class' => '',
                                                'required' => true,
                                            ]) }}
                            </div>
                            <div class="col-lg-6 form-group">
                                {{ Form::text('phone_no', Auth::user()->phone_no, [
                                                'id' => 'phone_no',
                                                'placeholder' => 'Phone',
                                                'class' => '',
                                            ]) }}
                            </div>
                            {{-- <div class="col-lg-6 form-group">
                                <select name="preferred_home_court" id="preferred_home_court" required>
                                    <option value="">Preferred Home Court*</option>
                                @if ($preferredHomeCourts)
                                    @foreach ($preferredHomeCourts as $itemPreferredHomeCourt)
                                    <option value="{{ $itemPreferredHomeCourt->id }}" @if ($itemPreferredHomeCourt->id == Auth::user()->userDetails->preferred_home_court_id)selected @endif>{!! $itemPreferredHomeCourt->title !!}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div> --}}

                            @php
                            $dob = null;
                            if (Auth::user()->dob != null) {
                                $dob = date('m-d-Y', strtotime(Auth::user()->dob));
                            }
                            @endphp
                            <div class="col-lg-6 form-group">
                                <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <select name="month" id="month" required>
                                            <option value="">Month*</option>
                                            @php for ($month = 1; $month <= 12; $month++) { @endphp
                                            <option value="{{ sprintf("%02d", $month) }}" @if (sprintf("%02d", $month) == date('m', strtotime(Auth::user()->dob)))selected @endif>{{ sprintf("%02d", $month) }}</option>
                                            @php } @endphp
                                        </select>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <select name="day" id="day" required>
                                            <option value="">Day*</option>
                                            @php for ($day = 1; $day <= 31; $day++) { @endphp
                                            <option value="{{ sprintf("%02d", $day) }}" @if (sprintf("%02d", $day) == date('d', strtotime(Auth::user()->dob)))selected @endif>{{ sprintf("%02d", $day) }}</option>
                                            @php } @endphp
                                        </select>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <select name="year" id="year" required>
                                            <option value="">Year*</option>
                                            @php for ($year = (date('Y') - 18); $year >= 1900; $year--) { @endphp
                                            <option value="{{ $year }}" @if ($year == date('Y', strtotime(Auth::user()->dob)))selected @endif>{{ $year }}</option>
                                            @php } @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-lg-6 form-group">
                                <div class="fileUpload">
                                    <label for="profile_pic" class="form-label">Browse Your Photo</label>
                                    {{ Form::file('profile_pic', [
                                                'id' => 'profile_pic',
                                                'class' => 'form-control form-control-lg upload-image',
                                                'placeholder' => 'Upload Image',
                                            ]) }}
                                    {{-- <input class="form-control form-control-lg" id="formFileSm" type="file" /> --}}
                                    <div class="preview_img_div_profile_pic mt-2">
                                        <img id="profile_pic_preview" class="mt-2" style="display: none;" />
                                    @if (Auth::user()->profile_pic != null)
                                        @if (file_exists(public_path('/images/uploads/account/'.Auth::user()->profile_pic)))
                                            <div class="image-preview-holder" id="image_holder_profile_pic">
                                                <a data-fancybox="gallery" href="{{ asset('images/uploads/account/'.Auth::user()->profile_pic) }}">
                                                    <img class="image-preview-border" id="profile_pic_preview mt-2" src="{{ asset('images/uploads/account/thumbs/'.Auth::user()->profile_pic) }}" width="100" height="90" />
                                                </a>														
                                                <span class="delete-preview-image delete-uploaded-preview-image" data-imageid="profile_pic_preview" data-dbfield="profile_pic" data-routeprefix="account"><i class="fa fa-trash"></i></span>
                                            </div>
                                        @endif
                                    @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 form-group">
                                <label for="score_confirm" class="form-label">Score Confirmation Email</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input checkbox" type="checkbox" id="inlineCheckbox1" name="send_score_confirmation" value="Y" @if (Auth::user()->send_score_confirmation == 'Y')checked @endif>
                                    <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                </div>
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

@push('scripts')
    @include('site.includes.image_preview_and_delete')
@endpush