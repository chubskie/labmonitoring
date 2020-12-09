@extends('_layout')

@section('body')
<div class="level">
	<div class="level-left">
		<div class="level-item">
			<h3 class="title">Dashboard</h3>
		</div>
	</div>
	<div class="level-right">
		<div class="level-item">
			<button id="add" class="button is-link">
				<span class="icon">
					<i class="fas fa-plus"></i>
				</span>
				<span>Add Laboratory</span>
			</button>
		</div>
	</div>
</div>
<hr>
<div id="add-card" class="card mb-3" style="display:none">
	<header class="card-header">
		<p class="card-header-title"></p>
	</header>
	<div class="card-content">
		<div class="content">
			<form action="lab/create" method="POST">
				@csrf
				<div class="field is-horizontal">
					<div class="field-label">
						<label class="label">Lab Name</label>
					</div>
					<div class="field-body">
						<div class="field">
							<div class="control">
								<input class="input" id="name" type="text" name="name" maxlength="60" required>
								<div class="help has-text-danger"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="field is-horizontal">
					<div class="field-label">
						<label class="label">Lab Color</label>
					</div>
					<div class="field-body">
						<div class="field">
							<div class="control">
								<input class="input" id="color" type="color" name="color">
								<div class="help has-text-danger"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="buttons is-centered">
					<button id="submit" type="submit" class="button is-success">Submit</button>
					<button id="cancel" class="button is-danger is-outlined" type="button">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container is-fluid">
	@if (count($labs) > 0)
	@php
	$count = 3;
	@endphp
	@foreach ($labs as $lab)
	@if ($count == 3)
	@php
	$count = 1;
	@endphp
	<div class="columns">

		@else
		@php
		$count++;
		@endphp
		@endif

		<div class="column is-4">
			@if($notAvailable->contains('labID', $lab->id))
			<a class="box" style="height:200px; border-top:10px solid#ff0000 ">
			@else
			<a class="box" style="height:200px; border-top:10px solid #48c774 ">
			@endif
				<div class="title has-text-centered is-size-5">{{ $lab->labName }}</div>
			</a>
		</div>

		@if ($count == 3)
	</div>
	@endif

	@endforeach
	@else
	<div class="has-text-centered">
		<span class="icon">
			<i class="fas fa-info-circle"></i>
		</span>
		<span>No Labs Found</span>
	</div>
	@endif
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection