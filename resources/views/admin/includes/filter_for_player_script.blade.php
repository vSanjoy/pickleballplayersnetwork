// Filter
$(document).on('click', '#toggleSearchBox', function() {
	if ($('#showFilterStatus').is(':visible')) {
		$('#plus').show();
		$('#minus').hide();	
	} else {
		$('#minus').show();
		$('#plus').hide();
	}
	$('#showFilterStatus').toggle(400);
});
// Filter according to the options selected
$(document).on('click', '.filterList', function() {
	var playerRating	= $('#playerrating').val();
	var homeCourtId		= $('#homeCourtId').val();

	if (playerRating != '' || homeCourtId != '') {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}?player_rating=" + playerRating + "&home_court=" + homeCourtId;
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();
	} else {
		var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
		window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
		getList();
	}
});
// Reset Filter
$(document).on('click', '.resetFilter', function() {
	var getListUrlWithFilter = "{{route($routePrefix.'.'.$listUrl)}}";
	window.history.pushState({href: getListUrlWithFilter}, '', getListUrlWithFilter);
	$('#showFilterStatus')[0].reset();

	$('#playerrating, #homeCourtId option:selected').removeAttr('selected');
	getList();
});