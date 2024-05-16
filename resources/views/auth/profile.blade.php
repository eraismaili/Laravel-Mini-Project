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
        /* min-height: calc(100vh - 120px); */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    main h1 {
        font-size: 3rem;
        color: black;
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
</style>

@extends('layouts.layout')

@section('content')

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            @guest
                                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('profile.profile')</a>
                                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">@lang('profile.view_profile')</a>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">@lang('profile.edit_profile')</a>
                                        <a class="dropdown-item"
                                            href="{{ route('profile.update-password.form') }}">@lang('profile.update_password')</a>

                                        <a class="dropdown-item" href="{{ route('companies.index') }}">@lang('profile.companies')</a>

                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">@lang('profile.logout')</button>
                                        </form>
                                    </div>
                                </li>
                                @if (Auth::user()->hasRole('admin'))
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('companies.index') }}">@lang('profile.companies')</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('employees.index') }}">@lang('profile.employees')</a>
                                    </li>
                                @endif
                            @endguest
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Language
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item"
                                        href="{{ route('language.change.post', ['lang' => 'en']) }}">English</a>
                                    <a class="dropdown-item"
                                        href="{{ route('language.change.post', ['lang' => 'al']) }}">Albanian</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var dropdownToggle = document.querySelector('.navbar .dropdown-toggle');
                var dropdownMenu = document.querySelector('.navbar .dropdown-menu');

                dropdownToggle.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('show');
                });

                window.addEventListener('click', function(event) {
                    if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            });
        </script>

        @auth
            <h1>{{ __('profile.welcome_message', ['name' => Auth::user()->name]) }}</h1>
            <p>{{ __('profile.name') }}: {{ Auth::user()->name }}</p>
            <p>{{ __('profile.email') }}: {{ Auth::user()->email }}</p>
            <div>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">@lang('profile.edit_profile_button') </a>
                <a href="{{ route('profile.update-password.form') }}" class="btn btn-primary">@lang('profile.update_password_button') </a>
            </div>
        @endauth

        @guest
            <script>
                window.location = "{{ route('login') }}";
            </script>
        @endguest
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
