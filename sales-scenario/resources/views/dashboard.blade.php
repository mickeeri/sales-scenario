@extends('layouts.app')

@section('content')
    <div id="slider_wrapper">
            <h2 class="center upper">What's new</h2>
            @include('partials.slider')

    </div>
    <div class="wrapper no-padding">
        <h2 class="center">Most Contributing</h2>

        <ul class="explore-list">
            @each('partials.expert_listing', $experts, 'expert')
        </ul>
        <a href="/explore" class="read-more">View more</a>

        <h2 class="center">Explore topics</h2>

        <ul class="tag-list explore-list">
            @foreach($tags as $tag)
                <li><a href="/explore/{{ $tag->slug }}"><span>{{ $tag->name }}</span></a></li>
            @endforeach
        </ul>
    </div>
@endsection



