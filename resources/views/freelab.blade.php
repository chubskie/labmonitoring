@extends('_layout')

@section('styles')
<style>
	input[type="time"] {
		width: 150px;
	}
</style>
@endsection

@section('body')
<div class="columns is-centered">
	<div class="column is-6">
		<form class="box mt-4" method="POST" action="{{ URL::to('freelab-store') }}">
			@csrf
			<h3 class="title has-text-centered">Free Lab Form</h3>
			<hr>
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Full Name</label>
				</div>
				<div class="field-body">
					<div class="field is-grouped">
						<div class="control is-expanded">
							<input type="text" id="lastname" name="lastname"class="input" placeholder="Last Name" required>
						</div>
						<div class="control is-expanded">
							<input type="text" id="firstname" name="firstname" class="input" placeholder="First Name">
						</div>
						<div class="control" style="width:70px">
							<input type="text" id="middlename" name="mi" class="input" placeholder="M.I.">
						</div>
					</div>
				</div>
			</div>
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Student Number</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="number" id="sn" name="sn" class="input" placeholder="XXXXXXXXXXX" required>
						</div>
					</div>
				</div>
			</div>
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Course</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control is-expanded">
							<div class="select">
								<select id="course" name="course" required>
									<option value="" selected disabled>Choose Course</option>
									<option value="BSCS">BSCS</option>
									<option value="BSIT">BSIT</option>
									<option value="BSIS">BSIS</option>
									<option value="BSEMC-GD">BSEMC-GD</option>
									<option value="BSEMC-DA">BSEMC-DA</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Section</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" id="section" name="section" class="input" required>
						</div>
					</div>
				</div>
			</div>
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Laboratory</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<div class="select">
								<select id="lab" name="lab" required>
									@foreach($labs as $lab)
										<option value="{{$lab->labName}}">{{$lab->labName}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Time In</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="time" id="in" name="in" class="input" required>
						</div>
					</div>
				</div>
			</div>
			<div class="field is-horizontal">
				<div class="field-label">
					<label class="label">Time Out</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="time" id="out" name="out" class="input" required>
						</div>
					</div>
				</div>
			</div>
			<div class="buttons is-centered pt-3">
				<button class="button is-success">Submit</button>
				<a href="{{ route('dashboard') }}" class="button is-danger is-outlined">Cancel</a>
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