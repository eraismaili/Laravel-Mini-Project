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

        .toggle-section {
            display: none;
        }
    </style>

    <header>
        <nav>
            <ul>
                @guest
                    <li><a href="{{ route('home') }}">
                            Home</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">Profile</a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">@lang('profile.edit_profile')</a>
                            <a class="dropdown-item" href="{{ route('profile.update-password.form') }}">@lang('profile.update_password')</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">@lang('profile.logout')</button>
                            </form>
                        </div>
                    </li>
                    @if (Auth::user()->hasRole('admin'))
                        <li><a href="{{ route('companies.index') }}">@lang('companies.companies')</a></li>
                        <li><a href="{{ route('employees.index') }}">@lang('companies.employees')</a></li>
                    @endif
                @endguest
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>@lang('companies.list_of_companies')</h1>

            <div class="mb-3">
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('companies.create') }}" class="btn btn-primary">@lang('companies.create_new_company')</a>
                    <a href="{{ route('companies.export') }}" class="btn btn-success mb-3">Download Excel</a>
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
