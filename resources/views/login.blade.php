@extends('_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('body')
<div class="columns is-centered is-vcentered is-marginless is-mobile" style="background-image: url(img/bg.png); background-position: center center; background-attachment: fixed;">
	<div class="column is-5-tablet is-4-desktop is-3-widescreen">
		
		<form class="box is-half" style="width:500px; height: 500px; background-color: #f0fff0;">
			<h1 class = "title" style="text-align: center;padding-bottom: 60px;">SIGN IN</h1>
			{{-- <figure class="image mb-4">
				<img src="{{ asset('img/SyMakerExtended.PNG') }}" alt="SyMaker Logo">
			</figure> --}}
			{{-- Username --}}
			<div class="field">
				<div class="control has-icons-left">
					<input type="text" class="input" placeholder="Username" name="username" required>
					<span class="icon is-left"><i class="fas fa-user"></i></span>
				</div>
			</div>
			{{-- Password --}}
			<div class="field has-addons is-marginless" style="padding-top: 5px">
				<p id="pass-control" class="control has-icons-left">
					<input type="password" class="input" placeholder="Password" name="password" required>
					<span class="icon is-left"><i class="fas fa-key"></i></span>
				</p>
				<div class="control">
					<button id="view" class="button has-background-grey-lighter" type="button"><span class="icon"><i class="fas fa-eye"></i></span></button>
				</div>
			</div>
			<a class="has-text-right has-text-dark help" style="padding-bottom: 100px ">Forgot Password?</a>
			{{-- Login --}}
			<p id="msg" class="help has-text-danger"></p>
			<div class="field has-text-centered">
				<button id="login" class="button is-primary" type="submit">LOG IN</button>
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$('form').submit(function(e) {
		e.preventDefault();
		$('#login').addClass('is-loading');
		$('input').attr('readonly', true);
		if ($('#pass-control input').attr('type') == 'text') {
			$('#pass-control input').attr('type', 'password');
			$('#view').removeClass('has-background-grey').addClass('has-background-grey-lighter').removeClass('has-text-white');
			$('#view svg').removeClass('fa-eye-slash').addClass('fa-eye');	
		}
		var data = $('form').serialize();
		$.ajax({
			type: 'POST',
			url: 'login',
			data: data,
			datatype: 'JSON',
			success: function(response) {
				if (response.status == 'success') {
					$('#login').removeClass('is-loading');
					Swal.fire({
						icon: 'success',
						title: response.msg,
						showConfirmButton: false,
						timer: 2500
					}).then(function() {
						$('.pageloader .title').text('Loading Dashboard');
						$('.pageloader').addClass('is-active');
						window.location.href = "{{ URL::previous() }}";
					});
				} else {
					$('#msg').text(response.msg);
					$('input').val('');
					$('input').removeAttr('readonly');
					$('#login').removeClass('is-loading');
				}
			},
			error: function(err) {
				$('input').removeAttr('readonly');
				$('#login').removeClass('is-loading');
				console.log(err);
				Swal.fire({
					icon: 'error',
					title: 'Cannot Connect to Sserver',
					text: 'Something went wrong. Please try again later.',
					confirmButtonText: 'Try Again'
				});
			}
		});
	});
</script>
<script src="{{ asset('js/login.js') }}"></script>
@endsection