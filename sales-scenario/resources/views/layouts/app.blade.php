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
    <link type="text/css" href="/css/normalize.css" rel="stylesheet" />
    @yield('css')
    <link type="text/css" href="/css/main.css" rel="stylesheet" />

    <title>Sales Scenario</title>
</head>
<body
    @unless (Auth::check())
        class="unauthorized"
    @endunless
    >

    @if (Auth::check())
        <div id="header" class="orange-nav">
            <div id="menu_open"></div>
            <nav class="wrapper">
                <ul id="top">
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('/explore') }}">Explore</a></li>
                </ul>
                <ul id="bottom">
                    <li><a href="{{ url('/profile') }}">Profile Settings</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                </ul>
            </nav>
        </div>
    @endif

    <div id="content">
        @if (session('status'))
            <div class="alert">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </div>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/js/scripts.js"></script>
    @yield('js')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

</body>
</html>
