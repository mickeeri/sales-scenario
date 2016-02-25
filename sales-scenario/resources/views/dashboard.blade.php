@extends('layouts.app')
@section('css')
        <!-- Styles for slider-->
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
@endsection
@section('content')

<div class="slider">
    @foreach($podcasts as $podcast)
        <div class="slider-item">
            <p>{{ $podcast->title }}</p>
            <img class="profile-img" src="/expert_photo/blank-profile-picture.png" alt="Profile image of {{ $podcast->expert->first_name}} {{  $podcast->expert->last_name }}"/>
            <p>By {{ $podcast->expert->first_name }} {{ $podcast->expert->last_name }}</p>
            <a href="/player/{{ $podcast->expert->id }}/{{ $podcast->id }}">Play</a>
        </div>
    @endforeach
</div>

    <h2 class="center">Most Contributing</h2>

    <ul class="expert-list explore-list">
        @each('partials.expert_listing', $experts, 'expert')
    </ul>
    <a href="/explore" class="read-more">View more</a>

    <h2 class="center">Explore topics</h2>

    <ul class="tag-list explore-list">
        @foreach($tags as $tag)
            <li><a href="/explore/{{ $tag->id }}"><span>{{ $tag->name }}</span></a></li>
        @endforeach
    </ul>
@endsection

@section('js')
        <!-- Script for slider-->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/slick/slick.min.js"></script>
@endsection

