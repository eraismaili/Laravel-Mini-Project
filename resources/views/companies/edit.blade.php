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

    .error {
        color: red;
        font-size: 16px;
    }
</style>

@extends('layouts.layout') @section('content')

    <body>
        <header>
            <nav>
                <ul>
                    @guest
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true"
                                aria-expanded="false">Profile</a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show') }}">View Profile</a>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                                <a class="dropdown-item" href="{{ route('profile.update-password.form') }}">Update Password</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                        </li>
                        @if (Auth::user()->hasRole('admin'))
                            <li><a href="{{ route('companies.index') }}">Companies</a></li>
                            <li><a href="{{ route('employees.index') }}">Employees</a></li>
                        @endif
                    @endguest
                </ul>
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
        <div class="container">
            @if (Auth::user()->hasRole('admin'))
                <h2>Edit Company</h2>
                <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $company->name) }}">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $company->email) }}">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo:</label>
                        <input type="file" class="form-control-file" id="logo" name="logo">
                    </div>
                    <div class="form-group">
                        <label for="website">Website:</label>
                        <input type="url" class="form-control" id="website" name="website"
                            value="{{ old('website', $company->website) }}">
                        @error('website')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @else
                <p>You do not have permission to edit this employee.</p>
            @endif
        </div>
    @endsection
