@if ($playerTypes)
<div class="col-lg-12 form-group">
    @foreach ($playerTypes as $keyPlayerType => $valPlayerType)
        <div class="form-check" id="{{ $valPlayerType->id }}">
            <input type="checkbox" class="check form-check-input main-league" id="league_{{ $valPlayerType->id }}" data-cleague="{{ $valPlayerType->id }}" value="{{ $valPlayerType->id }}" name="league_partners[{{ $valPlayerType->id }}][id]">
            <label class="" for="league_{{ $valPlayerType->id }}">{!! $valPlayerType->title !!}</label>
        </div>

        {{-- Start :: existing user league partner id --}}
        <input type="hidden" name="league_partners[{{ $valPlayerType->id }}][user_league_partner_id]" value="" class="">
        {{-- End :: existing user league partner id --}}

        {{-- Start :: Single type --}}
        @if ($valPlayerType->is_double != 'Y')
            <input type="hidden" name="league_partners[{{ $valPlayerType->id }}][is_double]" value="N" placeholder="" class="sub-league-display-status-{{ $valPlayerType->id }}" style="display: none;">
        {{-- End :: Single type --}}
        {{-- Start :: Double type --}}
        @else
        <div class="sub-league-{{ $valPlayerType->id }}" style="display: none;">
            <input type="hidden" name="league_partners[{{ $valPlayerType->id }}][is_double]" value="Y" placeholder="" class="sub-league-display-status-{{ $valPlayerType->id }}" style="display: none;">
            
            <div class="row">
                <div class="col-lg-4 form-group">
                    <input type="text" name="league_partners[{{ $valPlayerType->id }}][first_name]" id="first_name_{{ $valPlayerType->id }}" class="form-control sub-league-checkbox-{{ $valPlayerType->id }} sub-league-display-status-{{ $valPlayerType->id }}" value="" placeholder="Partner First Name*" style="display: none;">
                </div>
                <div class="col-lg-4 form-group">
                    <input type="text" name="league_partners[{{ $valPlayerType->id }}][last_name]" id="last_name_{{ $valPlayerType->id }}" class="form-control sub-league-checkbox-{{ $valPlayerType->id }} sub-league-display-status-{{ $valPlayerType->id }}" value="" placeholder="Partner Last Name*" style="display: none;">
                </div>
                <div class="col-lg-4 form-group">
                    <input type="email" name="league_partners[{{ $valPlayerType->id }}][email]" id="email_{{ $valPlayerType->id }}" class="form-control sub-league-checkbox-{{ $valPlayerType->id }} sub-league-display-status-{{ $valPlayerType->id }}" value="" placeholder="Partner Email*" style="display: none;">
                </div>
            </div>
        </div>
        @endif
        {{-- End :: Double type --}}
    @endforeach
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Checkbox league click in registration
    $('.main-league').on('click', function() {
        var mainLeague = $(this).data('cleague');
        
        if ($(this).is(':checked')) {
            $('.sub-league-'+mainLeague).show(500);
            $('.sub-league-checkbox-'+mainLeague).prop('required', true);
            $('.sub-league-checkbox-'+mainLeague).val('');
            $('.sub-league-display-status-'+mainLeague).show();
		} else {
			$('.sub-league-checkbox-'+mainLeague).prop('required', false);
            $('.sub-league-checkbox-'+mainLeague).val('');
            $('.sub-league-display-status-'+mainLeague).hide();
            $('.sub-league-'+mainLeague).hide(500);
		}
    });
});
</script>
@endif