@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

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
    <div class="innerContentArea">
        <div class="container">
            <div class="mainContent">
                <div class="contentBox">
                    <h2>{!! $cmsDetails->description !!}</h2>
                </div>
            </div>
        </div>
    </div>

    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush