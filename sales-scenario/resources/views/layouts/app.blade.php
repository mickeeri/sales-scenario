<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link type="text/css" href="/css/main.css" rel="stylesheet" />

    @yield('css')
    <title>Sales Scenario</title>
</head>
<body>
    @if (Auth::guest())
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/register') }}">Register</a>
    @else
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Dashboard</a></li>
                <li><a href="{{ url('/') }}">Explore</a></li>
                <li><a href="{{ url('/') }}">Profile Settings</a></li>
                <li><a href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        </nav>
    @endif

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        @yield('js')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
