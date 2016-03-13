@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <h1>History</h1>
        <div id="explore_filter">
            <a href="#" class='explore-sort-button' type='button' id='hideshow' value='hide/show'>
                <i class="fa fa-filter white-icon-orange-bg"></i>
            </a>

        </div>
        <div class="history-filter filter-popup">
            <ul>
                <li class="filter-heading">Limit</li>
                <li><a href="/player/history/{{ $days }}/10" <?= ($limit == 10 ? 'class="current"' : '') ?>>10</a></li>
                <li><a href="/player/history/{{ $days }}/25" <?= ($limit == 25 ? 'class="current"' : '') ?>>25</a></li>
                <li><a href="/player/history/{{ $days }}/50" <?= ($limit == 50 ? 'class="current"' : '') ?>>50</a></li>
                <li><a href="/player/history/{{ $days }}/100" <?= ($limit == 100 ? 'class="current"' : '') ?>>100</a></li>
            </ul>
            <ul>
                <li class="filter-heading">Days back</li>
                <li><a href="/player/history/1/{{ $limit }}" <?= ($days == 1 ? 'class="current"' : '') ?>>1 day</a></li>
                <li><a href="/player/history/7/{{ $limit }}" <?= ($days == 7 ? 'class="current"' : '') ?>>7 days</a></li>
                <li><a href="/player/history/30/{{ $limit }}" <?= ($days == 30 ? 'class="current"' : '') ?>>30 days</a></li>
            </ul>
        </div>
    </div>
    <div class="wrapper no-padding">
        <ul class="explore-list">
            @if(count($podcasts) != 0)
                @foreach($podcasts as $podcast)
                    <li class="expert">
                        <a href="/player/{{ $podcast->expert->slug }}/{{ $podcast->slug }}">
                            <span class="title">{{ $podcast->title }}</span><br/>
                            <span class="podcast-date">{{ $podcast->expert->full_name }}<br/>Played on {{ $podcast->pivot->created_at->format('F d Y') }}</span>
                        </a>
                    </li><!---->
                @endforeach
            @else
                <li>You have not yet listened to any podcasts</li>
            @endif


        </ul>
    </div>
@endsection