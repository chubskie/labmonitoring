@extends('_layout')

@section('body')
<div id="app"><schedule></schedule></div>
@endsection
@section('scripts')
<script src="{{ asset('js/calendar.js') }}"></script>
@endsection