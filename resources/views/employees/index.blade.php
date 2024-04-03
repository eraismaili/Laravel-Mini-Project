<!-- resources/views/employees/index.blade.php -->
@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>List of Employees</title>
    </head>

    <body>
        <h1>List of Employees</h1>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <!-- Display more employee information as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>

    </html>
@endsection
