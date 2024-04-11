<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Employee</h1>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="{{ $employee->first_name }}">

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="{{ $employee->last_name }}">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $employee->email }}">

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" value="{{ $employee->phone }}">

            <label for="company_id">Company ID:</label>
            <input type="text" name="company_id" id="company_id" value="{{ $employee->company_id }}">

            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>
