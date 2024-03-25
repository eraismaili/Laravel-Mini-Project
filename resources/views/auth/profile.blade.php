@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <!-- Include any CSS or JavaScript libraries -->
    </head>

    <body>
        <header>
            <!-- Include your header content here -->
            <h1>Profile</h1>
        </header>

        <nav>
            <!-- Include your navigation menu here -->
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/profile">Profile</a></li>
                <li><a href="/logout">Logout</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>

        <main>
            <!-- Profile content goes here -->
            <h2>Welcome, {{ Auth::user()->name }}</h2>
            <!-- Display user profile information -->
            <p>Email: {{ Auth::user()->email }}</p>
            <!-- Add more profile information as needed -->
        </main>

        <footer>
            <!-- Include your footer content here -->
            <p>&copy; <?php echo date('Y'); ?> Your Website Footer</p>
        </footer>

        <!-- Include any additional JavaScript at the bottom -->
    </body>

    </html>
@endsection
