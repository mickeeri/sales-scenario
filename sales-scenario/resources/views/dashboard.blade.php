@extends('layouts.app')

@section('content')

    <div id="dashboard_slider">
        @foreach($podcasts as $podcast)
            <div class="slide">
                <p>{{ $podcast->title }}</p>
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
