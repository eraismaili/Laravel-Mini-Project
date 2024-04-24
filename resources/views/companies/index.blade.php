@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>List of Companies</h1>

        <div class="mb-3">
            <a href="{{ route('companies.create') }}" class="btn btn-primary">Create New Company</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            @if ($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="50">
                            @else
                                No Logo
                            @endif
                        </td>
                        <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                        <td>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $companies->links('pagination.custom') }}
    </div>
@endsection
