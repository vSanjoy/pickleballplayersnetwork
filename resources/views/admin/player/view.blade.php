@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					<div class="form-body mt-4-5">
						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
										<th scope="row">First Name</th>
										<td>:</td>
										<td>{!! $details->first_name !!}</td>
									</tr>
									<tr>
										<th scope="row">Last Name</th>
										<td>:</td>
										<td>{!! $details->last_name !!}</td>
									</tr>
									<tr>
										<th scope="row">Email</th>
										<td>:</td>
										<td><a href="mailto:{!!$details->email !!}">{!!$details->email !!}</a></td>
									</tr>
									<tr>
										<th scope="row">Phone</th>
										<td>:</td>
										<td>
										@if ($details->phone_no)
											{!! $details->phone_no !!}
										@else
											NA
										@endif
										</td>
									</tr>
									<tr>
										<th scope="row">Gender</th>
										<td>:</td>
										<td>@if ($details->gender == 'M')Male @elseif ($details->gender == 'F')Female @else Prefer not to answer @endif</td>
									</tr>
									<tr>
										<th scope="row">Date Of Birth</th>
										<td>:</td>
										<td>@if ($details->dob != null){!! memberSince($details->dob, 'F jS, Y') !!} @else NA @endif</td>
									</tr>
									<tr>
										<th scope="row">Player Rating</th>
										<td>:</td>
										<td>@if ($details->player_rating != null){!! formatToTwoDecimalPlaces($details->player_rating) !!} @else NA @endif</td>
									</tr>
									<tr>
										<th scope="row">City</th>
										<td>:</td>
										<td>{!! $details->userDetails->city !!}</td>
									</tr>
									<tr>
										<th scope="row">Preferred Home Court</th>
										<td>:</td>
										<td>
										@if ($details->userDetails->pickleballCourtDetails)
											{!! $details->userDetails->pickleballCourtDetails->title.' ('.$details->userDetails->pickleballCourtDetails->city.', '.$details->userDetails->pickleballCourtDetails->stateDetails->code.')' !!}
										@else
											NA
										@endif
										</td>
									</tr>
									<tr>
										<th scope="row">Address Line 1</th>
										<td>:</td>
										<td>{!! $details->userDetails->address_line_1 !!}</td>
									</tr>
									<tr>
										<th scope="row">Address Line 2</th>
										<td>:</td>
										<td>
										@if ($details->userDetails->address_line_2)
											{!! $details->userDetails->address_line_2 !!}
										@else
											NA
										@endif
										</td>
									</tr>
									<tr>
										<th scope="row">City</th>
										<td>:</td>
										<td>{!! $details->userDetails->city !!}</td>
									</tr>
									<tr>
										<th scope="row">State</th>
										<td>:</td>
										<td>{!! $details->userDetails->stateDetails->title !!}</td>
									</tr>
									<tr>
										<th scope="row">Zip</th>
										<td>:</td>
										<td>{!! $details->userDetails->zip !!}</td>
									</tr>
									@php $howDidYouHearAboutUs = config('global.HOW_DID_YOU_HEAR_ABOUT_US'); @endphp
									<tr>
										<th scope="row">How Did You Hear About Us?</th>
										<td>:</td>
										<td>
										@if ($details->userDetails->how_did_you_find_us == 'SE')
											{!! $howDidYouHearAboutUs['SE'] !!}
										@elseif ($details->userDetails->how_did_you_find_us == 'SM')
											{!! $howDidYouHearAboutUs['SM'] !!}
										@elseif ($details->userDetails->how_did_you_find_us == 'RBF')
											{!! $howDidYouHearAboutUs['RBF'] !!}
										@elseif ($details->userDetails->how_did_you_find_us == 'BOP')
											{!! $howDidYouHearAboutUs['BOP'] !!}
										@elseif ($details->userDetails->how_did_you_find_us == 'AD')
											{!! $howDidYouHearAboutUs['AD'] !!}
										@elseif ($details->userDetails->how_did_you_find_us == 'O')
											{!! $howDidYouHearAboutUs['O'] !!}
										@else
											{!! 'NA' !!}
										@endif
										</td>
									</tr>
									<tr>
										<th scope="row">Playing Time Availability</th>
										<td>:</td>
										<td>
										@php
										$i = 1;
										if ($details->userAvailabilityDetails) {
											foreach ($details->userAvailabilityDetails as $availability) {
												echo $availability->availabilityDetails->title;
												if ($i < count($details->userAvailabilityDetails)) {
													echo ', ';
												}
												$i++;
											}
										} else {
											echo 'NA';
										}
										@endphp
										</td>
									</tr>
									<tr>
										<th scope="row">Member Since</th>
										<td>:</td>
										<td>@if ($details->created_at != null){!! memberSince($details->created_at, 'F Y') !!} @else NA @endif</td>
									</tr>
									<tr>
										<th scope="row">Photo</th>
										<td>:</td>
										<td>
										@php
										$photo = asset('images/site/'.config('global.PROFILE_NO_IMAGE'));
										if ($details->profile_pic != null) {
											if (file_exists(public_path('/images/uploads/account/'.$details->profile_pic))) {
												$photo = asset('images/uploads/account/'.$details->profile_pic);
											}
										}
										@endphp
											<div class="image-preview-holder" id="image_holder_profile_pic">
												<a data-fancybox="gallery" href="{{ $photo }}">
													<img class="image-preview-border" id="profile_pic_preview mt-2" src="{{ $photo }}" width="100" height="" />
												</a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="form-actions mt-4">
						<div class="float-left">
							<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.'.$listUrl) }}">
								<i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_back')
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
@endpush