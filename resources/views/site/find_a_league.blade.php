@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    <div class="innerContentArea">
		<div class="container">
			<div class="sec-title text-center">
				<h2>FIND A PICKLEBALL LEAGUE </h2>
			</div>
            <div class="mainContent">
                <div class="leaguesearchcontent">
                    <div class="totalleguarea">
                        <div class="leagueleft">
                            <div class="league-togglebutton"> <span>Filter</span> <i class="fa fa-caret-right" aria-hidden="true"></i></div>
                            <div class="leage-leftsec">
                                <h3>LOCATION</h3>
                                <div class="locationarea">
                                    <div class="locationtop">
                                        <div class="lft">
                                            <label class="cont">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="rgt">
                                            <input type="text" name="" placeholder="Zip Code">
                                        </div>
                                    </div>
                                    <div class="locationbottom">
                                        <div class="lft">
                                            within
                                        </div>
                                        <div class="rgt">
                                            <select>
                                                <option value="10 mile">10 mile</option>
                                                <option value="20 miles">20 miles</option>
                                                <option value="40 miles">40 miles</option>
                                                <option value="50 miles">50 miles</option>
                                                <option value="100 miles">100 miles</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>PLAY TYPE</h3>
                                    <div class="excls">
                                        <label class="cont">Doubles
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">Singles
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>GENDER</h3>
                                    <div class="excls">
                                        <label class="cont">Male
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">Female
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">Mixed
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>AGE</h3>
                                    <div class="excls">
                                        <label class="cont">18 +
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">50 +
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>RATING</h3>
                                    <div class="excls">
                                        <label class="cont">2.0 – 3.0
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">3.0 – 4.0
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">4.0 – 5.0
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">5.0 +
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="left-side-bx">
                                    <h3>STATUS</h3>
                                    <div class="excls">
                                        <label class="cont">Open for registration
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">In – Progress
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="cont">Complete
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="league-right">
                            <div class="rightleague">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="sticky-top" scope="col">League Name</th>
                                                <th class="sticky-top" scope="col">Location</th>
                                                <th class="sticky-top" scope="col">Play Type</th>
                                                <th class="sticky-top" scope="col">Gender</th>
                                                <th class="sticky-top" scope="col">Ratings</th>
                                                <th class="sticky-top" scope="col">Dates</th>
                                                <th class="sticky-top" scope="col">Teams Registered</th>
                                                <th class="sticky-top" scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">Burbank Pickleballers</a></td>
                                                <td>Burbank</td>
                                                <td>Doubles </td>
                                                <td>Mixed</td>
                                                <td>3.0 - 4.0 </td>
                                                <td>05/26 – 07/04 </td>
                                                <td>4</td>
                                                <td>Open for Registration</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">Westside Pickle Pros</a></td>
                                                <td>Westside</td>
                                                <td>Doubles </td>
                                                <td>Mixed</td>
                                                <td>3.0 - 4.0 </td>
                                                <td>07/04 – 09/05</td>
                                                <td>7</td>
                                                <td>Open for Registration</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">Palm Springs Old Farts</a></td>
                                                <td>Palm Springs</td>
                                                <td>Singles</td>
                                                <td>Female</td>
                                                <td>2.0 – 3.5</td>
                                                <td>05/04 – 08/12</td>
                                                <td>12</td>
                                                <td>In - Progress</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">San Jose Tech Squar</a></td>
                                                <td>San Jose</td>
                                                <td>Doubles</td>
                                                <td>Mixed</td>
                                                <td>4.0 - 5.5</td>
                                                <td>05/26 – 07/04</td>
                                                <td>5</td>
                                                <td>Open for Registration</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">Heat of the Valley</a></td>
                                                <td>San Fernando Valley</td>
                                                <td>Doubles</td>
                                                <td>Mixed</td>
                                                <td>4.0 - 4.5</td>
                                                <td>02/04 – 05/12</td>
                                                <td>12</td>
                                                <td>Complete</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">Burbank Pickleballers</a></td>
                                                <td>Burbank</td>
                                                <td>Doubles </td>
                                                <td>Mixed</td>
                                                <td>3.0 - 4.0 </td>
                                                <td>05/26 – 07/04 </td>
                                                <td>4</td>
                                                <td>Open for Registration</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">Westside Pickle Pros</a></td>
                                                <td>Westside</td>
                                                <td>Doubles </td>
                                                <td>Mixed</td>
                                                <td>3.0 - 4.0 </td>
                                                <td>07/04 – 09/05</td>
                                                <td>7</td>
                                                <td>Open for Registration</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">Palm Springs Old Farts</a></td>
                                                <td>Palm Springs</td>
                                                <td>Singles</td>
                                                <td>Female</td>
                                                <td>2.0 – 3.5</td>
                                                <td>05/04 – 08/12</td>
                                                <td>12</td>
                                                <td>In - Progress</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">San Jose Tech Squar</a></td>
                                                <td>San Jose</td>
                                                <td>Doubles</td>
                                                <td>Mixed</td>
                                                <td>4.0 - 5.5</td>
                                                <td>05/26 – 07/04</td>
                                                <td>5</td>
                                                <td>Open for Registration</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('site.league-registration', customEncryptionDecryption(1)) }}">Heat of the Valley</a></td>
                                                <td>San Fernando Valley</td>
                                                <td>Doubles</td>
                                                <td>Mixed</td>
                                                <td>4.0 - 4.5</td>
                                                <td>02/04 – 05/12</td>
                                                <td>12</td>
                                                <td>Complete</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>

    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush