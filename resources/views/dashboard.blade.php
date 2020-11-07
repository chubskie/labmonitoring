@extends('_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/bulma-divider.min.css') }}">
@endsection

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

<div class="container is-fluid">
	<div class="columns">
		<div class="column is-4">
			<a class="box" style="height:200px; border-top:10px solid #f14668">
				<div class="title has-text-centered is-size-5">Lab 1</div>
			</a>
		</div>
		<div class="column is-4">
			<a class="box" style="height:200px; border-top:10px solid #48c774">
				<div class="title has-text-centered is-size-5">Lab 2</div>
			</a>
		</div>
		<div class="column is-4">
			<a class="box" style="height:200px; border-top:10px solid #48c774">
				<div class="title has-text-centered is-size-5">Lab 3</div>
			</a>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection