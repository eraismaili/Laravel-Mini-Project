@extends('layouts.layout')

@section('content')
    <h1>Profile</h1>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <form method="POST" action="{{ route('update.password') }}">
        @csrf

        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
@endsection
