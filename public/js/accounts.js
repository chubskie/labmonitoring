$(function() {
	function serverError(err) {
		console.log(err);
		Swal.fire({
			icon: 'error',
			title: 'Cannot Connect to Server',
			text: 'Something went wrong. Please try again later.'
		});
	}

	function retrieveAccounts() {
		// Continuously retrieve accounts
	}

	function retrieveAccounts(data) {
		let table = '';
		for (let i in data.users) {
			table += `
			<tr>
			<td>${data.users[i].username}</td>
			<td>${data.users[i].name}</td>
			<td>
			<div class="buttons is-right">
			<button class="button edit" data-id="${data.users[i].id}">
			<span class="icon">
			<i class="fas fa-edit"></i>
			</span>
			</button>
			<button class="button is-danger is-outlined remove" data-id="${data.users[i].id}">
			<span class="icon">
			<i class="fas fa-trash"></i>
			</span>
			</button>
			</div>
			</td>
			</tr>
			`;
		}
		$('tbody').empty().append(table);
	}

	var modal = '';
	$('#accounts').addClass('is-active').removeAttr('href');

	$('#add').click(function() {
		modal = 'add';
		$('#add-card').slideDown();
		$(this).addClass('is-hidden');
		$('.card-header-title').text('Add Account');
		$('#pass-field').removeClass('is-hidden');
		$('#password').attr('required', true);
		$('table button').attr('disabled', true);
	});

	$('.cancel').click(function() {
		$(this).parents('.card').slideUp();
		$('#add').removeClass('is-hidden');
		$('#addUser input').val('').removeAttr('readonly').removeClass('is-success').removeClass('is-danger');
		$('#addUser button').removeAttr('disabled').removeClass('is-loading');
		$('#addUser help').removeClass('has-text-danger').text('Username must be between 5 to 20 characters with at least 1 alphabetical character');
		$('table button').removeAttr('disabled');
	});

	$('#addUser').submit(function(e) {
		e.preventDefault();
		if ($('#password').attr('type') == 'text') {
			$('#password').attr('type', 'password');
			$('#view').addClass('has-background-grey-light').removeClass('has-background-grey-dark');
			$('#view').find('.icon').removeClass('has-text-white');
			$('#view').find('svg').removeClass('fa-eye-slash').addClass('fa-eye');
		}
		$(this).find('button[type="submit"]').addClass('is-loading');
		$('button').attr('disabled', true);
		$('input').attr('readonly', true);
		let data = $(this).serialize();
		let link = modal == 'add' ? 'accounts/addUser' : 'accounts/' + $('#username').attr('data-id') + '/update';
		$.ajax({
			type: 'POST',
			url: link,
			data: data,
			datatype: 'JSON',
			success: function(data) {
				$('button[type="submit"]').removeClass('is-loading');
				$('button').removeAttr('disabled');
				$('input').removeAttr('readonly');
				if (data.status) {
					Swal.fire({
						icon: 'success',
						title: 'Update Successful',
						text: data.msg,
						showConfirmButton: false,
						timer: 2500
					}).then(function() {
						retrieveAccounts(data);
						$('.cancel').click();
					});
				}
			},
			error: function(err) {
				serverError(err);
				$('button[type="submit"]').removeClass('is-loading');
				$('button').removeAttr('disabled');
				$('input').removeAttr('readonly');
			}
		});
	});

	$('#view').click(function() {
		$('#password').attr('type', $('#password').attr('type') == 'password' ? 'text' : 'password');
		if ($('#password').attr('type') == 'text') {
			$(this).removeClass('has-background-grey-light').addClass('has-background-grey-dark');
			$(this).find('.icon').addClass('has-text-white');
			$(this).find('svg').removeClass('fa-eye').addClass('fa-eye-slash');
		} else {
			$(this).addClass('has-background-grey-light').removeClass('has-background-grey-dark');
			$(this).find('.icon').removeClass('has-text-white');
			$(this).find('svg').removeClass('fa-eye-slash').addClass('fa-eye');
		}
	});

	$('#username').focusout(function() {
		$('button[type="submit"]').attr('disabled', true);
		$(this).parent().addClass('is-loading');
		let input = this;
		let username = $(this).val();
		let id = $(this).attr('data-id');
		$.ajax({
			type: 'POST',
			url: 'accounts',
			data: {username:username, id:id},
			datatype: 'JSON',
			success: function(response) {
				$(input).parent().removeClass('is-loading');
				if (response.status) {
					$('button[type="submit"]').removeAttr('disabled');
					$(input).addClass('is-success');
				} else {
					$(input).addClass('is-danger');
					$(input).next().addClass('has-text-danger').text(response.msg);
				}
			},
			error: function(err) {
				serverError(err);
				$('button[type="submit"]').removeAttr('disabled');
				$(input).parent().removeClass('is-loading');
			}
		});
	});

	$('#username').keyup(function() {
		$(this).removeClass('is-danger').removeClass('is-success');
		$(this).next().removeClass('has-text-danger').text('Username must be between 5 to 20 characters with at least 1 alphabetical character');
		$('button[type="submit"]').removeAttr('disabled');
	});

	$('body').delegate('.edit', 'click', function() {
		modal = 'edit';
		let elem = this;
		$('.card-header-title').text('Edit Account');
		$('#username').attr('data-id', $(this).data('id'));
		Swal.fire({
			icon: 'question',
			title: 'What do you want to update?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: 'Account Information',
			denyButtonText: 'Change Password'
		}).then((result) => {
			if (result.isConfirmed || result.isDenied) {
				Swal.fire({
					html: `<span class="icon is-large">
					<i class="fas fa-spinner fa-spin fa-lg"></i>
					</span>`,
					showConfirmButton: false,
					allowOutsideClick: false,
					allowEscapeKey: false
				});
				let data = result.isConfirmed ? 'information' : 'password';
				$.ajax({
					type: 'POST',
					url: 'accounts/' + $(elem).data('id'),
					data: {data:data},
					datatype: 'JSON',
					success: function(data) {
						if (result.isConfirmed) {
							$('#name').val(data.name);
							$('#username').val(data.username);
							$('#pass-field').addClass('is-hidden');
							$('#password').removeAttr('required');
							Swal.close();
							$('#add-card').slideDown();
							$('#add').addClass('is-hidden');
							$('table button').attr('disabled', true);
						} else {

						}
					},
					error: function(err) {
						serverError(err);
					}
				});
			}
		});
	});
});