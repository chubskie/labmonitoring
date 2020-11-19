@extends('_layout')

@section('body')
<div class="level">
  <div class="level-left">
    <div class="level-item">
      <h3 class="title">Accounts</h3>
    </div>
  </div>
  <div class="level-right">
    <div class="level-item">
      <button id="add" class="button is-link">
        <span class="icon">
          <i class="fas fa-plus"></i>
        </span>
        <span>Add Account</span>
      </button>
    </div>
  </div>
</div>

<div id="add-card" class="card" style="display:none">
  <header class="card-header">
    <p class="card-header-title"></p>
  </header>
  <div class="card-content">
    <div class="content">
      <form id="addUser">
        <div class="field is-horizontal">
          <div class="field-label">
            <label class="label">Name</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                <input class="input" id="name" type="text" name="name" maxlength="60" required>
              </div>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label">
            <label class="label">Username</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                <input class="input" id="username" type="text" name="username" maxlength="20" minlength="5" required>
                <div class="help">Username must be between 5 to 20 characters with at least 1 alphabetical character</div>
              </div>
            </div>
          </div>
        </div>
        <div id="pass-field" class="field is-horizontal">
          <div class="field-label">
            <label class="label">Password</label>
          </div>
          <div class="field-body">
            <div class="field has-addons">
              <div class="control is-expanded">
                <input class="input" id="password" type="password" name="password" minlength="8" required>
              </div>
              <div class="control">
                <button id="view" class="button has-background-grey-light" type="button">
                  <span class="icon">
                    <i class="fas fa-eye"></i>
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="buttons is-centered">
          <button type="submit" class="button is-success">Submit</button>
          <button class="button is-danger is-outlined cancel" type="button">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- <div class="card" style="display:none">
  <header class="card-header">
    <p class="card-header-title">
      Change password
    </p>
  </header>
  <div class="card-content">
    <div class="content">
      <form method="POST" action="{{ route('change.password') }}">
        @csrf 
        <div class="field">
          <label class="label">Current Password</label>
          <div class="control">
            <input class="input" type="password" class="form-control" name="current_password" autocomplete="current-password">
          </div>
        </div>
        <div class="field">
          <label class="label">New Password</label>
          <div class="control">

            <input class="input" id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
          </div>
        </div>
        <div class="field">
          <label class="label">New Confirm Password</label>
          <div class="control">

            <input class="input" id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
          </div>
        </div>
        <div class="control">
          <button type="submit" class="button is-primary">Update password</button>
        </div>
      </form>
    </div>
  </div>
</div> --}}

<table class="table is-striped is-hoverable is-fullwidth mt-3">
  <thead>
    <tr>
      <th>Username</th>
      <th>Name</th>
      <th style="width:150px; max-width:150px">Action</th>
    </tr>
  </thead>

  <tbody>
    @if (count($users) > 0)
    @foreach ($users as $user)
    <tr>
      <td>{{ $user->username }}</td>
      <td>{{ $user->name }}</td>
      <td>
        <div class="buttons is-right">
          <button class="button edit" data-id="{{ $user->id }}">
            <span class="icon">
              <i class="fas fa-edit"></i>
            </span>
          </button>
          <button class="button is-danger is-outlined remove" data-id="{{ $user->id }}">
            <span class="icon">
              <i class="fas fa-trash"></i>
            </span>
          </button>
        </div>
      </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td class="has-text-centered" colspan="4">No users found.</td>
    </tr>
    @endif
  </tbody>
</table>
@endsection

@section('scripts')
<script src="{{ asset('js/accounts.js') }}"></script>
@endsection