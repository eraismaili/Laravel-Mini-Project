<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Employee</title>
</head>

<body>
    <h1>{{ $employee->name }}</h1>
    <p>Employee Email: {{ $employee->email }}</p>

    <a href="{{ route('employees.edit', $employee->id) }}">Edit</a>

    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</body>

</html>
