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

    <div class="innerContentArea">
        <div class="container">
            <div class="sec-title text-center">
                <h2>{!! $cmsDetails->title !!}</h2>
            </div>
            <div class="mainContent">
                <div class="contentBox">
                    {!! $cmsDetails->description !!}
                </div>
            </div>

        @if ($homeCourts != '' && $homeCourts->count())
            <div class="row">
                <div class="col-lg-12">
                    <div class="homeCourtTable">
                        {{-- <h4></h4> --}}
                        <div class="table-responsive">
                            <table class="profTable">
                                <tr>
                                    <td class="text-uppercase"><strong>Name</strong></td>
                                    <td class="text-uppercase"><strong>Address</strong></td>
                                    <td class="text-uppercase"><strong>City</strong></td>
                                </tr>
                                @foreach ($homeCourts as $homeCourt)
                                <tr>
                                    <td>{!! $homeCourt->title !!}</td>
                                    <td>{!! $homeCourt->address !!}</td>
                                    <td>{!! $homeCourt->city !!}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

            <div class="mainContent">
                <div class="contentBox">
                    {!! $cmsDetails->description2 !!}
                </div>
            </div>
        </div>
    </div>
    
    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush