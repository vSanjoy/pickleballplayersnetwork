@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					{{ Form::open([
						'method'=> 'POST',
						'class' => '',
						'route' => [$routePrefix.'.'.$editUrl.'-submit', $id],
						'name'  => 'updatePlayerForm',
						'id'    => 'updatePlayerForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_first_name')<span class="red_star">*</span></label>
										{{ Form::text('first_name', $details->first_name ?? null, [
																		'id' => 'first_name',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => true,
																	]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_last_name')<span class="red_star">*</span></label>
										{{ Form::text('last_name', $details->last_name ?? null, [
																		'id' => 'last_name',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => true,
																	]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_email')<span class="red_star">*</span></label>
										{{ Form::email('email', $details->email ?? null, [
																				'id' => 'email',
																				'placeholder' => '',
																				'class' => 'form-control',
																				'required' => true,
																			]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone')<span class="red_star">*</span></label>
										{{ Form::text('phone_no', $details->phone_no ?? null, [
																				'id' => 'phone',
																				'placeholder' => '',
																				'class' => 'form-control',
																				'required' => true,
																			]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_gender')<span class="red_star">*</span></label>
										<select name="gender" id="gender" class="form-control" required>
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="M" @if ($details->gender == 'M')selected @endif>Male</option>
											<option value="F" @if ($details->gender == 'F')selected @endif>Female</option>
											<option value="U" @if ($details->gender == 'U')selected @endif>Prefer not to answer</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4">
											<label class="text-dark font-bold">@lang('custom_admin.label_month')<span class="red_star">*</span></label>
											<select name="month" id="month" class="form-control" required>
												<option value="">--@lang('custom_admin.label_select')--</option>
												@php for ($month = 1; $month <= 12; $month++) { @endphp
													<option value="{{ sprintf("%02d", $month) }}" @if (sprintf("%02d", $month) == date('m', strtotime($details->dob)))selected @endif>{{ sprintf("%02d", $month) }}</option>
												@php } @endphp
											</select>
										</div>
										<div class="col-md-4">
											<label class="text-dark font-bold">@lang('custom_admin.label_day')<span class="red_star">*</span></label>
											<select name="day" id="day" class="form-control" required>
												<option value="">--@lang('custom_admin.label_select')--</option>
												@php for ($day = 1; $day <= 31; $day++) { @endphp
													<option value="{{ sprintf("%02d", $day) }}" @if (sprintf("%02d", $day) == date('d', strtotime($details->dob)))selected @endif>{{ sprintf("%02d", $day) }}</option>
												@php } @endphp
											</select>
										</div>
										<div class="col-md-4">
											<label class="text-dark font-bold">@lang('custom_admin.label_year')<span class="red_star">*</span></label>
											<select name="year" id="year" class="form-control" required>
												<option value="">--@lang('custom_admin.label_select')--</option>
												@php for ($year = (date('Y') - 18); $year >= 1900; $year--) { @endphp
													<option value="{{ $year }}" @if ($year == date('Y', strtotime($details->dob)))selected @endif>{{ $year }}</option>
												@php } @endphp
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_player_rating')<span class="red_star">*</span></label>
										<select name="player_rating" id="player_rating" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
											@php for ($playerRating = 2.0; $playerRating <= 5.5; $playerRating += 0.25) { @endphp
												<option value="{{ formatToTwoDecimalPlaces($playerRating) }}" @if (formatToTwoDecimalPlaces($playerRating) == $details->player_rating)selected @endif>
													{{ formatToTwoDecimalPlaces($playerRating)}} @if ($playerRating == 5.50)+ @endif
												</option>
											@php } @endphp
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" id="home-court-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_home_court')<span class="red_star">*</span></label>
										<select name="home_court" id="home_court" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($pickleballCourts as $homeCourt)
											<option value="{{ $homeCourt->id }}" @if ($homeCourt->id == $details->userDetails->home_court)selected @endif>{!! $homeCourt->title.' ('.$homeCourt->city.', '.$homeCourt->stateDetails->code.')' !!}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_address_line_1')<span class="red_star">*</span></label>
										{{ Form::textarea('address_line_1', $details->userDetails->address_line_1 ?? null, [
																				'id' => 'address_line_1',
																				'placeholder' => '',
																				'class' => 'form-control',
																				'required' => true,
																				'rows' => 2
																			]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_address_line_2')</label>
										{{ Form::textarea('address_line_2', $details->userDetails->address_line_2 ?? null, [
																				'id' => 'address_line_2',
																				'placeholder' => '',
																				'class' => 'form-control',
																				'rows' => 2
																			]) }}
									</div>
								</div>
							</div>

							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_city')<span class="red_star">*</span></label>
										{{ Form::text('city', $details->userDetails->city ?? null, [
																				'id' => 'city',
																				'placeholder' => '',
																				'class' => 'form-control',
																				'required' => true,
																			]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_state')<span class="red_star">*</span></label>
										<select name="state" id="state" class="form-control" required>
											<option value="">--@lang('custom_admin.label_select')--</option>
											@foreach ($states as $state)
												<option value="{{ $state->id }}" @if ($details->userDetails->state == $state->id)selected @endif>{!! $state->title !!}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_zip')<span class="red_star">*</span></label>
										{{ Form::text('zip', $details->userDetails->zip ?? null, [
																				'id' => 'zip',
																				'placeholder' => '',
																				'class' => 'form-control',
																				'required' => true,
																			]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_how_did_you_find_us')?</label>
										<select name="how_did_you_find_us" id="how_did_you_find_us" class="form-control">
                                            <option value="">--@lang('custom_admin.label_select')--</option>
                                            @foreach (config('global.HOW_DID_YOU_HEAR_ABOUT_US') as $key => $item)
                                            <option value="{!! $key !!}" @if ($details->userDetails->how_did_you_find_us == $key)selected @endif>{!! $item !!}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Score Confirmation Email</label>
										<div class="">
											<input type="checkbox" class="check" id="scoreConfirmation" value="Y" name="send_score_confirmation" @if ($details->send_score_confirmation == 'Y')checked @endif>
											<label class="" for="scoreConfirmation"></label>
										</div>
									</div>
								</div>
							</div>

							<hr>
							<div class="row mt-1">
								@if ($availabilities && $availabilities->count())
                                <div class="col-lg-12 form-group">
									<label class="text-dark font-bold">@lang('custom_admin.label_playing_time_availability')<span class="red_star">*</span></strong></label>
                                    
                                    <div id="availability">
                                        @foreach ($availabilities as $availability)
										<div class="">
											<input type="checkbox" class="check" value="{!! $availability->id !!}" id="availability_{{ $availability->id }}" name="availability[]" @if (in_array($availability->id, $userAvailabilities))checked @endif>
											<label class="" for="availability_{{ $availability->id }}">{!! $availability->title !!}</label>
										</div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="text-dark font-bold">@lang('custom_admin.label_photo')</label>
												{{ Form::file('profile_pic', [
																		'id' => 'profile_pic',
																		'class' => 'form-control upload-image',
																		'placeholder' => 'Browse Photo',
																	]) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_profile_pic">
												<img id="profile_pic_preview" class="mt-2" style="display: none;" />
											@if ($details->profile_pic != null)
												@if (file_exists(public_path('/images/uploads/account/'.$details->profile_pic)))
													<div class="image-preview-holder" id="image_holder_profile_pic">
														<a data-fancybox="gallery" href="{{ asset('images/uploads/account/'.$details->profile_pic) }}">
															<img class="image-preview-border" id="image_preview mt-2" src="{{ asset('images/uploads/account/thumbs/'.$details->profile_pic) }}" width="100" height="" />
														</a>
														{{-- <span class="delete-preview-image delete-uploaded-preview-image" data-primaryid="{{ $id }}" data-imageid="image_preview" data-dbfield="image" data-routeprefix="{{ $pageRoute }}"><i class="fa fa-trash"></i></span> --}}
													</div>
												@endif												
											@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions mt-4">
							<div class="float-left">
								<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.'.$listUrl) }}">
									<i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.btn_cancel')
								</a>
							</div>
							<div class="float-right">
								<button type="submit" id="btn-processing" class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3">
									<i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_update')
								</button>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
@include($routePrefix.'.includes.profile_image_preview')
@endpush