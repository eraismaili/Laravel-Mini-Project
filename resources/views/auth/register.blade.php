@extends('layouts.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5 bg-light p-4 rounded" action="{{ route('register') }}" method="post">
                @csrf
                <h3 class="text-center text-dark mb-4">Register</h3>
                <div class="form-group">
                    <label for="name" class="text-dark">Name:</label><br>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label for="email" class="text-dark">Email:</label><br>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="text-dark">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label for="confirm-password" class="text-dark">Confirm Password:</label><br>
                    <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <div class="text-center mt-3">
                    <span class="text-dark">Already have an account? </span><a href="{{ route('login') }}"
                        class="text-primary">Login here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
