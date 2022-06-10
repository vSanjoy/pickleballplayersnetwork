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
								'route' => [$routePrefix.'.'.$addUrl.'-submit'],
								'name'  => 'createPickleballCourtForm',
								'id'    => 'createPickleballCourtForm',
								'files' => true,
								'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_court_name')<span class="red_star">*</span></label>
											{{ Form::text('title', null, [
																			'id' => 'title',
																			'placeholder' => '',
																			'class' => 'form-control',
																			'required' => true,
																		]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" id="state-div">
										<label class="text-dark font-bold">@lang('custom_admin.label_state')<span class="red_star">*</span></label>
										<select name="state_id" id="state_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
											<option value="">--@lang('custom_admin.label_select')--</option>
										@foreach ($states as $item)
											<option value="{{ $item->id }}">{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_city')<span class="red_star">*</span></label>
										{{ Form::text('city', null, [
																	'id' => 'city',
																	'placeholder' => '',
																	'class' => 'form-control',
																	'required' => true,
																]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_address')</label>
										{{ Form::textarea('address', null, [
																		'id' => 'address',
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
										<label class="text-dark font-bold">@lang('custom_admin.label_address') 2</label>
										{{ Form::textarea('address_2', null, [
																		'id' => 'address_2',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'rows' => 2
																	]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_zip')</label>
										{{ Form::text('zip', null, [
																	'id' => 'zip',
																	'placeholder' => '',
																	'class' => 'form-control',
																]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_accessibility')</label>
										<select name="accessibility" id="accessibility" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="PR">@lang('custom_admin.label_private')</option>
											<option value="PL">@lang('custom_admin.label_public')</option>
											<option value="U">@lang('custom_admin.label_unknown')</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_indoor_outdoor')</label>
										<select name="indoor_outdoor" id="indoor_outdoor" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="ID">@lang('custom_admin.label_indoor')</option>
											<option value="OD">@lang('custom_admin.label_outdoor')</option>
											<option value="B">@lang('custom_admin.label_both')</option>
											<option value="U">@lang('custom_admin.label_unknown')</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_number_of_courts')</label>
										{{ Form::text('number_of_courts', null, [
																	'id' => 'number_of_courts',
																	'placeholder' => '',
																	'class' => 'form-control',
																]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_lights')</label>
										<select name="lights" id="lights" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="Y">@lang('custom_admin.label_yes')</option>
											<option value="N">@lang('custom_admin.label_no')</option>
											<option value="U">@lang('custom_admin.label_unknown')</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_net_availability')</label>
										<select multiple class="selectpicker form-control" id="net_availability" name="net_availability[]" data-container="body" data-live-search="true" title="--@lang('custom_admin.label_select')--" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="false">
										@foreach ($nets as $item)
											<option value="{{ $item->id }}">{!! $item->title !!}</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_cost')</label>
										<select name="cost" id="cost" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="FP">@lang('custom_admin.label_free_to_play')</option>
											<option value="DIF">@lang('custom_admin.label_drop_in_fee')</option>
											<option value="MP">@lang('custom_admin.label_membership_fee')</option>
											<option value="U">@lang('custom_admin.label_unknown')</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_reservations_requirements')</label>
										<select class="form-control" id="reservations_requirements" name="reservations_requirements">
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="Y">@lang('custom_admin.label_yes')</option>
											<option value="N">@lang('custom_admin.label_no')</option>
											<option value="U">@lang('custom_admin.label_unknown')</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone_number')</label>
										{{ Form::text('phone_no', null, [
																	'id' => 'phone_no',
																	'placeholder' => '',
																	'class' => 'form-control',
																]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_website')</label>
										{{ Form::text('website', null, [
																	'id' => 'website',
																	'placeholder' => '',
																	'class' => 'form-control',
																]) }}
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
									<i class="far fa-save" aria-hidden="true"></i> @lang('custom_admin.btn_submit')
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
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush