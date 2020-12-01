$(function() {
	function ajaxError(err) {
		Swal.fire({
			icon: 'error',
			title: 'Cannot Connect to Server',
			text: 'Something went wrong. Please try again later.'
		});
	}

	// function retrieveLabs(data) {
	// 	var display = '';
	// 	if (data.labs.length > 0) {
	// 		let loop = Math.ceil(data.labs.length / 3) + (data.labs.length % 3 != 0 ? 0 : 1);
	// 		let count = 1;
	// 		for (lab in data.labs) {
	// 			if (count == loop) {
	// 				display += `
	// 				</
	// 				`
	// 			}
	// 			display += `

	// 			`
	// 		}
	// 	} else {
	// 		// No labs
	// 	}
	// }

	$('#dashboard').addClass('is-active').removeAttr('href');
	$('.pageloader .title').text('Loading Dashboard');

	$('#add').click(function() {
		$(this).addClass('is-hidden');
		$('#add-card').slideDown();
	});

	$('#cancel').click(function() {
		$('#add').removeClass('is-hidden');
		$('#add-card').slideUp();
		$('#name').val('');
		$('#add-card .help').text('');
	});

	$('#name').focusout(function() {
		$('#submit').attr('disabled', true);
		$(this).parent().addClass('is-loading');
		$(this).attr('readonly', true);
		let name = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'lab/check',
			data: {name:name},
			datatype: 'JSON',
			success: function(response) {
				$('#name').parent().removeClass('is-loading');
				$('#name').removeAttr('readonly');
				if (response.status == 'success') {
					$('#name').addClass('is-success');
					$('#submit').removeAttr('disabled');
				} else {
					$('#name').addClass('is-danger');
					$('#name').next().text(response.msg);
				}
			},
			error: function(err) {
				ajaxError(err);
				$('#name').parent().removeClass('is-loading');
				$('#name').removeAttr('readonly');
				$('#submit').removeAttr('disabled');
			}
		});
	});

	$('#name').keyup(function() {
		$(this).next().text('');
		$(this).removeClass('is-danger').removeClass('is-success');
		$('#add-card .help').text('');
		$('#submit').removeAttr('disabled');
	});

	// $('#addUser').submit(function(e) {
	// 	e.preventDefault();
	// 	$('input').attr('readonly', true);
	// 	$('button').attr('disabled', true);
	// 	$('#submit').addClass('is-loading');
	// 	let name = $('#name').val();
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: '',
	// 		data: {name:name},
	// 		datatype: 'JSON',
	// 		success: function(data) {
	// 			$('#submit').removeClass('is-loading');
	// 			$('button').removeAttr('disabled');
	// 			$('input').removeAttr('readonly');

	// 			if (data.status == 'error') {
	// 				Swal.fire({
	// 					icon: 'error',
	// 					title: data.msg
	// 				});
	// 			} else {
	// 				retrieveLabs(data);
	// 				$('#add-card').slideUp();
	// 				$('#add').removeClass('is-hidden');
	// 				$('#addUser input').removeClass('is-success').removeClass('is-danger').val('');
	// 				$('#addUser .help').text('');
	// 			}
	// 		},
	// 		error: function(err) {
	// 			ajaxError(err);
	// 			$('#submit').removeClass('is-loading');
	// 			$('button').removeAttr('disabled');
	// 			$('input').removeAttr('readonly');
	// 		}
	// 	});
	// });
});