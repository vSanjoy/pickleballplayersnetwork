@extends('admin.layouts.app', ['title' => $panelTitle])

	@section('content')

	@include($routePrefix.'.includes.filter_for_players')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>					
					<div class="table-responsive mt-4-5">
						<table id="list-table" class="table table-striped table-bordered no-wrap list-data custom-table custom-table-first-column">
							<thead>
								<tr>
								@if ($isAllow || in_array($statusUrl, $allowedRoutes) || in_array($deleteUrl, $allowedRoutes))
									<th class="firstColumn">
										<div class="btn-group">
											<button type="button" class="btn btn-default btn-bulkAction">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="checkAll" id="customCheck2">
													<label class="" for="customCheck2"></label>
												</div>
											</button>
											<button class="dropdown-toggle btn btn-default dropdown-toggle dropdown-icon custom-padding0" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fas fa-sort-down"></i>

												<div class="dropdown-menu" aria-labelledby="navbarDropdown">
												@if ($isAllow || in_array($statusUrl, $allowedRoutes))
													<a class="dropdown-item bulkAction" data-action-type="active">
														@lang('custom_admin.label_active_selected')
													</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item bulkAction" data-action-type="inactive">
														@lang('custom_admin.label_inactive_selected')
													</a>
												@endif
												{{-- @if ($isAllow || (in_array($statusUrl, $allowedRoutes) && in_array($pageRoute, $allowedRoutes)))
													<div class="dropdown-divider"></div>
												@endif
												@if ($isAllow || in_array($pageRoute, $allowedRoutes))
													<a class="dropdown-item bulkAction" data-action-type="delete">
														@lang('custom_admin.label_delete_selected')
													</a>
												@endif --}}
												</div>
											</button>
										</div>
									</th>
								@endif
									<th class="zeroColumn table-th-display-none"></th>
									<th class="firstColumn">@lang('custom_admin.label_hash')</th>
									<th>@lang('custom_admin.label_name')</th>
									<th>@lang('custom_admin.label_email')</th>
									<th>@lang('custom_admin.label_player_rating')</th>
									<th>@lang('custom_admin.label_home_court')</th>
									<th>@lang('custom_admin.label_city')</th>
									<th class="modifiedColumn">Member Since</th>
									<th class="row_status">@lang('custom_admin.label_status')</th>
									<th class="row_status">@lang('custom_admin.label_action')</th>
								</tr>
							</thead>							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endsection

@push('scripts')
@include($routePrefix.'.'.$pageRoute.'.scripts')
@endpush
