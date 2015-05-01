// ADMIN SCRIPTS

function checkUpdates() {

	$.get('https://ftbastler.github.io/BoNeMEAL/updates.json', function(json) {
		$('#update').html('<h3>' + json['title'] + '</h3><p>' + json['body'] + '</p><p><a href="https://github.com/ftbastler/BoNeMEAL/releases" class="btn btn-default">' + 'Download now!' + '</a></p>');
	}).fail(function() {
		$('#update').html('Error. Could not load updates.');
	});
}

$(document).ready(function() {
	$('[rel=dataTable]').DataTable({
		responsive: true
	});
});
