@extends('layouts.layout')

@section('content')
    @if (Auth::user()->hasRole('admin'))
        <style>
            .content-wrapper {
                margin-left: 250px;

                padding: 20px;
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
