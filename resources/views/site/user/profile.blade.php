@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    @php
    $profileImage = asset('images/site/'.config('global.PROFILE_NO_IMAGE'));
    if ($details->profile_pic != null) {
        if (file_exists(public_path('/images/uploads/account/'.$details->profile_pic))) {
            $profileImage = asset('/images/uploads/account/'.$details->profile_pic);
        }
    }
    @endphp

    <div class="innerContentArea">
        <div class="container">
            @if ($isAccessAvailable)
            <div class="text-center">
                <a href="#" class="btnMain mb-5 text-center">JOIN A LEAGUE</a>
            </div>
            @endif
            <div class="sec-title">
                <h2>{!! $details->full_name !!}'s profile <a href="{{ route('site.users.edit-profile') }}" class="small-edit-profile">Edit Profile</a></h2>            
            </div>
            <div class="pageContentArea">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profilePic">
                            <img src="{!! $profileImage !!}" alt="{!! $details->full_name !!}">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profileTop">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="prifileTable responsiveProfileTable">
                                        <div class="table-responsive">
                                            <table class="profTable">
                                                <tr>
                                                    <td>Name:</td>
                                                    <td>{!! $details->full_name !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td><span class="inlineSizeBreak">{!! $details->email !!}</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone:</td>
                                                    <td>
                                                    @if ($details->phone_no)
                                                        {!! $details->phone_no !!}
                                                    @else
                                                        NA
                                                    @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td>@if ($details->gender == 'M')Male @elseif ($details->gender == 'F')Female @endif</td>
                                                </tr> 
                                                <tr>
                                                    <td>Date of Birth:</td>
                                                    <td>@if ($details->dob != null){!! date('m/d/Y', strtotime($details->dob)) !!} @else NA @endif</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="prifileTable responsiveProfileTable">
                                        <div class="table-responsive">
                                            <table class="profTable">
                                                <tr>
                                                    <td>Player Rating:</td>
                                                    <td>{!! formatToTwoDecimalPlaces($details->player_rating) !!} @if ($details->player_rating == 5.50)+ @endif</td>
                                                </tr>
                                                <tr>
                                                    <td>Home Court:</td>
                                                    <td>
                                                    @if ($details->userDetails->pickleballCourtDetails)
                                                        {!! $details->userDetails->pickleballCourtDetails->title.' ('.$details->userDetails->pickleballCourtDetails->city.', '.$details->userDetails->pickleballCourtDetails->stateDetails->code.')' !!}
                                                    @else
                                                        NA
                                                    @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Member Since:</td>
                                                    <td>{!! memberSince($details->created_at, 'F Y') !!}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profileBottom">
                            <div class="row">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-uppercase">My Leagues</h4>
                    <span>No records found.</span>
                    <ul class="league-profile-content">
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
    
    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush