// ADMIN SCRIPTS

$(document).ready(function() {

	moment.locale(window.navigator.language);

	if($('#datetimepicker').length > 0) {
		var val = $('#datetimepicker').val();
		$('#datetimepicker').datetimepicker({
			icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			},
			locale: window.navigator.language
		}).data("DateTimePicker").date(moment(val));
	}
});

function checkUpdates() {

	$.get('https://ftbastler.github.io/BoNeMEAL/updates.json', function(json) {
		$('#update').html('<h3>' + json['title'] + '</h3><p>' + json['body'] + '</p><p><a href="https://github.com/ftbastler/BoNeMEAL/releases" class="btn btn-default">' + 'Download now!' + '</a></p>');
	}).fail(function() {
		$('#update').html('Error. Could not load updates.');
	});

}
