@extends('_layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endsection

@section('body')
<div id="app">
	<schedule></schedule>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/calendar.js') }}"></script>
@endsection