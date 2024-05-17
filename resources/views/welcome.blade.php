<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Mini Project</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: lightblue;
            background-image: url('/images/pic.png');
            background-position: center;
            /* Adjusted to bottom */
            background-size: auto;
            /* Cover the entire viewport */
            background-repeat: no-repeat;
            height: 100vh;
            /* Ensure the body covers the entire viewport */
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

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        main {
            position: center;
        }

        h1 {
            text-align: center;
            /* Align the text to the center */
            font-size: 3rem;
            /* Increase font size */
            color: black;
            /* Change text color */
            padding: 20px;
            /* Add padding for better visibility */
            border-radius: 10px;
            /* Add rounded corners */
            margin-top: 20px;
            /* Adjust margin to create space below the header */
        }
    </style>
</head>
@extends('layouts.layout')

@section('content')

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">@lang('profile.home')</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">@lang('profile.register')</a>
                            </li>
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

        <main>
            <h1>@lang('welcome.employees_management_system')</h1>
        </main>

        <footer>
            <p>&copy; 2024 Laravel Project. All rights reserved.</p>
        </footer>
        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
