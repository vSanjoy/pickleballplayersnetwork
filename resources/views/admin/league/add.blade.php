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
								'name'  => 'createLeagueForm',
								'id'    => 'createLeagueForm',
								'files' => true,
								'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_title')<span class="red_star">*</span></label>
											{{ Form::text('title', null, [
																			'id' => 'title',
																			'placeholder' => '',
																			'class' => 'form-control',
																			'required' => true,
																		]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_zip') @lang('custom_admin.label_code')<span class="red_star">*</span></label>
										{{ Form::text('zip', null, [
																	'id' => 'zip',
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
										<label class="text-dark font-bold">@lang('custom_admin.label_play_type')<span class="red_star">*</span></label>
										{{ Form::select('play_type', 
											[
												'' => '--'.trans('custom_admin.label_select').'--',
												'S' => trans('custom_admin.label_singles'),
												'D' => trans('custom_admin.label_doubles')
											], (old('play_type')) ? old('play_type'):null, array(
                                                'id' => 'play_type',
                                                'class' => 'form-control' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_gender')<span class="red_star">*</span></label>
										{{ Form::select('gender', 
											[
												'' => '--'.trans('custom_admin.label_select').'--',
												'M' => trans('custom_admin.label_male'),
												'F' => trans('custom_admin.label_female'),
												'MX' => trans('custom_admin.label_mixed'),
											], (old('gender')) ? old('gender'):null, array(
                                                'id' => 'gender',
                                                'class' => 'form-control' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_rating')<span class="red_star">*</span></label>
										<select name="rating" id="rating" class="form-control">
											<option value="">--@lang('custom_admin.label_select')--</option>
											<option value="2.0 - 3.0">2.0 - 3.0</option>
											<option value="3.0 - 4.0">3.0 - 4.0</option>
											<option value="4.0 - 5.0">4.0 - 5.0</option>
											<option value="5.0 - 100.0">5.0 +</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_amount')<span class="red_star">*</span></label>
                                        {{ Form::text('amount', null, array(
																			'id' => 'amount',
																			'min' => 0,
																			'placeholder' => '',
																			'class' => 'form-control',
																			'required' => 'required'
																			)) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_maximum_registration_allowed')<span class="red_star">*</span></label>
                                        {{ Form::text('maximum_registration_allowed', null, array(
																				'id' => 'maximum_registration_allowed',
																				'min' => 0,
																				'placeholder' => '',
																				'class' => 'form-control',
																				)) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_start_and_end_date')<span class="red_star">*</span></label>
										{{ Form::text('start_end_date', null, array(
																			'id' => '',
																			'class' => 'form-control dateRangePicker',
																			'autocomplete' => 'off',
																			'required' => true )) }}
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