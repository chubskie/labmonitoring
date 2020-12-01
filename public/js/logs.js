$(function() {
	function ajaxError(err) {
		Swal.fire({
			icon: 'error',
			title: 'Cannot Connect to Server',
			text: 'Something went wrong. Please try again later.'
		});
	}

	// function pagination(current, prev, next, lastpage) {
	// 	$('.container.is-fluid').append('<nav class="pagination is-right"></nav>');
	// 	if (prev != null) $('.pagination').append('<a class="pagination-previous" data-url="' + prev + '">Previous</a>');
	// 	if (next != null) $('.pagination').append('<a class="pagination-next" data-url="' + next + '">Next</a>');
	// 	if (lastpage >= 3) $('.pagination').append('<form class="pagination-list"><div class="field has-addons"><div class="control"><button id="goto" class="button is-info" type="submit">Go to</button></div><div id="page" class="control"><input type="number" class="input" min="1" max="' + lastpage + '" value="' + current + '" placeholder="Page #"></div><div class="control"><a class="button is-static">/ ' + lastpage + '</a></div></div></form>');
	// }

	// function retrieveLogs(search) {

	// }

	$('#logs').addClass('is-active').removeAttr('href');
	$('.pageloader .title').text('Loading Logs');

	// var search = '';
	// $.ajax({
	// 	type: 'POST',
	// 	url: 'logs',
	// 	data: {search:search},
	// 	datatype: 'JSON',
	// 	success: function(data) {
	// 		if (data.logs.total > 50) {
	// 			pagination(data.logs.current_page, data.logs.last_page_url, data.logs.next_page_url, data.logs.last_page);
	// 		}
	// 	},
	// 	error: function(err) {
	// 		ajaxError(err);
	// 	}
	// });

	// $('body').delegate('.pagination form', 'submit', function(e) {
	// 	e.preventDefault();
	// 	let page = $('#page input').val();
	// 	if (page > lastPage || page < 0) {
	// 		$('#page input').addClass('is-danger');
	// 	} else {
	// 		if ($('#thesis').hasClass('is-active')) {
	// 			// link = 'http://localhost/thesisb/public/titles?page=' + page;
	// 			link = 'https://ueccssrnd.tech/thesisarchiving/titles?page=' + page;
	// 			retrieveProposals();
	// 		}
	// 	}
	// });
	
	// $('body').delegate('.pagination a', 'click', function() {
	// 	link = $(this).data('url');
	// 	if ($('#thesis').hasClass('is-active')) {
	// 		retrieveProposals();
	// 	} else if ($('#logs').hasClass('is-active')) {
	// 		retrieveLogs();
	// 	} else if ($('#students').hasClass('is-active')) {
	// 		retrieveStudents();
	// 	} else if ($('#advisers').hasClass('is-active')) {
	// 		retrieveAdvisers();
	// 	}
	// });
});