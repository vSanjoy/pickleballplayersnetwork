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
						'route' => [$routePrefix.'.profile'],
						'name'  => 'updateProfileForm',
						'id'    => 'updateProfileForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_first_name')<span class="red_star">*</span></label>
										{{ Form::text('first_name', $adminDetail->first_name, array(
                                                                'id' => 'first_name',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_last_name')<span class="red_star">*</span></label>
										{{ Form::text('last_name', $adminDetail->last_name, array(
                                                                'id' => 'last_name',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_email')<span class="red_star">*</span></label>
										{{ Form::text('email', $adminDetail->email, array(
                                                                'id' => 'email',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone_number')<span class="red_star">*</span></label>
										{{ Form::text('phone_no', $adminDetail->phone_no, array(
                                                                'id' => 'phone_no',
                                                                'class' => 'form-control',
                                                                'placeholder' => '',
                                                                'required' => 'required' )) }}
									</div>
								</div>
							</div>
							@php
							$image = '';
							if ($adminDetail->profile_pic != null && file_exists(public_path('images/uploads/'.$pageRoute.'/'.$adminDetail->profile_pic))) {
								$image = '<img src="'.asset("images/uploads/".$pageRoute."/thumbs/".$adminDetail->profile_pic).'" />';
							}
							@endphp
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_profile_pic')</label>
										{{ Form::file('profile_pic', array(
																	'id' => 'upload_image',
																	'class' => 'form-control',
																	'placeholder' => 'Upload Image',
																	)) }}
									</div>
									<div id="image-preview" class=""></div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputFile">&nbsp;</label>
										<span class="btn btn-light btn-md btn-block crop_image mb-14">
											<i data-feather="crop" class="feather-icon"></i> @lang('custom_admin.label_crop_image')
										</span>
										{!! Form::hidden('cropped_image', null, array('id' => 'image-code-after-crop')) !!}

										<div id="preview-crop-image" class="preview-image" style="height: {{ config('global.IMAGE_CONTAINER') }}px; padding: 42px 2px 20px 2px; position: relative;">
										@if ($image)
											<a data-fancybox="gallery" href="{{ asset('images/uploads/'.$pageRoute.'/thumbs/'.$adminDetail->profile_pic) }}">
												{!!$image!!}
											</a>
											<span class="delete-preview-image delete-uploaded-cropped-image" data-microtip-position="top" role="tooltip" aria-label="{{ trans('custom_admin.label_delete') }}" data-primaryid="{{ customEncryptionDecryption(Auth::guard('admin')->user()->id) }}" data-dbfield="profile_pic" data-routeprefix="{{ $pageRoute }}" data-img-container="{{ config('global.IMAGE_CONTAINER') }}"><i class="fa fa-trash"></i></span>
										@endif
										</div>
									</div>                                        
								</div>
							</div>
						</div>
						<div class="form-actions mt-4">
							<div class="float-left">
								<a class="btn btn-secondary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3" href="{{ route($routePrefix.'.dashboard') }}">
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
@include($routePrefix.'.includes.cropper')
@endpush
