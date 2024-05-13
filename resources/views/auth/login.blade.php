<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-image: url('/images/background.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    header {
        background-color: rgba(51, 51, 51, 0.8);
        color: #fff;
        padding: 10px 0;
        text-align: center;
    }

    header nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }


    header nav ul li {
        display: inline;
        margin: 0 10px;
    }

    header nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    main {
        padding: 20px;
        text-align: center;
        position: relative;
        min-height: calc(100vh - 120px);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    main h1 {
        font-size: 3rem;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    footer {
        background-color: rgba(51, 51, 51, 0.8);
        color: #fff;
        padding: 10px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .form {
        background-color: #f7e4f8ef !important;
        color: #212529 !important;
    }

    /* Custom Styles for Register Button */
    .btn.btn-primary.btn-block {
        background-color: #7a3671;
        border-color: #6613aa;
    }

    .btn.btn-primary.btn-block:hover {
        background-color: #72319c;
        border-color: #851bcc;
    }
</style>

@extends('layouts.layout')

@section('content')
    @guest

        <body>

            <header>
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                </nav>
            </header>

            <form action="{{ route('language.change.post') }}" method="POST">
                @csrf
                <select name="language" onchange="this.form.submit()">
                    <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
                    <option value="al" {{ app()->getLocale() === 'al' ? 'selected' : '' }}>Albanian</option>
                </select>
            </form>
            @if (App::getLocale() === 'en')
                <h1>Welcome</h1>
            @else
                <h1>Mirësevini</h1>
            @endif


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
                            <label for="email" class="text-dark">{{ __('login.email') }}:</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <label for="password" class="text-dark">{{ __('login.password') }}:</label><br>
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
        @else
            <script>
                window.location = "{{ route('profile.show') }}";
            </script>
        @endguest
    @endsection
