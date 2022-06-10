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
						'route' => [$routePrefix.'.change-password'],
						'name'  => 'updateAdminPassword',
						'id'    => 'updateAdminPassword',
						'files' => true,
						'novalidate' => true ]) }}
						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_current_password')<span class="red_star">*</span></label>
										{{ Form::password('current_password', array(
																		'id' => 'current_password',
																		'class' => 'form-control',
																		'placeholder' => '',
																		'required' => 'required' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_new_password')<span class="red_star">*</span></label>
										{{ Form::password('password',array(
																		'id' => 'password',
																		'class' => 'form-control password-checker',
																		'data-pcid'	=> 'new-password-checker',
																		'placeholder' => '',
																		'required' => 'required' )) }}
									</div>
									<div class="progress" id="new-password-checker">
										<div class="progress" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_confirm_password')<span class="red_star">*</span></label>
										{{ Form::password('confirm_password', array(
																				'id' => 'confirm_password',
																				'class' => 'form-control',
																				'placeholder' => '',
																				'required' => 'required' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										&nbsp;
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
