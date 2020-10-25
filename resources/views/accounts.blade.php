@extends('_layout')

@section('body')
@if (Auth::check())
<div class="card">
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
                    <input class="input" id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
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
    
</div>
<br>
<div class="card">
    <header class="card-header">
        <p class="card-header-title">
            Add Account
        </p>
    </header>
    <div class="card-content">
        <div class="content">
        <form method="POST" action="{{ route('addUser') }}">
            @csrf
            <div class="field">
                <label class="label">Name</label>
                <div class="control">
                    <input class="input" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                </div>
            </div>
            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>
            </div>
            <div class="field">
                <label class="label">Confirm Password</label>
                <div class="control">
                    <input class="input" id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password">
                    
                </div>
            </div>
            <div class="control">
                <button type="submit" class="button is-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
<br>

<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @if (count($users) > 0)
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <button class="button">Edit</button>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@endif

@endsection
