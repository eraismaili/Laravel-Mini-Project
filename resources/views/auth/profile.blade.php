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
</style>

@extends('layouts.layout') @section('content')

    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-3">Logout</button>
                    </form>
                    </li>
                </ul>
            </nav>
        </header>
        <h1>Profile</h1>
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <div><a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a><a
                href="{{ route('profile.update-password.form') }}" class="btn btn-primary">Update Password</a></div>
    @endsection
