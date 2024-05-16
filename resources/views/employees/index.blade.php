@extends('layouts.layout')

@section('content')
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
            font-size: 2rem;
            color: #44363694;
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
                                <a class="dropdown-item" href="{{ route('profile.update-password.form') }}">Update Password</a>
                                <a class="dropdown-item" href="{{ route('companies.index') }}">Companies</a>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </li>
                        @if (Auth::user()->hasRole('admin'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('companies.index') }}">Companies</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('employees.index') }}">Employees</a></li>
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
    <form action="{{ route('employees.index') }}" method="GET">
    <input type="text" name="search" placeholder="Search Employees or Companies">
    <button type="submit">Search</button>
</form>
        <div class="container">
            <h1>List of Employees</h1>
            <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">Create New Employee</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->company->name }}</td>
                            <td>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete {{ $employee->first_name }} {{ $employee->last_name }}?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $employees->links('pagination.custom') }}
        </div>
    </body>

    </html>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>