// APPLICATION SCRIPTS

$.fn.confirmDelete = function() {
	var el = $(this);

	el.click(function(e) {
		e.preventDefault();

		var dialog = BootstrapDialog.confirm({
			title: 'Confirm delete',
			message: 'Are you sure you want to <b>delete</b> this entry?',
			btnCancelLabel: 'No, cancel',
			btnOKLabel: 'Yes, delete',
			btnOKClass: 'btn-warning',
			type: BootstrapDialog.TYPE_WARNING,
			callback: function(result) {
				if(result) {
					el.parent().submit();
				} else {
					dialog.close();
				}
			}
		});
	});
};

$.fn.autocomplete = function(baseurl, server) {
	if(baseurl == null)
		throw new Exception('No base url given!');

	var el = $(this);

	var typeahead = el.typeahead({ source: [] }).data('typeahead');

	el.keyup(function() {
		el.parent().removeClass('has-success');

		if(el.val().length <= 1)
			return;

		if(server == null || server <= 0) {
			$.get(baseurl + "/api/search-playername-all/" + el.val(), function(data) {
				typeahead.setSource(data.results);

				if(data.results[0] == data.query) {
					el.parent().addClass('has-success');
				}
			},'json');
		} else {
			var serverId = server();
			if(!serverId)
				throw new Exception('Server callback returned nothing.');

			$.get(baseurl + "/api/search-playername/" + serverId + "/" + el.val(), function(data) {
				typeahead.setSource(data.results);

				if(data.results[0] == data.query) {
					el.parent().addClass('has-success');
				}
			},'json');
		}
	});
};

$(document).ready(function() {
	$('.flashmsg').delay(4000).fadeOut(500);

	if($('.timeline .collapse').length > 0) {
		$('#toggleAllTimelineItems').show();

		$('#toggleAllTimelineItems').click(function() {
			$('.timeline .collapse').collapse('toggle');
		});
	}

	$('.confirmDelete').each(function() {
		$(this).confirmDelete();
	});
});

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});