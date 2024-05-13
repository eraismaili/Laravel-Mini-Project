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

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6">
                    <form class="form mt-5 bg-light p-4 rounded" action="{{ route('register') }}" method="post">
                        @csrf
                        <h3 class="text-center text-dark mb-4">Register</h3>
                        <div class="form-group">
                            <label for="name" class="text-dark">{{ __('register.name') }}:</label><br>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="last_name" class="text-dark">{{ __('register.lastname') }}:</label><br>
                            <input type="text" name="last_name" id="last_name" class="form-control">
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="phone" class="text-dark">Phone:</label><br>
                            <input type="text" name="phone" id="phone" class="form-control">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="email" class="text-dark">Email:</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="password" class="text-dark">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="confirm-password" class="text-dark">Confirm Password:</label><br>
                            <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                            @error('confirm-password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="company_id" class="text-dark">Company:</label><br>
                            <select name="company_id" id="company_id" class="form-control">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <div class="text-center mt-3">
                            <span class="text-dark">Already have an account? </span><a href="{{ route('login') }}"
                                class="text-primary">Login here</a>
                        </div>
                    </form>
                </div>
            </div>
            <footer>
                <p>&copy; 2024 Laravel Project. All rights reserved.</p>
            </footer>
            </div>
        @else
            <script>
                window.location = "{{ route('profile.show') }}";
            </script>
        @endguest
    @endsection
