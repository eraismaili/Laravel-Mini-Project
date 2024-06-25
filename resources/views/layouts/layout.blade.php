<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Application</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            background-image: url('/images/pic.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .wrapper {
            display: flex;
            width: 100%;
            flex: 1;
            flex-direction: row;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #343a40;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }

        #sidebar ul li a:hover {
            color: #343a40;
            background: #fff;
        }

        .content {
            width: 100%;
            padding: 20px;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            display: inline;
            margin: 0 10px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            text-align: center;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main h1 {
            font-size: 3rem;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @auth
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>{{ Auth::user()->name }}{{ Auth::user()->last_name }}</h3>
                </div>
                <ul class="list-unstyled components">
                    @if (Auth::user()->hasRole('admin'))
                        <li class="active">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle">Dashboard</a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            </ul>
                        </li>
                    @endif
                    <li><a href="{{ route('companies.index') }}">Companies</a></li>
                    <li>
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('employees.index') }}">Employees</a>
                        @endif
                    </li>
                    <li><a href="{{ route('profile.show') }}">Profile</a></li>
                </ul>
            </nav>
        @endauth

        <div class="content">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Footer</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js">
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

</body>

</html>
