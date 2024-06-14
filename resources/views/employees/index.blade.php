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
            </table>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.min.css">

    <script>
        $(document).ready(function() {
            var table = $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('employees.data') }}',
                    data: function(d) {
                        d.search = $('input[type="search"]').val();
                    }
                },
                columns: [{
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'company.name',
                        name: 'company.name'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#employees-table_filter input').unbind().bind('keyup', function(e) {
                if (e.keyCode === 13) {
                    table.search(this.value).draw();
                }
            });
        });
    </script>
@endsection
