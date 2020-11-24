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

	function checkPasswords(passwords) {
		$('#passCard button[type="submit"]').removeAttr('disabled');
		for (i in passwords) {
			if (!passwords[i]) {
				$('#passCard button[type="submit"]').attr('disabled', true);
				break;
			}
		}
	}

	var modal = '', passwords = {'current':true, 'new':true};
	$('#accounts').addClass('is-active').removeAttr('href');

	$('#add').click(function() {
		modal = 'add';
		if ($('#password').attr('type') == 'text') {
			$('#password').attr('type', 'password');
			$('.view').addClass('has-background-grey-light').removeClass('has-background-grey-dark');
			$('.view').find('.icon').removeClass('has-text-white');
			$('.view').find('svg').removeClass('fa-eye-slash').addClass('fa-eye');
		}
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
		$('#addUser .help').removeClass('has-text-danger').text('Username must be between 5 to 20 characters with at least 1 alphabetical character');
		$('table button').removeAttr('disabled');
	});

	$('#addUser').submit(function(e) {
		e.preventDefault();
		if ($('#password').attr('type') == 'text') {
			$('#password').attr('type', 'password');
			$('.view').addClass('has-background-grey-light').removeClass('has-background-grey-dark');
			$('.view').find('.icon').removeClass('has-text-white');
			$('.view').find('svg').removeClass('fa-eye-slash').addClass('fa-eye');
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

	$('.view').click(function() {
		$(this).parent().prev().find('input').attr('type', $(this).parent().prev().find('input').attr('type') == 'password' ? 'text' : 'password');
		if ($(this).parent().prev().find('input').attr('type') == 'text') {
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
		passwords['new'] = true;
		passwords['current'] = true;
		checkPasswords(passwords);
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
			if (result.isConfirmed) {
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
						$('#name').val(data.name);
						$('#username').val(data.username);
						$('#pass-field').addClass('is-hidden');
						$('#password').removeAttr('required');
						Swal.close();
						$('#add-card').slideDown();
						$('#add').addClass('is-hidden');
						$('table button').attr('disabled', true);
					},
					error: function(err) {
						serverError(err);
					}
				});
			} else if (result.isDenied) {
				if ($('#current').attr('type') == 'text' || $('#new').attr('type') == 'text') {
					$('#current').attr('type', 'password');
					$('#new').attr('type', 'password');
					$('.view').addClass('has-background-grey-light').removeClass('has-background-grey-dark');
					$('.view').find('.icon').removeClass('has-text-white');
					$('.view').find('svg').removeClass('fa-eye-slash').addClass('fa-eye');
				}
				$('#passCard input').val('').attr('data-id', $(elem).attr('data-id')).removeClass('is-success').removeClass('is-danger');
				$('#passCard control').removeClass('is-loading');
				$('#passCard .help').text('');
				$('table button').attr('disabled', true);
				$('#passCard').slideDown();
				$('#add').addClass('is-hidden');
			}
		});
	});

	$('#current').focusout(function() {
		$(this).parent().addClass('is-loading');
		$(this).attr('readonly', true);
		passwords['current'] = false;
		checkPasswords(passwords);
		let pass = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'accounts/' + $('#current').attr('data-id'),	
			data: {data:'current', password:pass},
			datatype: 'JSON',
			success: function(response) {
				if (response.status) {
					$('#current').parent().removeClass('is-loading');
					$('#current').addClass('is-success').removeClass('is-danger').removeAttr('readonly');
					$('#currenthelp').text('');
					passwords['current'] = true;
					checkPasswords(passwords);
				} else {
					$('#current').parent().removeClass('is-loading');
					$('#current').addClass('is-danger').removeClass('is-success').removeAttr('readonly');
					$('#currenthelp').text(response.msg);
				}
			},
			error: function(err) {
				$('#current').parent().removeClass('is-loading');
				$('#current').removeAttr('readonly');
				passwords['current'] = true;
				checkPasswords(passwords);
				serverError(err);
			}
		});
	});

	$('#current').keyup(function() {
		$('#currenthelp').text('');
		$(this).removeClass('is-success').removeClass('is-danger').removeAttr('readonly');
		passwords['current'] = true;
		checkPasswords(passwords);
	});

	$('#new').focusout(function() {
		$(this).parent().addClass('is-loading');
		$(this).attr('readonly', true);
		passwords['new'] = false;
		checkPasswords(passwords);
		let pass = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'accounts/' + $('#new').attr('data-id'),	
			data: {data:'new', password:pass},
			datatype: 'JSON',
			success: function(response) {
				if (response.status) {
					$('#new').parent().removeClass('is-loading');
					$('#new').addClass('is-success').removeClass('is-danger').removeAttr('readonly');
					$('#newhelp').text('');
					passwords['new'] = true;
					checkPasswords(passwords);
				} else {
					$('#new').parent().removeClass('is-loading');
					$('#new').addClass('is-danger').removeClass('is-success').removeAttr('readonly');
					$('#newhelp').text(response.msg);
				}
			},
			error: function(err) {
				$('#new').parent().removeClass('is-loading');
				$('#new').removeAttr('readonly');
				passwords['new'] = true;
				checkPasswords(passwords);
				serverError(err);
			}
		});
	});

	$('#new').keyup(function() {
		$('#newhelp').text('');
		$(this).removeClass('is-success').removeClass('is-danger').removeAttr('readonly');
		passwords['new'] = true;
		checkPasswords(passwords);
	});

	$('#changePass').submit(function(e) {
		e.preventDefault();
		if ($('#current').attr('type') == 'text' || $('#new').attr('type') == 'text') {
			$('#current').attr('type', 'password');
			$('#new').attr('type', 'password');
			$('.view').addClass('has-background-grey-light').removeClass('has-background-grey-dark');
			$('.view').find('.icon').removeClass('has-text-white');
			$('.view').find('svg').removeClass('fa-eye-slash').addClass('fa-eye');
		}
		$('button[type="submit"]').addClass('is-loading');
		$('button').attr('disabled', true);
		$('input').attr('readonly', true);
		var data = $(this).serialize();
		$.ajax({
			type: 'POST',
			url: 'accounts/' + $('#current').attr('data-id') + '/changepass',
			data: data,
			datatype: 'JSON',
			success: function(response) {
				Swal.fire({
					icon: 'success',
					title: 'Update Successful',
					text: response.msg,
					showConfirmButton: false,
					timer: 2500
				}).then(function() {
					$('#passCard').slideUp();
					$('#add').removeClass('is-hidden');
					$('button[type="submit"]').removeClass('is-loading');
					$('button').removeAttr('disabled');
					$('input').removeAttr('readonly');
				});
			},
			error: function(err) {
				serverError(err);
			}
		});
	});

	$('body').delegate('.remove', 'click', function() {
		let id = $(this).data('id');
		Swal.fire({
			html: `<span class="icon is-large">
			<i class="fas fa-spinner fa-spin fa-lg"></i>
			</span>`,
			showConfirmButton: false,
			allowOutsideClick: false,
			allowEscapeKey: false
		});
		$.ajax({
			type: 'POST',
			url: 'accounts/' + id,
			data: {data:'information'},
			datatype: 'JSON',
			success: function(data) {
				Swal.fire({
					icon: 'question',
					title: 'Confirm Delete',
					html: `Are you sure you want to delete ${data.username}?
					<div class="help">${data.name}</div>`,
					showCancelButton: true,
					cancelButtonText: 'No',
					confirmButtonText: 'Yes'
				}).then((result) => {
					if (result.isConfirmed) {
						Swal.fire({
							html: `<span class="icon is-large">
							<i class="fas fa-spinner fa-spin fa-lg"></i>
							</span>`,
							showConfirmButton: false,
							allowOutsideClick: false,
							allowEscapeKey: false
						});
						$.ajax({
							type: 'POST',
							url: 'accounts/' + id + '/delete',
							datatype: 'JSON',
							success: function(data) {
								Swal.fire({
									icon: 'success',
									title: 'Delete Successful',
									text: data.msg,
									showConfirmButton: false,
									timer: 2500
								}).then(function() {
									retrieveAccounts(data);
								});
							},
							error: function(err) {
								serverError(err);
							}
						});
					}
				});
			},
			error: function(err) {
				serverError(err);
			}
		});
	});
});