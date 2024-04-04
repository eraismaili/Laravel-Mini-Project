@extends('layouts.layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5 bg-light p-4 rounded" action="{{ route('login') }}" method="post">
                @csrf
                <h3 class="text-center text-dark mb-4">Login</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="form-group mt-3">
                    <label for="email" class="text-dark">Email:</label><br>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="text-dark">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <div class="text-center mt-3">
                    <span class="text-dark">Don't have an account? </span><a href="{{ route('register') }}"
                        class="text-primary">Register here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
