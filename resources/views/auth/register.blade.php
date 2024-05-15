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
            padding: 20px 0;
            text-align: center;
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
                                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                                <li class="nav-item active"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
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
                            <label for="phone" class="text-dark">{{ __('register.phone') }}:</label><br>
                            <input type="text" name="phone" id="phone" class="form-control">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="email" class="text-dark">{{ __('register.email') }}:</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="password" class="text-dark">{{ __('register.password') }}:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="confirm-password" class="text-dark">{{ __('register.confirm-password') }}:</label><br>
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

</html>
