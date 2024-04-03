<!-- resources/views/companies/index.blade.php -->

@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>List of Companies</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            @if ($company->logo)
                                <img src="{{ $company->logo }}" alt="Company Logo" width="50">
                            @else
                                No Logo
                            @endif
                        </td>
                        <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                        <!-- Display more company information as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
