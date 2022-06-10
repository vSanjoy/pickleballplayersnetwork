@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    {{-- Start :: Banner section (CMS Contact us page) --}}
@if ($cmsDetails->banner_image != null)
    @if (file_exists(public_path('/images/uploads/cms/'.$cmsDetails->banner_image)))
    <div class="banner">
        <div class="bannerSliderInner">
            <div class="sliderItem">
                <img src="{{ asset('/images/uploads/cms/'.$cmsDetails->banner_image) }}" alt="{!! $cmsDetails->banner_image_alt !!}" title="{!! $cmsDetails->banner_image_title !!}">
                <div class="bannrCaption">
                    <div class="container text-center">
                        <h2>{!! $cmsDetails->banner_title !!}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif
    {{-- End :: Banner section (CMS Contact us page) --}}
    <div class="innerContentArea">
        <div class="container">
            <div class="mainContent">
                {{-- Start :: CMS section (CMS Contact us page) --}}
                <div class="sec-title text-center">
                    <h2>{!! $cmsDetails->short_title !!}</h2>
                </div>
                {{-- End :: CMS section (CMS Contact us page) --}}
                <div class="formHolder">
                    <div class="contact-form">
                        <form method="post" action="" id="contactForm">
                            <div class="row clearfix">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Name<span class="text-red">*</span></label>
                                        {{ Form::text('name', null, [
                                                    'id' => 'name',
                                                    'placeholder' => '',
                                                    'class' => 'placeholder-input',
                                                    'required' => true,
                                                ]) }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Email<span class="text-red">*</span></label>
                                        {{ Form::text('email', null, [
                                                    'id' => 'email',
                                                    'placeholder' => '',
                                                    'class' => 'placeholder-input',
                                                    'required' => true,
                                                ]) }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <div class="holder-inner">
                                        <label class="placeholder-label">Message<span class="text-red">*</span></label>
                                        {{ Form::textarea('message', null, [
                                                    'id' => 'message',
                                                    'placeholder' => '',
                                                    'class' => 'placeholder-input',
                                                    'required' => true,
                                                ]) }}
                                    </div>
                                </div>
                                <div class="form-group text-center col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btnMain">Submit</button>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 required-fields-position">
                                    <span class="text-red">*</span> {{config('global.REQUIRED_FIELD')}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush