<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Company</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }


        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

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

        header {
            background-color: #343a40;
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

        select.form-control {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
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
        </head>

        <body>
            <div class="container">
                <h1>Create Employee</h1>
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" id="first_name" class="form-control">
                        @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class= "form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" class="form-control">
                        @error('last_name')
                            <div class="text-danger">{{ $message }} </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control">
                        @error('email')
                            <div class="text-danger">{{ $message }} </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                        @error('phone')
                            <div class="text-danger">{{ $message }} </div>
                        @enderror
                    </div>

                    <label for="company_id">Company:</label>
                    <select name="company_id" id="company_id" class="form-control">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>


                    <button type="submit">Create</button>
                </form>
            </div>
        </body>

    </html>
