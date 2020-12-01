@extends('_layout')

@section('body')
<div class="columns is-centered">
	<div class="column is-6">
		<form class="box mt-4" method="POST" action="{{ URL::to('freelab-store') }}">
			@csrf
			<h3 class="title has-text-centered">Free Lab Form</h3>


			<div class="field">
				<label class="label">First Name</label>
				<div class="control">
					<input class="input" type="text" placeholder="">
				</div>
			</div>
			<div class="field">
				<label class="label">Middle Initial</label>
				<div class="control">
					<input class="input" type="text" placeholder="">
				</div>
			</div>
			<div class="field">
				<label class="label">Last Name</label>
				<div class="control">
					<input class="input" type="text" placeholder="">
				</div>
			</div>
			<div class="field">
				<label class="label">Course</label>
				<div class="control">
					<input class="input" type="text" placeholder="">
				</div>
			</div>
			<div class="field">
				<label class="label">Student Number</label>
				<div class="control">
					<input class="input" type="number" placeholder="">
				</div>
			</div>

			<div class="field">
				<label class="label">Section</label>
				<div class="control">
					<div class="select">
						<select>
							<option>Select dropdown</option>
							<option>With options</option>
						</select>
					</div>
				</div>
			</div>
			<div class="field is-grouped">
				<div class="control">
					<label class="label">Time In</label>
					<div class="control">
						<input class="input" type="time">
					</div>
				</div>
				<div class="control">
					<label class="label">Time Out</label>
					<div class="control">
						<input class="input" type="time">
					</div>
				</div>
			</div>


			<div class="field is-grouped">
				<div class="control">
					<button class="button is-link">Submit</button>
				</div>
				<div class="control">
					<a href="/" class="button is-link is-light">Cancel</a>
				</div>
			</div>


		</form>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$('html').addClass('has-background-info');
</script>
@endsection