// ADMIN SCRIPTS

$(document).ready(function() {
	$('[rel=dataTable]').DataTable({
		responsive: true
	});

	moment.locale(window.navigator.language);

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
});

function checkUpdates() {

	$.get('https://ftbastler.github.io/BoNeMEAL/updates.json', function(json) {
		$('#update').html('<h3>' + json['title'] + '</h3><p>' + json['body'] + '</p><p><a href="https://github.com/ftbastler/BoNeMEAL/releases" class="btn btn-default">' + 'Download now!' + '</a></p>');
	}).fail(function() {
		$('#update').html('Error. Could not load updates.');
	});

}

$.fn.autocomplete = function(baseurl, server, results) {
	if(baseurl == null)
		throw new Exception('No base url given!');

	if(results == null)
		throw new Exception('No result element selector given!');

	if(server == null)
		throw new Exception('No server callback function given!');

	var el = this;

	$(this).keyup(function() {
		$(el).parent().removeClass('has-success');

		if($(el).val().length < 2) {
			$(results).html("");
			return;
		} 

		$(results).html("...");

		$.get(baseurl + "/api/search-playername/" + server() + "/" + $(el).val(), function(data) {
			if(data.results.length <= 0) {
				$(results).html("");
				return;
			}
			
			if(data.results[0] == $("#autocomplete").val()) {
				$(el).parent().addClass('has-success');
				$(results).html("");
				return;
			}

			$(results).html(data.results);
		})
	}).keyup();
};