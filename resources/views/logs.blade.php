@extends('_layout')

@section('body')
<div class="container is-fluid">
  <div class="level">
    <div class="level-left">
      <div class="level-item">
        <h3 class="title">Logs</h3>
      </div>
    </div>
    <div class="level-right">
      <div class="level-item" style="width:500px">
        <div class="field has-addons" style="width:100%">
          <div class="control is-expanded">
            <input type="text" class="input" placeholder="Search laboratory, activity, date, time, or name...">
          </div>
          <div class="control">
            <button class="button is-info">
              <span class="icon">
                <i class="fas fa-search"></i>
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <table class="table is-hoverable is-striped is-fullwidth mt-3">
    <thead>
      <tr>
        <th style="width:50px">LogID</th>
        <th>Name</th>
        <th>Activity</th>
        <th style="width:100px">Laboratory</th>
        <th style="width:200px">Timestamp</th>
      </tr>
    </thead>
    <tbody>
      @if (count($logs) > 0)
      @foreach ($logs as $log)
      <tr>
        <th>{{ $log->id }}</th>
        <td>
          {{ $log->studentID ? $log->student->fullName : Auth::user()->name }}
        </td>
        <td>{{ $log->description }}</td>
        <td>{{ $log->labID ? $log->laboratory->labName : '' }}</td>
        <td>{{ \Carbon\Carbon::parse($log->created_at)->isoFormat('MM/DD/YYYY - hh:mma') }}</td>
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="5" class="has-text-centered">
          <span class="icon">
            <i class="fas fa-info-circle"></i>
          </span>
          <span>No logs found</span>
        </td>
      </tr>
      @endif
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/logs.js') }}"></script>
@endsection