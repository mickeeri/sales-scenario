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

    <meta name="theme-color" content="#e95d0f">
    <!-- Icons -->
    <link rel="icon" href="/img/icons/favicon-16.png" sizes="16X16">
    <link rel="icon" href="/img/icons/favicon-32.png" sizes="32x32">
    <link href="/img/icons/icon57.png" rel="apple-touch-icon" />
    <link href="/img/icons/icon76.png" rel="apple-touch-icon" sizes="76x76" />
    <link href="/img/icons/icon120.png" rel="apple-touch-icon" sizes="120x120" />
    <link href="/img/icons/icon152.png" rel="apple-touch-icon" sizes="152x152" />
    <link href="/img/icons/icon180.png" rel="apple-touch-icon" sizes="180x180" />
    <link href="/img/icons/icon192.png" rel="icon" sizes="192x192" />
    <link href="/img/icons/icon128.png" rel="icon" sizes="128x128" />

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
            <a href="/" id="logo">
                <img src="/img/logo_small.png"/>
            </a>
            <nav class="wrapper">
                <ul id="top">
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('/explore') }}">Explore</a></li>
                    <li><a href="{{ url('/player/history') }}">History</a></li>
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
            <div class="flash-message">
                <div class="message success">
                    <a href="" class="flash-close">x</a>
                    {{ session('status') }}
                </div>
            </div>
        @endif
        @yield('content')
    </div>


    <div id="footer">
        <!-- Share button -->
        <div class="share-buttons-wrapper">
            <div class="share-buttons a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="share-button a2a_button_twitter" ></a>
                <a class="share-button a2a_button_linkedin"></a>
                <a class="share-button a2a_button_facebook"></a>
            </div>
        </div>
        <!-- Share button end -->
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/js/scripts.js"></script>
    <script async src="/js/addtoany.share.button.js"></script> <!-- Share button js -->
    @yield('js')

</body>
</html>