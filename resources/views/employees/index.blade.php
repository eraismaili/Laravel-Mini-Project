@extends('layouts.layout')

@section('content')
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
            color: #a33030;
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

    <body>
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
