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
						'name'  => 'updateBannerForm',
						'id'    => 'updateBannerForm',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_title')<span class="red_star">*</span></label>
										{{ Form::text('title', $details->title, [
																		'id' => 'title',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => 'required',
																	]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_short_title')</label>
										{{ Form::text('short_title', $details->short_title, [
																					'id' => 'short_title',
																					'placeholder' => '',
																					'class' => 'form-control'
																				]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_short_description')</label>
										{{ Form::textarea('short_description', $details->short_description, [
																					'id' => 'short_description',
																					'placeholder' => '',
																					'class' => 'form-control',
																					'rows' => 3
																				]) }}
									</div>
								</div>
							</div>
							<hr>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="text-dark font-bold">@lang('custom_admin.label_image')<span class="red_star">*</span></label>
												{{ Form::file('image', [
																		'id' => 'image',
																		'class' => 'form-control upload-image',
																		'placeholder' => 'Upload Image',
																	]) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_image">
												<img id="image_preview" class="mt-2" style="display: none;" />
											@if ($details->image != null)
												@if (file_exists(public_path('/images/uploads/'.$pageRoute.'/'.$details->image)))
													<div class="image-preview-holder" id="image_holder_image">
														<a data-fancybox="gallery" href="{{ asset('images/uploads/'.$pageRoute.'/'.$details->image) }}">
															<img class="image-preview-border" id="image_preview mt-2" src="{{ asset('images/uploads/'.$pageRoute.'/'.$details->image) }}" width="170" height="" />
														</a>														
														{{-- <span class="delete-preview-image delete-uploaded-preview-image" data-primaryid="{{ $id }}" data-imageid="image_preview" data-dbfield="image" data-routeprefix="{{ $pageRoute }}"><i class="fa fa-trash"></i></span> --}}
													</div>
												@endif												
											@endif
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_image') Title</label>
										{{ Form::text('image_title', $details->image_title, [
																					'id' => 'image_title',
																					'placeholder' => '',
																					'class' => 'form-control',
																				]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_image') Alt</label>
										{{ Form::text('image_alt', $details->image_alt, [
																			'id' => 'image_alt',
																			'placeholder' => '',
																			'class' => 'form-control',
																		]) }}
									</div>
								</div>
							</div>
							<hr>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="text-dark font-bold">Mobile @lang('custom_admin.label_image')<span class="red_star">*</span></label>
												{{ Form::file('image_mobile', [
																		'id' => 'image_mobile',
																		'class' => 'form-control upload-image',
																		'placeholder' => 'Upload Image',
																	]) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_image_mobile">
												<img id="image_mobile_preview" class="mt-2" style="display: none;" />
											@if ($details->image_mobile != null)
												@if (file_exists(public_path('/images/uploads/'.$pageRoute.'/'.$details->image_mobile)))
													<div class="image-preview-holder" id="image_holder_image_mobile">
														<a data-fancybox="gallery" href="{{ asset('images/uploads/'.$pageRoute.'/'.$details->image_mobile) }}">
															<img class="image-preview-border" id="image_preview mt-2" src="{{ asset('images/uploads/'.$pageRoute.'/'.$details->image_mobile) }}" width="170" height="" />
														</a>														
														{{-- <span class="delete-preview-image delete-uploaded-preview-image" data-primaryid="{{ $id }}" data-imageid="image_preview" data-dbfield="image" data-routeprefix="{{ $pageRoute }}"><i class="fa fa-trash"></i></span> --}}
													</div>
												@endif												
											@endif
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Mobile @lang('custom_admin.label_image') Title</label>
										{{ Form::text('image_title_mobile', $details->image_title_mobile, [
																					'id' => 'image_title_mobile',
																					'placeholder' => '',
																					'class' => 'form-control',
																				]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">Mobile @lang('custom_admin.label_image') Alt</label>
										{{ Form::text('image_alt_mobile', $details->image_alt_mobile, [
																			'id' => 'image_alt_mobile',
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
@include($routePrefix.'.includes.image_preview')
@endpush