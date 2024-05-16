<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        /* background-image: url('/images/.jpg'); */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    header {
        background-color: #343a40;
        color: #fff;
        padding: 5px 0;
        /* Adjusted padding */
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


    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    button[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

    .error {
        color: red;
        font-size: 16px;
    }
</style>
@extends('layouts.layout') @section('content')

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
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
                                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">View Profile</a>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                                        <a class="dropdown-item" href="{{ route('profile.update-password.form') }}">Update
                                            Password</a>
                                        <a class="dropdown-item" href="{{ route('companies.index') }}">Companies</a>

                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </div>
                                </li>
                                @if (Auth::user()->hasRole('admin'))
                                    <li class="nav-item"><a class="nav-link" href="{{ route('companies.index') }}">Companies</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
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

        <body>
            <div class="container">
                @if (Auth::user()->hasRole('admin'))
                    <h1>Edit Employee</h1>
                    <form action="{{ route('employees.update', $employee) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="first_name">@lang('employees.first_name'):</label>
                        <input type="text" name="first_name" id="first_name"
                            value="{{ old('first_name', $employee->first_name) }}">
                        @error('first_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <br>
                        <label for="last_name">@lang('employees.last_name'):</label>
                        <input type="text" name="last_name" id="last_name"
                            value="{{ old('last_name', $employee->last_name) }}">
                        @error('last_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <br>
                        <label for="email">@lang('employees.email'):</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <br>
                        {{-- <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" value="{{ $employee->phone }}"> --}}
                        <label for="phone">@lang('employees.phone'):</label>
                        <input type="text" name="phone" id="phone" value="{{ $employee->phone }}" readonly>


                        <label for="company_id">@lang('employees.company'):</label>
                        <select name="company_id" id="company_id">
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit">@lang('employees.update_button')</button>
                    </form>
                @else
                    <p>You do not have permission to edit this employee.</p>
                @endif
            </div>
        </body>

        </html>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
