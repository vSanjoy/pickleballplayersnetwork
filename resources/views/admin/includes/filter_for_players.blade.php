@php
$homeCourtId = $selectedPlayerRating = '';
$hideStatus = 'style="display: none;"';
$showStatus = 'style="display: block;"';

if (isset($_GET['player_rating']) && $_GET['player_rating'] != '') { $selectedPlayerRating = $_GET['player_rating']; }
if (isset($_GET['home_court']) && $_GET['home_court'] != '') { $homeCourtId = $_GET['home_court']; }

if ( (isset($_GET['player_rating']) && $_GET['player_rating'] != '') || (isset($_GET['home_court']) && $_GET['home_court'] != '') ) {
	$showStatus = 'style="display: block;"';
	$hideStatus = 'style="display: none;"';
}
@endphp

<!-- Start :: Filter -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Filter</h4>
				<button type="button" class="btn search-toggle-icon" id="toggleSearchBox">
					<i class="fas fa-plus" id="plus" data-ctoggle="1" {!! $hideStatus !!}></i>
					<i class="fas fa-minus" id="minus" data-ctoggle="0" {!! $showStatus !!}></i>
				</button>
				<form class="mt-4" id="showFilterStatus" {!! $showStatus !!}>
					<div class="form-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Player Rating</label>
									<select name="player_rating" id="playerrating" class="form-control">
										<option value="">--@lang('custom_admin.label_select')--</option>
									@php for ($playerRating = 2.0; $playerRating <= 5.5; $playerRating += 0.25) { @endphp
										<option value="{{ formatToTwoDecimalPlaces($playerRating) }}" @if ($selectedPlayerRating == formatToTwoDecimalPlaces($playerRating))selected @endif>
											{{ formatToTwoDecimalPlaces($playerRating)}} @if ($playerRating == 5.50)+ @endif
										</option>
									@php } @endphp
									</select>
								</div>
							</div>
							{{-- End :: Preferred Level --}}
							{{-- Start :: Preferred Home Court --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">Pickleball Court</label>
									<select name="home_court" id="homeCourtId" class="form-control">
										<option value="">--@lang('custom_admin.label_select')--</option>
									@if ($pickleballCourts)
										@foreach ($pickleballCourts as $itemHomeCourt)
										<option value="{{ $itemHomeCourt->id }}" @if ($homeCourtId == $itemHomeCourt->id)selected @endif>{!! $itemHomeCourt->title.' ('.$itemHomeCourt->city.', '.$itemHomeCourt->stateDetails->code.')' !!}</option>
										@endforeach
									@endif
									</select>
								</div>
							</div>
							{{-- End :: Preferred Home Court --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="text-dark font-bold">&nbsp;</label><br />
									<button class="btn btn-info btn-circle btn-circle-sm filterList" type="button" title="Filter">
										<i class="fas fa-search"></i>
									</button>
									<button class="btn btn-dark btn-circle btn-circle-sm ml-1 resetFilter" type="button">
										<i class="fas fa-sync-alt" aria-hidden="true"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End :: Filter -->