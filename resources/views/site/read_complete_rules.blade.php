@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    {{-- Start :: Banner section (CMS League page) --}}
@if ($cmsDetails->banner_image != null)
    @if (file_exists(public_path('/images/uploads/cms/'.$cmsDetails->banner_image)))
    <div class="banner">
        <div class="bannerSliderInner">
            <div class="sliderItem">
                <img src="{{ asset('/images/uploads/cms/'.$cmsDetails->banner_image) }}" alt="{!! $cmsDetails->banner_image_alt !!}" title="{!! $cmsDetails->banner_image_title !!}">
                <div class="bannrCaption">
                    <div class="container text-center">
                        <h2>{!! $cmsDetails->banner_title !!}</h2>
                        <h2>{!! $cmsDetails->banner_short_title !!}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif
    {{-- End :: Banner section (CMS League page) --}}
    <div class="innerContentArea">
        <div class="container">
            {{-- Start :: CMS section (CMS League page) --}}
            @if ($cmsDetails->short_title != null || $cmsDetails->short_description != null)
            <div class="sec-title text-center">
                @if ($cmsDetails->short_title)
                <h2>{!! $cmsDetails->short_title !!}</h2>
                @endif
                @if ($cmsDetails->short_description)
                <h2>{!! $cmsDetails->short_description !!}</h2>
                @endif
            </div>
            @endif
            <div class="mainContent">
                <div class="contentBox listStructure">
                    {!! $cmsDetails->description !!}
                </div>
                @if (!Auth::user())
                <div class="text-center">
                    <a href="{{ route('site.registration') }}" class="btnMain">Join Now</a>
                </div>
                @endif
            </div>
            {{-- End :: CMS section (CMS League page) --}}
        </div>
    </div>

    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush