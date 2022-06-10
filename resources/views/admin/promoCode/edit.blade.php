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
						'name'  => 'updatePromoCodeForm',
						'id'    => 'updatePromoCodeForm',
						'files' => true,
						'novalidate' => true ]) }}

						{{ Form::hidden('id', $id, ['id' => 'id', 'class' => 'form-control']) }}

						<div class="form-body mt-4-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_promo_code')<span class="red_star">*</span></label>
										{{ Form::text('code', $details->code, [
																	'id' => 'code',
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
										<label class="text-dark font-bold">@lang('custom_admin.label_is_one_time_use')</label>
										{{ Form::select('is_one_time_use', 
											[
												'N' => trans('custom_admin.label_no'),
												'Y' => trans('custom_admin.label_yes')
											], (old('is_one_time_use')) ? old('is_one_time_use') : $details->is_one_time_use, array(
                                                'id' => 'is_one_time_use',
                                                'class' => 'form-control' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" id="maximum-number-of-use-div" @if ($details->is_one_time_use == 'Y')style="display: none;" @endif>
										<label class="text-dark font-bold">@lang('custom_admin.label_maximum_number_of_use')<span class="red_star">*</span></label>
                                        {{ Form::text('maximum_number_of_use', $details->maximum_number_of_use ?? null, array(
																				'id' => 'maximum_number_of_use',
																				'min' => 0,
																				'placeholder' => '',
																				'class' => 'form-control',
																				)) }}
									</div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_discount_type')<span class="red_star">*</span></label>
										{{ Form::select('discount_type', 
											[
												'F' => trans('custom_admin.label_flat'),
												'P' => trans('custom_admin.label_percent')
											], (old('discount_type')) ? old('discount_type') : $details->discount_type, array(
                                                'id' => 'discount_type',
                                                'class' => 'form-control' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_amount')<span class="red_star">*</span></label>
                                        {{ Form::text('amount', $details->amount, array(
																			'id' => 'amount',
																			'min' => 0,
																			'placeholder' => '',
																			'class' => 'form-control',
																			'required' => 'required'
																			)) }}
									</div>
								</div>
							</div>
							@php
							$startTime 	= (old('start_time')) ? old('start_time') : date('Y-m-d H:i', $details->start_time);
							$endTime 	= (old('end_time')) ? old('end_time') : ($details->end_time ? date('Y-m-d H:i', $details->end_time) : null);
							@endphp
							<div class="row mt-1">
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_start_date_time')<span class="red_star">*</span></label>
										{{ Form::text('start_time', $startTime, array(
																			'id' => 'start_date_time',
																			'class' => 'form-control',
																			'autocomplete' => 'off',
																			'required' => 'required' )) }}
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="text-dark font-bold">@lang('custom_admin.label_end_date_time')</label>
										<a href="javascript: void(0);" onclick="eraseEndTime()" class="erase-absolute" data-toggle="tooltip" data-placement="top" title="" data-original-title="Erase End Date & Time"><i class="fa fa-eraser" aria-hidden="true"></i></a>
										{{ Form::text('end_time', $endTime, array(
																			'id' => 'end_date_time',
																			'class' => 'form-control',
																			'autocomplete' => 'off' )) }}
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
<script type="text/javascript">
$(function () {
	$('#is_one_time_use').on('change', function() {
        if ($(this).val() == 'N') {
            $('#maximum-number-of-use-div').show(500);
            $('#cart_amount').val('0');
            $('#cart_amount').attr('required', true);
        } else {
            $('#maximum-number-of-use-div').hide(500);
            $('#cart_amount').val('');
            $('#cart_amount').attr('required', false);
        }
    });

	/* Restriction on key & right click */
	$('#start_date_time,#end_date_time').keydown(function(e){
		var keyCode = e.which;
		if ( (keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode === 8 || keyCode === 122 || keyCode === 32 || keyCode == 46 ) {
			e.preventDefault();
		}
	});
	$("#start_date_time,#end_date_time").on("contextmenu",function(){
		return false;
	});
	// /* Restriction on key & right click */
});

function eraseEndTime() {
	$('#end_date_time').val('');
}
</script>
@endpush