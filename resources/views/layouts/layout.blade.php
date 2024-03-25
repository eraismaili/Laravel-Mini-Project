<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application</title>

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


    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
