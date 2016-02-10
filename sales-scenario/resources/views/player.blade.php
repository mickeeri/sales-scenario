@extends('layouts.app')

@section('css')
    <!-- Style for circle player -->
    <link type="text/css" href="/css/circle.player.css" rel="stylesheet" />
@endsection

@section('js')
    <!-- JPlayer -->
    <script type="text/javascript" src="/js/jquery.transform2d.js"></script>
    <script type="text/javascript" src="/js/jquery.grab.js"></script>
    <script type="text/javascript" src="/js/mod.csstransforms.min.js"></script>
    <script type="text/javascript" src="/js/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="/js/circle.player.js"></script>
    <script type="text/javascript" src="/js/audioplayer.js"></script>
@endsection

@section('content')
    <!-- The jPlayer div must not be hidden. Keep it at the root of the body element to avoid any such problems. -->
    <div id="jquery_jplayer_1" class="cp-jplayer"></div>
    <div id="slider">
        <h2>What's new</h2>
        <div class="slide">
            <img src="" alt="Profile image of Dave Stein" />
            <p class="description">
                <span class="podcast-title">The sales letter comes last in sales</span>
                <span class="podcast-author">By David Stein</span>
            </p>
        </div>
        <audio controls>
            <source src="http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>



        <!-- The container for the interface can go where you want to display it. Show and hide it as you need. -->
        <div id="cp_container_1" class="cp-container">
            <div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
                <div class="cp-buffer-1"></div>
                <div class="cp-buffer-2"></div>
            </div>
            <div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
                <div class="cp-progress-1"></div>
                <div class="cp-progress-2"></div>
            </div>
            <div class="cp-circle-control"></div>
            <ul class="cp-controls">
                <li><a class="cp-play" tabindex="1">play</a></li>
                <li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
            </ul>
        </div>


@endsection