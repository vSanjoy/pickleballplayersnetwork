@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    {{-- Start :: Banner --}}
    @if ($banners!= '' && $banners->count())
    <div class="banner">
        <div class="bannerSlider">
        @foreach ($banners as $keyBanner => $itemBanner)
            <div class="sliderItem">
            @if ($itemBanner->image != null)
                @if (file_exists(public_path('/images/uploads/'.$bannerStorage.'/'.$itemBanner->image)))
                <picture>
                    <source media="(min-width:768px)" srcset="{{ asset('/images/uploads/'.$bannerStorage.'/'.$itemBanner->image) }}" alt="{!! $itemBanner->image_alt !!}" title="{!! $itemBanner->image_title !!}">
                    <img src="{{ asset('/images/uploads/'.$bannerStorage.'/'.$itemBanner->image_mobile) }}" alt="{!! $itemBanner->image_alt_mobile !!}" title="{!! $itemBanner->image_title_mobile !!}">
                </picture>
                @endif
            @endif
            @if ($itemBanner->short_title != null || $itemBanner->short_description != null)
                <div class="bannrCaption">
                    <div class="container text-center">
                        @if ($itemBanner->short_title != null)
                        <h2>{!! $itemBanner->short_title !!}</h2>
                        @endif
                        @if ($itemBanner->short_description != null)
                        <h3>{!! $itemBanner->short_description !!}</h3>
                        @endif
                        <a href="{{ route('site.registration') }}" class="btnBannerMain">JOIN NOW</a>
                    </div>
                </div>
            @endif
            </div>
        @endforeach
        </div>
    </div>
    @endif
    {{-- End :: Banner --}}

    {{-- Start :: About us section (CMS Home page) --}}
    @if ($cmsPages)
    <div class="about-section">
        <div class="container">
            <div class="row align-items-center">
            @if ($cmsPages->featured_image != null)
                @if (file_exists(public_path('/images/uploads/cms/'.$cmsPages->featured_image)))
                <div class="col-lg-6">
                    <div class="aboutImage">
                        <img src="{{ asset('/images/uploads/cms/'.$cmsPages->featured_image) }}" alt="{!! $cmsPages->featured_image_alt !!}" title="{!! $cmsPages->featured_image_title !!}">
                    </div>
                </div>
                @endif
            @endif
                <div class="col-lg-6">
                    <h2>{!! $cmsPages->short_title !!}</h2>
                    {!! $cmsPages->description !!}
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- End :: About us section (CMS Home page) --}}

    {{-- Start :: Our program section (CMS Our program page) --}}
    <div class="our-program-section">
        <div class="container">
            <div class="sec-title text-center">
                <h2>{!! $cmsPages->short_description !!}</h2>
            </div>
            <div class="programCardHolder">
                <div class="row">
                    @if ($leaguePage)
                        @php
                        $leagueImage = asset('images/'.config('global.NO_IMAGE'));
                        if ($leaguePage->featured_image != null) {
                            if (file_exists(public_path('/images/uploads/cms/'.$leaguePage->featured_image))) {
                                $leagueImage = asset('/images/uploads/cms/'.$leaguePage->featured_image);
                            }
                        }   
                        @endphp
                    <div class="col-lg-6">
                        <div class="inner-program-box-black equal-image-height">
                            <div class="image">
                                <a href="{{ route('site.leagues') }}">
                                    <img src="{{ $leagueImage }}" alt="{!! $leaguePage->featured_image_alt !!}" title="{!! $leaguePage->featured_image_title !!}">
                                </a>
                            </div>
                            <div class="program-content text-center">
                                <h3><a href="{{ route('site.leagues') }}">{!! $leaguePage->title !!}</a></h3>
                                <div class="text">
                                    <p>{!! $leaguePage->short_description !!}</p>
                                </div>
                                <a href="{{ route('site.leagues') }}" class="btnMain">read more</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($partnerPage)
                        @php
                        $partnerImage = asset('images/'.config('global.NO_IMAGE'));
                        if ($partnerPage->featured_image != null) {
                            if (file_exists(public_path('/images/uploads/cms/'.$partnerPage->featured_image))) {
                                $partnerImage = asset('/images/uploads/cms/'.$partnerPage->featured_image);
                            }
                        }   
                        @endphp
                    <div class="col-lg-6">
                        <div class="inner-program-box equal-image-height">
                            <div class="image">
                                <a href="{{ route('site.partner-program') }}">
                                    <img src="{{ $partnerImage }}" alt="{!! $partnerPage->featured_image_alt !!}" title="{!! $partnerPage->featured_image_title !!}">
                                </a>
                            </div>
                            <div class="program-content text-center">
                                <h3><a href="{{ route('site.partner-program') }}">{!! $partnerPage->title !!}</a></h3>
                                <div class="text">
                                    <p>{!! $partnerPage->short_description !!}</p>
                                </div>
                                <a href="{{ route('site.partner-program') }}" class="btnMain">read more</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>  
        </div>
    </div>
    {{-- End :: Our program section (CMS Our program page) --}}

    @include('site.includes.footer')
    
@endsection
