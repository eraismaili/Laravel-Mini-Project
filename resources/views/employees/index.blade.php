@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .content-wrapper {
            flex: 1;
        }

        main {
            text-align: center;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main h1 {
            font-size: 2rem;
            color: #44363694;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
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
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('profile.profile')</a>
                                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">@lang('profile.view_profile')</a>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">@lang('profile.edit_profile')</a>
                                    <a class="dropdown-item"
                                        href="{{ route('profile.update-password.form') }}">@lang('profile.update_password')</a>
                                    <a class="dropdown-item" href="{{ route('companies.index') }}">Companies</a>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">@lang('profile.logout')</button>
                                    </form>
                                </div>
                            </li>
                            @if (Auth::user()->hasRole('admin'))
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('companies.index') }}">@lang('profile.companies')</a>
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('employees.index') }}">@lang('profile.employees')</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    <body>
        <div class="content-wrapper">
            <div class="container">
                <h1>@lang('employees.list_of_employees')</h1>
                <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">@lang('employees.create_new_employee')</a>
                <a href="{{ route('employees.export') }}" class="btn btn-info mb-3">Download Employees Excel</a>

                <table id="employees-table" class="display">
                    <thead>
                        <tr>
                            <th>@lang('employees.first_name')</th>
                            <th>@lang('employees.last_name')</th>
                            <th>@lang('employees.email')</th>
                            <th>@lang('employees.phone')</th>
                            <th>@lang('employees.company')</th>
                            <th>@lang('employees.actions')</th>
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
                                        style="display:inline;">
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
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employees-table').DataTable();
        });
    </script>
@endsection
