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
								'name'  => 'createCmsForm',
								'id'    => 'createCmsForm',
								'files' => true,
								'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row" style="display: none;">
								<div class="col-md-6" id="isHomePage" style="display: none;">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_is_home_page')</label>
										<div class="">
											<input type="checkbox" class="check" id="customCheck2" name="is_home_page">
											<label class="" for="customCheck2"></label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_page_name')<span class="red_star">*</span></label>
										{{ Form::text('page_name', null, [
																		'id' => 'page_name',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => 'required',
																	]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_title')<span class="red_star">*</span></label>
										{{ Form::text('title', null, [
																		'id' => 'title',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => 'required',
																	]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_short_title')</label>
										{{ Form::text('short_title', null, [
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
										{{ Form::textarea('short_description', null, [
																					'id' => 'short_description',
																					'placeholder' => '',
																					'class' => 'form-control',
																					'rows' => 3
																				]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_description')</label>
										{{ Form::textarea('description', null, [
																			'id' => 'description',
																			'class' => 'form-control',
																			'placeholder' => '',
																			'rows' => 3
																		]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_description') 2</label>
										{{ Form::textarea('description2', null, [
																			'id' => 'description2',
																			'class' => 'form-control',
																			'placeholder' => '',
																			'rows' => 3
																		]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_other_description')</label>
										{{ Form::textarea('other_description', null, [
																			'id' => 'other_description',
																			'class' => 'form-control',
																			'placeholder' => '',
																			'rows' => 3
																		]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_banner_title')</label>
										{{ Form::text('banner_title', null, [
																			'id' => 'banner_title',
																			'placeholder' => '',
																			'class' => 'form-control',
																			]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_banner_short_title')</label>
										{{ Form::text('banner_short_title', null, [
																				'id' => 'banner_short_title',
																				'placeholder' => '',
																				'class' => 'form-control',
																			]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_banner_short_description')</label>
										{{ Form::textarea('banner_short_description', null, [
																							'id' => 'banner_short_description',
																							'placeholder' => '',
																							'class' => 'form-control',
																							'rows' => 3
																						]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_meta_title')</label>
										{{ Form::text('meta_title', null, [
																			'id' => 'meta_title',
																			'placeholder' => '',
																			'class' => 'form-control',
																		]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_meta_keywords')</label>
										{{ Form::text('meta_keywords', null, [
																				'id' => 'meta_keywords',
																				'placeholder' => '',
																				'class' => 'form-control',
																			]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_meta_description')</label>
										{{ Form::textarea('meta_description', null, [
																					'id' => 'meta_description',
																					'placeholder' => '',
																					'class' => 'form-control',
																					'rows' => 3
																				]) }}
									</div>
								</div>
							</div>
							<hr>
							<div class="row mt-4">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="text-dark font-bold">@lang('custom_admin.label_banner_image')</label>
												{{ Form::file('banner_image', [
																				'id' => 'banner_image',
																				'class' => 'form-control upload-image',
																				'placeholder' => 'Upload Image',
																			]) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_banner_image">
												<img id="banner_image_preview" class="mt-2" style="display: none;" />
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_banner_image') Title</label>
										{{ Form::text('banner_image_title', null, [
																					'id' => 'banner_image_title',
																					'placeholder' => '',
																					'class' => 'form-control',
																				]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_banner_image') Alt</label>
										{{ Form::text('banner_image_alt', null, [
																				'id' => 'banner_image_alt',
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
												<label class="text-dark font-bold">@lang('custom_admin.label_featured_image')</label>
												{{ Form::file('featured_image', [
																		'id' => 'featured_image',
																		'class' => 'form-control upload-image',
																		'placeholder' => 'Upload Image',
																	]) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_featured_image">											
												<img id="featured_image_preview" class="mt-2" style="display: none;" />											
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_featured_image') Title</label>
										{{ Form::text('featured_image_title', null, [
																					'id' => 'featured_image_title',
																					'placeholder' => '',
																					'class' => 'form-control',
																				]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_featured_image') Alt</label>
										{{ Form::text('featured_image_alt', null, [
																				'id' => 'featured_image_alt',
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
												<label class="text-dark font-bold">@lang('custom_admin.label_image')</label>
												{{ Form::file('other_image', [
																				'id' => 'other_image',
																				'class' => 'form-control upload-image',
																				'placeholder' => 'Upload Image',
																			]) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_other_image">
												<img id="other_image_preview" class="mt-2" style="display: none;" />
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_image') Title</label>
										{{ Form::text('other_image_title', null, [
																					'id' => 'other_image_title',
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
										{{ Form::text('other_image_alt', null, [
																				'id' => 'other_image_alt',
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
@include($routePrefix.'.includes.image_preview')
@endpush