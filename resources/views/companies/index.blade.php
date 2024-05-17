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
    <form action="{{ route('companies.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search Companies">
        <button type="submit">Search</button>
    </form>
    <main>
        <div class="container">
            <h1>@lang('companies.list_of_companies')</h1>

            <div class="mb-3">
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('companies.create') }}" class="btn btn-primary">@lang('companies.create_new_company')</a>
                @endif
            </div>

            <!-- Button to toggle visibility of companies created in the last 10 days -->
            <button class="btn btn-secondary" id="toggleRecentCompanies">@lang('companies.show_last_companies')</button>

            <!-- Companies Created in the Last 10 Days Section (Initially hidden) -->
            <div id="recentCompanies" style="display: none;">
                <h2>Companies Created in the Last 10 Days</h2>
                <table class="table">

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
                                        alt="Companyy Logo" width="50">

                                </td>
                                <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                                <td>
                                    @if (Auth::user()->hasRole('admin'))
                                        <a href="{{ route('companies.edit', $company->id) }}"
                                            class="btn btn-primary">Edit</a>
                                    @endif
                                    @if (Auth::user()->hasRole('admin'))
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Button to toggle visibility of companies with more than two employees -->
            <button class="btn btn-secondary" id="toggleCompaniesWithEmployees">@lang('companies.show_companies')</button>

            <!-- Companies with More Than Two Employees Section (Initially hidden) -->
            <div id="companiesWithEmployees" style="display: none;">
                <h2>Companies with More Than Two Employees</h2>
                <table class="table">

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
                                        alt="Companyy Logo" width="50">
                                </td>
                                <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                                <td>

                                    @if (Auth::user()->hasRole('admin'))
                                        <a href="{{ route('companies.edit', $company->id) }}"
                                            class="btn btn-primary">Edit</a>

                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h2>@lang('companies.all_companies')</h2>
            <table class="table">

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
                                @endif
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    @if (Auth::user()->hasRole('admin'))
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this company?')">@lang('companies.delete')</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $companies->links('pagination.custom') }}

        </div>
    </main>

    <script>
        document.getElementById('toggleRecentCompanies').addEventListener('click', function() {
            var recentCompanies = document.getElementById('recentCompanies');
            if (recentCompanies.style.display === 'none') {
                recentCompanies.style.display = 'block';
                this.textContent = 'Hide Companies Created in the Last 10 Days';
            } else {
                recentCompanies.style.display = 'none';
                this.textContent = 'Show Companies Created in the Last 10 Days';
            }
        });

        // Script to toggle visibility of companies with more than two employees
        document.getElementById('toggleCompaniesWithEmployees').addEventListener('click', function() {
            var companiesWithEmployees = document.getElementById('companiesWithEmployees');
            if (companiesWithEmployees.style.display === 'none') {
                companiesWithEmployees.style.display = 'block';
                this.textContent = 'Hide Companies with More Than Two Employees';
            } else {
                companiesWithEmployees.style.display = 'none';
                this.textContent = 'Show Companies with More Than Two Employees';
            }
        });
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

    </script>
@endsection
