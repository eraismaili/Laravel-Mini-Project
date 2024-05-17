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

@extends('layouts.layout') @section('content')

    <body>
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var dropdownToggle = document.querySelector('.dropdown-toggle');
                var dropdownMenu = document.querySelector('.dropdown-menu');

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
        <h1>@lang('profile.update_password')</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update-password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password">@lang('profile.current_password')</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">@lang('profile.new_password')</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">@lang('profile.confirm_new_password')</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
                @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">@lang('profile.update_password')</button>
        </form>
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
