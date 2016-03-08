@extends('layouts.app')

@section('content')

    <div id="slider_wrapper">
        <h2 class="center upper">What's new</h2>
        @include('partials.slider')
    </div>
    <h2 class="center">Most Contributing</h2>
    @include('partials.most_contribution_expert')

    <a href="/explore" class="read-more">View more</a>

    <h2 class="center">Explore topics</h2>
    @include('partials/explore_topics')

@endsection



