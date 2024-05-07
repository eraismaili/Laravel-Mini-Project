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
            /* padding: 20px; */
            text-align: center;
            position: relative;
            /* min-height: calc(100vh - 120px); */
            display: flex;
            justify-content: center;
            align-items: center;
        }


        main h1 {
            font-size: 3rem;
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
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                            <a class="dropdown-item" href="{{ route('profile.update-password.form') }}">Update Password</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </li>
                    @if (Auth::user()->hasRole('admin'))
                        <li><a href="{{ route('companies.index') }}">Companies</a></li>
                        <li><a href="{{ route('employees.index') }}">Employees</a></li>
                    @endif
                @endguest
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>List of Companies</h1>

            <div class="mb-3">
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('companies.create') }}" class="btn btn-primary">Create New Company</a>
                @endif
            </div>

            <!-- Button to toggle visibility of companies created in the last 10 days -->
            <button class="btn btn-secondary" id="toggleRecentCompanies">Show Companies Created in the Last 10 Days</button>

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
                                    @if ($company->logo)
                                        <img src="{{ asset('storage/app/public/images' . $company->logo) }}"
                                            alt="Company Logo" width="50">
                                    @else
                                        No Logo
                                    @endif
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
            <button class="btn btn-secondary" id="toggleCompaniesWithEmployees">Show Companies with More Than Two
                Employees</button>

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
                                    @if ($company->logo)
                                        <img src="{{ asset('storage/app/public/images' . $company->logo) }}"
                                            alt="Company Logo" width="50">
                                    @else
                                        No Logo
                                    @endif
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

            <h2>All Companies</h2>
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
                                @if ($company->logo)
                                    <img src="{{ asset('storage/images/' . $company->logo) }}" alt="Company Logo"
                                        width="50">
                                @else
                                    No Logo
                                @endif
                            </td>
                            <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                            <td>
                                @if (Auth::user()->hasRole('admin'))
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">Edit</a>
                                @endif
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    @if (Auth::user()->hasRole('admin'))
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
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
