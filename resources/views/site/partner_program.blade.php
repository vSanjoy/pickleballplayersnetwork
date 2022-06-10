@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    {{-- Start :: Banner section (CMS Our program page) --}}
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
    {{-- End :: Banner section (CMS Our program page) --}}
    <div class="innerContentArea">
        <div class="container">
            {{-- Start :: Video section (CMS Our program page) --}}
            @if ($video)
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="topVideo">
                        {!! $video->embedded_code !!}
                    </div>
                </div>
            </div>
            @endif
            {{-- End :: Video section (CMS Our program page) --}}
            <div class="sec-title text-center mb-5">
                <h2 style="color: red;">COMING SOON</h2>                
            </div>
            {{-- Start :: CMS section (CMS Our program page) --}}
            <div class="mainContent">
                <div class="contentBox">
                    <div class="sec-title">
                        {!! $cmsDetails->description !!}
                    </div>
                </div>
            </div>
            {{-- End :: CMS section (CMS Our program page) --}}
        </div>
    </div>

    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush