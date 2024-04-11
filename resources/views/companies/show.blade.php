<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Company</title>
</head>

<body>
    <h1>{{ $company->name }}</h1>
    <p>Email: {{ $company->email }}</p>
    @if ($company->logo)
        <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo">
    @else
        <p>No logo available</p>
    @endif
    <a href="{{ route('companies.edit', $company->id) }}">Edit</a>
    <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</body>

</html>
