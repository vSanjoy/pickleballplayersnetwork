@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    @include('site.includes.banner')

    {{-- Start :: Content section --}}
    <div class="innerContentArea">
        <div class="container text-center">
            {!! $cmsDetails->description !!}
        </div>
    </div>
    {{-- End :: Content section --}}
    
    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush