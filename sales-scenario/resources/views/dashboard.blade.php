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

    <h2>Most Contributing</h2>

    <ul>
        @foreach($experts as $expert)
            <li>
                <a href="/expert/{{ $expert->id }}">

                    <h4>{{ $expert->first_name }} {{ $expert->last_name }}</h4>
                    @foreach($expert->tags as $tag)
                        {{ $tag->name }}
                    @endforeach
                </a>
            </li>
        @endforeach
    </ul>

    <h2>Explore topics</h2>

    <ul>
        @foreach($tags as $tag)
            <li><a href="/explore/{{ $tag->id }}">{{ $tag->name }}</a></li>
        @endforeach
    </ul>



@endsection
