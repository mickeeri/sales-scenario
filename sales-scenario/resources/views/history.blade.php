@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <h1>Player history</h1>
    </div>
    <div class="wrapper no-padding">
        <ul class="explore-list">
            @foreach($podcasts as $podcast)
                <li class="expert">
                    <a href="/player/{{ $podcast->expert->slug }}/{{ $podcast->slug }}">

                        <span class="title">{{ $podcast->title }}</span><br/>
                        <span class="podcast-date">{{ $podcast->expert->full_name }}<br/>Played on {{ $podcast->pivot->created_at->format('F d Y') }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection