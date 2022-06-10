@extends('admin.layouts.app', ['title' => $panelTitle])

@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ $pageTitle }}</h4>
					
					@if (count($list))
						<p>@lang('custom_admin.message_showing_list_ascending') @lang('custom_admin.message_drag_and_drop_to_sort')</p>
						<div class="well">
							<div class="dd" id="nestable">                
								<ol class="dd-list">
								@foreach ($list as $row)
									<li class="dd-item nested-list-item is_main_parent callout callout-info" data-microtip-position="top" role="tooltip" class="btn btn-primary btn-circle btn-circle-sm" aria-label="{{ trans('custom_admin.message_drag_and_drop_to_sort') }}" data-id="{{$row->id}}">
										{{-- <div class="dd-handle nested-list-handle"></div> --}}
										<div class="dd-handle grab nested-list-content">{!! $row->title !!}
											<span class="tip-msg"></span>
										</div>
									</li>											
								@endforeach
								</ol>    
							</div>
						</div>            
					@else            
						<table class="">
							<tr>
								<td colspan="2">@lang('custom_admin.message_no_records_found')</td>
							</tr>       
						</table>
					@endif

				</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
@include($routePrefix.'.includes.sorting')
@endpush