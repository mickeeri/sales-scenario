<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
