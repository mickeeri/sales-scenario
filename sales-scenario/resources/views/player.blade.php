@extends('layouts.app')

@section('content')
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
@endsection