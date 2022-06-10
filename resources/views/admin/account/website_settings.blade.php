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
						'route' => [$routePrefix.'.website-settings'],
						'name'  => 'updateWebsiteSettingsForm',
						'id'    => 'updateWebsiteSettingsForm',
						'files' => true,
						'novalidate' => true]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_from_email')<span class="red_star">*</span></label>
										{{ Form::text('from_email', $websiteSettings['from_email'] ?? null, array(
																		'id' => 'email',
																		'class' => 'form-control',
																		'placeholder' => '',
																		'required' => 'required' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_to_email')<span class="red_star">*</span></label>
										{{ Form::text('to_email', $websiteSettings['to_email'] ?? null, array(
																		'id' => 'to_email',
																		'class' => 'form-control',
																		'placeholder' => '',
																		'required' => 'required' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_phone_number')</label>
										{{ Form::text('phone_no', $websiteSettings['phone_no'] ?? null, array(
																		'id' => 'phone_no',
																		'class' => 'form-control',
																		'placeholder' => '' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_fax')</label>
										{{ Form::text('fax', $websiteSettings['fax'] ?? null, array(
																		'id' => 'fax',
																		'class' => 'form-control',
																		'placeholder' => '' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_facebook_link')</label>
										{{ Form::text('facebook_link', $websiteSettings['facebook_link'] ?? null, array(
																						'id' => 'facebook_link',
																						'class' => 'form-control',
																						'placeholder' => '' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_twitter_link')</label>
										{{ Form::text('twitter_link', $websiteSettings['twitter_link'] ?? null, array(
																						'id' => 'twitter_link',
																						'class' => 'form-control',
																						'placeholder' => '' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_instagram_link')</label>
										{{ Form::text('instagram_link', $websiteSettings['instagram_link'] ?? null, array(
                                                            'id' => 'instagram_link',
                                                            'class' => 'form-control',
                                                            'placeholder' => '' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_linkedin_link')</label>
										{{ Form::text('linkedin_link', $websiteSettings['linkedin_link'] ?? null, array(
                                                            'id' => 'linkedin_link',
                                                            'class' => 'form-control',
                                                            'placeholder' => '' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_pinterest_link')</label>
										{{ Form::text('pinterest_link', $websiteSettings['pinterest_link'] ?? null, array(
                                                            'id' => 'pinterest_link',
                                                            'class' => 'form-control',
                                                            'placeholder' => '' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_googleplus_link')</label>
										{{ Form::text('googleplus_link', $websiteSettings['googleplus_link'] ?? null, array(
                                                            'id' => 'googleplus_link',
                                                            'class' => 'form-control',
                                                            'placeholder' => '' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_youtube_link')</label>
										{{ Form::text('youtube_link', $websiteSettings['youtube_link'] ?? null, array(
                                                            'id' => 'youtube_link',
                                                            'class' => 'form-control',
                                                            'placeholder' => '' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_rss_link')</label>
										{{ Form::text('rss_link', $websiteSettings['rss_link'] ?? null, array(
                                                            'id' => 'rss_link',
                                                            'class' => 'form-control',
                                                            'placeholder' => '' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_dribble_link')</label>
										{{ Form::text('dribble_link', $websiteSettings['dribble_link'] ?? null, array(
                                                            'id' => 'dribble_link',
                                                            'class' => 'form-control',
                                                            'placeholder' => '' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_tumblr_link')</label>
										{{ Form::text('tumblr_link', $websiteSettings['tumblr_link'] ?? null, array(
                                                            'id' => 'tumblr_link',
                                                            'class' => 'form-control',
                                                            'placeholder' => '' )) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_map')</label>
										{{ Form::textarea('map', $websiteSettings['map'] ?? null, array(
                                                            'id' => 'map',
                                                            'class' => 'form-control',
                                                            'rows'	=> 4,
                                                            'placeholder' => '' )) }}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_websitetitle')<span class="red_star">*</span></label>
										{{ Form::text('website_title', $websiteSettings->website_title ?? null, [
																		'id' => 'website_title',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'required' => 'required',
																	]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_email_signature')</label>
										{{ Form::text('tag_line', $websiteSettings->tag_line ?? null, [
																		'id' => 'tag_line',
																		'placeholder' => '',
																		'class' => 'form-control',
																		'rows'	=> 3
																	]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_default_meta_title')</label>
										{{ Form::text('default_meta_title', $websiteSettings->default_meta_title ?? null, [
																					'id' => 'default_meta_title',
																					'placeholder' => '',
																					'class' => 'form-control',
																				]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_default_meta_keyword')</label>
										{{ Form::text('default_meta_keywords', $websiteSettings->default_meta_keywords ?? null, [
												'id' => 'default_meta_keywords',
												'placeholder' => '',
												'class' => 'form-control',
												'rows'	=> 3,
											]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_default_meta_description')</label>
										{{ Form::textarea('default_meta_description', $websiteSettings->default_meta_description ?? null, [
												'id' => 'default_meta_description',
												'placeholder' => '',
												'class' => 'form-control',
												'rows'	=> 3
											]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_address')</label>
										{{ Form::textarea('address', $websiteSettings->address ?? null, [
															'id' => 'address',
															'placeholder' => '',
															'class' => 'form-control',
															'rows'	=> 3
														]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_footer_address')</label>
										{{ Form::textarea('footer_address', $websiteSettings->footer_address ?? null, [
																				'id' => 'footer_address',
																				'placeholder' => '',
																				'class' => 'form-control',
																				'rows'	=> 3
																			]) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_copyright_text')</label>
										{{ Form::textarea('copyright_text', $websiteSettings->copyright_text ?? null, [
																				'id' => 'copyright_text',
																				'placeholder' => '',
																				'class' => 'form-control',
																				'rows'	=> 3
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
												<label class="text-dark font-bold">@lang('custom_admin.label_logo')</label>
												{{ Form::file('logo', array(
																		'id' => 'logo',
																		'class' => 'form-control upload-image',
																		'placeholder' => 'Upload Image',
																		)) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_logo">
												<img id="logo_preview" class="mt-2" style="display: none;" />
											@if (isset($websiteSettings->logo) && $websiteSettings->logo != null)
												@if (file_exists(public_path('/images/uploads/'.$pageRoute.'/'.$websiteSettings->logo)))
													<div class="image-preview-holder" id="image_holder_logo">
														<a data-fancybox="gallery" href="{{ asset('images/uploads/'.$pageRoute.'/'.$websiteSettings->logo) }}">
															<img class="image-preview-border" id="logo_preview mt-2" src="{{ asset('images/uploads/'.$pageRoute.'/'.$websiteSettings->logo) }}" width="150" height="" />
														</a>
														{{-- <span class="delete-preview-image delete-uploaded-preview-image" data-primaryid="{{ $websiteSettings->id }}" data-imageid="logo_preview" data-dbfield="logo" data-routeprefix="{{ $pageRoute }}"><i class="fa fa-trash"></i></span> --}}
													</div>
												@endif												
											@endif
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_logo') @lang('custom_admin.label_title')</label>
										{{ Form::text('logo_title', $websiteSettings->logo_title, [
																			'id' => 'logo_title',
																			'placeholder' => '',
																			'class' => 'form-control',
																		]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_logo') Alt</label>
										{{ Form::text('logo_alt', $websiteSettings->logo_alt, [
																			'id' => 'logo_alt',
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
												<label class="text-dark font-bold">@lang('custom_admin.label_footer_logo')</label>
												{{ Form::file('footer_logo', array(
																			'id' => 'footer_logo',
																			'class' => 'form-control upload-image',
																			'placeholder' => 'Upload Image',
																			)) }}
											</div>
										</div>
										<div class="col-md-4">
											<div class="preview_img_div_footer_logo">
												<img id="footer_logo_preview" class="mt-2" style="display: none;" />
											@if (isset($websiteSettings->footer_logo) && $websiteSettings->footer_logo != null)
												@if (file_exists(public_path('/images/uploads/'.$pageRoute.'/'.$websiteSettings->footer_logo)))
													<div class="image-preview-holder" id="image_holder_footer_logo">
														<a data-fancybox="gallery" href="{{ asset('images/uploads/'.$pageRoute.'/'.$websiteSettings->footer_logo) }}">
															<img class="image-preview-border" id="footer_logo_preview mt-2" src="{{ asset('images/uploads/'.$pageRoute.'/'.$websiteSettings->footer_logo) }}" width="150" height="" />
														</a>
														{{-- <span class="delete-preview-image delete-uploaded-preview-image" data-primaryid="{{ $websiteSettings->id }}" data-imageid="footer_logo_preview" data-dbfield="footer_logo" data-routeprefix="{{ $pageRoute }}"><i class="fa fa-trash"></i></span> --}}
													</div>
												@endif
											@endif
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_footer_logo') @lang('custom_admin.label_title')</label>
										{{ Form::text('footer_logo_title', $websiteSettings->footer_logo_title, [
																			'id' => 'footer_logo_title',
																			'placeholder' => '',
																			'class' => 'form-control',
																		]) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_footer_logo') Alt</label>
										{{ Form::text('footer_logo_alt', $websiteSettings->footer_logo_alt, [
																			'id' => 'footer_logo_alt',
																			'placeholder' => '',
																			'class' => 'form-control',
																		]) }}
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
@include($routePrefix.'.includes.image_preview')
@endpush
