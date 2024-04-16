@extends('layouts.layout')

@section('content')
    <h1>Profile</h1>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <div>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        <a href="{{ route('profile.update-password.form') }}" class="btn btn-primary">Update Password</a>
    </div>
@endsection
