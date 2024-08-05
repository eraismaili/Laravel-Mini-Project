@extends('layouts.layout')

@section('content')
    @if (Auth::user()->hasRole('admin'))
        <style>
            /* .content-wrapper {
                                margin-left: 250px;

                                padding: 20px;
                            } */
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

            header .navbar {
                background-color: rgba(0, 0, 0, 0.7);
            }

            .small-box {
                position: relative;
                display: block;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
                border-radius: .25rem;
                margin-bottom: 20px;
                color: #fff;
                padding: 20px;
                text-align: center;
            }

            .small-box h3 {
                font-size: 2.2rem;
                font-weight: bold;
            }

            .small-box p {
                font-size: 1.2rem;
            }

            .small-box .icon {
                top: 10px;
                right: 10px;
                z-index: 0;
                font-size: 3.5rem;
                position: absolute;
                color: rgba(0, 0, 0, 0.15);
            }

            .small-box-footer {
                display: block;
                padding: 3px 0;
                text-align: center;
                background: rgba(0, 0, 0, 0.1);
                text-decoration: none;
                color: #fff;
                font-weight: bold;
            }

            .bg-aqua {
                background-color: #00c0ef !important;
            }

            .bg-green {
                background-color: #00a65a !important;
            }

            .bg-yellow {
                background-color: #f39c12 !important;
            }

            .bg-red {
                background-color: #dd4b39 !important;
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
                                        <a class="dropdown-item" href="{{ route('companies.index') }}">@lang('profile.companies')</a>

                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">@lang('profile.logout')</button>
                                        </form>
                                    </div>
                                </li>
                                @if (Auth::user()->hasRole('admin'))
                                    <li class="nav-item"><a class="nav-link" href="{{ route('companies.index') }}">Companies</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                                    </li>
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
        <br>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Dashboard</h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Companies</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('companies.index') }}" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Employees</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('employees.index') }}" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>65</h3>
                                <p>Profile</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('profile.show') }}" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
@endsection
