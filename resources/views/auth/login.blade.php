<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-image: url('/images/pic.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
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
        /* padding: 20px; */
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
        background-color: #343a40;
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
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">@lang('profile.home')</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">@lang('profile.register')</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">@lang('profile.login')</a></li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Language
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="locale/en">English</a>
                                        <a class="dropdown-item" href="locale/al">Albanian</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6">
                    <form class="form mt-5 bg-light p-4 rounded" action="{{ route('login') }}" method="post">
                        @csrf
                        <h3 class="text-center text-dark mb-4">@lang('login.login')</h3>

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
                            <label for="email" class="text-dark">@lang('login.email'):</label><br>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="password" class="text-dark">@lang('login.password'):</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-block">@lang('login.login')</button>
                        </div>
                        <div class="text-center mt-3">
                            <span class="text-dark">@lang('login.dont_have_account') </span><a href="{{ route('register') }}"
                                class="text-primary">@lang('login.register_here')</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
