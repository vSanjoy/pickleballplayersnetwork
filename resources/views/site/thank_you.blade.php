@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.thank_you_header')

    <div class="innerContentArea">
        <div class="container text-center make-text-left">
            <div class="mainContent">
                <div class="contentBox">
                    <h2 class="mb-4">Congratulations you have created a Pickleball Players Network Account</h2>
                    {{-- <h4 class="mb-3">You have created a Pickleball Players Network Account</h4> --}}
                
                    <div class="text-center mt-5">
                        <a href="{{ route('site.find-a-league') }}" class="btnMain">Find a League</a>
                        <span class="ms-3">or</span>
                        <a href="{{ route('site.login', $userId) }}" class="btnMain ms-3">User Profile</a>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
    
    @include('site.includes.footer')

@endsection

@push('scripts')
   
@endpush