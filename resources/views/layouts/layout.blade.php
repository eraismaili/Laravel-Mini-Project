<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application</title>

    <!-- Add Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include your application's CSS file -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Footer</p>
    </footer>

    <!-- Include Bootstrap JS link (optional, only if you need Bootstrap JavaScript functionality) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include your application's JavaScript file -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
