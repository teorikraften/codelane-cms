$(function() {
	$("#search-query").autocomplete({
		source: '/keywords',
		appendTo: '#search-autocomplete-list'
	});

	$("#sign-in-button").attr('href', '#');
	$("#sign-up-button").attr('href', '#');
	$('#sign-in-button').click(function() {
		$("#sign-in").show();
		$("#sign-up").hide();
		$("#sign-in-button").addClass('active');
		$("#sign-up-button").removeClass('active');
	});

	$('#sign-up-button').click(function() {
		$("#sign-up").show();
		$("#sign-in").hide();
		$("#sign-up-button").addClass('active');
		$("#sign-in-button").removeClass('active');
	});
});