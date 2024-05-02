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

        <body>
            <div class="container">
                @if (Auth::user()->hasRole('admin'))
                    <h1>Edit Employee</h1>
                    <form action="{{ route('employees.update', $employee) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" id="first_name" value="{{ $employee->first_name }}">

                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" value="{{ $employee->last_name }}">

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ $employee->email }}">

                        {{-- <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" value="{{ $employee->phone }}"> --}}
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" value="{{ $employee->phone }}" readonly>


                        <label for="company_id">Company:</label>
                        <select name="company_id" id="company_id">
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit">Update</button>
                    </form>
                @else
                    <p>You do not have permission to edit this employee.</p>
                @endif
            </div>
        </body>

        </html>
