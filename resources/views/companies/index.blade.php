@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
            flex-direction: column;
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

        .toggle-section {
            display: none;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
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

    <main>
        <div class="container">
            <h1>@lang('companies.list_of_companies')</h1>

            <div class="button-group">
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('companies.create') }}" class="btn btn-primary">@lang('companies.create_new_company')</a>
                    <a href="{{ route('companies.export') }}" class="btn btn-success">Download Excel</a>
                @endif
            </div>

            <button class="btn btn-secondary" id="toggleRecentCompanies">@lang('companies.show_last_companies')</button>

            <div id="recentCompanies" class="toggle-section">
                <table class="table" id="recentCompaniesTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Employee</th>
                            <th>Logo</th>
                            <th>Website</th>
                            @if (Auth::user()->hasRole('admin'))
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentlyCreatedCompanies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    @forelse($company->employees as $employee)
                                        {{ $employee->first_name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @empty
                                        No Employees
                                    @endforelse
                                </td>
                                <td>
                                    <img src="{{ asset('storage/images/' . ($company->logo ?? 'atis.png')) }}"
                                        alt="Company Logo" width="50">
                                </td>
                                <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                                <td>
                                    @if (Auth::user()->hasRole('admin'))
                                        <a href="{{ route('companies.edit', $company->id) }}"
                                            class="btn btn-primary">@lang('companies.edit')</a>
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this company?')">@lang('companies.delete')</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button class="btn btn-secondary" id="toggleCompaniesWithEmployees">@lang('companies.show_companies')</button>

            <div id="companiesWithEmployees" class="toggle-section">
                <table class="table" id="companiesWithEmployeesTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Employee</th>
                            <th>Logo</th>
                            <th>Website</th>
                            @if (Auth::user()->hasRole('admin'))
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companiesWithMoreThanTwoEmployees as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    @forelse($company->employees as $employee)
                                        {{ $employee->first_name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @empty
                                        No Employees
                                    @endforelse
                                </td>
                                <td>
                                    <img src="{{ asset('storage/images/' . ($company->logo ?? 'atis.png')) }}"
                                        alt="Company Logo" width="50">
                                </td>
                                <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                                <td>
                                    @if (Auth::user()->hasRole('admin'))
                                        <a href="{{ route('companies.edit', $company->id) }}"
                                            class="btn btn-primary">@lang('companies.edit')</a>
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this company?')">@lang('companies.delete')</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h2>@lang('companies.all_companies')</h2>
            <table class="table" id="allCompaniesTable">
                <thead>
                    <tr>
                        <th>@lang('companies.name')</th>
                        <th>@lang('companies.email')</th>
                        <th>@lang('companies.employee')</th>
                        <th>Logo</th>
                        <th>@lang('companies.website')</th>
                        @if (Auth::user()->hasRole('admin'))
                            <th>@lang('companies.actions')</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>
                                @forelse($company->employees as $employee)
                                    {{ $employee->first_name }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @empty
                                    No Employees
                                @endforelse
                            </td>
                            <td>
                                <img src="{{ asset('storage/images/' . ($company->logo ?? 'atis.png')) }}"
                                    alt="Company Logo" width="50">
                            </td>
                            <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                            <td>
                                @if (Auth::user()->hasRole('admin'))
                                    <a href="{{ route('companies.edit', $company->id) }}"
                                        class="btn btn-primary">@lang('companies.edit')</a>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this company?')">@lang('companies.delete')</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#recentCompaniesTable').DataTable();
            $('#companiesWithEmployeesTable').DataTable();
            $('#allCompaniesTable').DataTable();

            $('#toggleRecentCompanies').click(function() {
                $('#recentCompanies').toggleClass('toggle-section');
            });

            $('#toggleCompaniesWithEmployees').click(function() {
                $('#companiesWithEmployees').toggleClass('toggle-section');
            });
        });
    </script>
@endsection
