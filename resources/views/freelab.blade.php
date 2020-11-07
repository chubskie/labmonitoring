@extends('_layout')

@section('body')
<div class="columns is-centered">
	<div class="column is-6">
		<form class="box mt-4" method="POST" action="{{ URL::to('freelab-store') }}">
			@csrf
			<h3 class="title has-text-centered">Free Lab Form</h3>
		</form>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$('html').addClass('has-background-info');
</script>
@endsection
