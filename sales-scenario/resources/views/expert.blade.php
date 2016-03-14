@extends('layouts.app')

@section('js')

@endsection

@section('content')
    <div class="profile-information">
        <div class="wrapper">
            @include('partials.expert_img', array('src' =>$expert->photo, 'class' =>'expert-img', 'first' =>$expert->first_name, 'last' =>$expert->last_name))
            <div class="info">
                <h1>{{ $expert->first_name }} {{ $expert->last_name }} </h1>
                <ul class="expert-tags">
                @foreach($expert->tags as $tag)
                    <li>{{ $tag->name }}</li>
                @endforeach
                </ul>
                <p>{{ $expert->info }}</p>
                @if ($expert->website)
                    <a class="expert-website" href=" {{ $expert->website }}">Visit website</a>
                @endif
            </div>
        </div>
    </div>
    <div class="experts-podcasts">
        <div class="wrapper">
            <h2 class="center">Podcasts</h2>
        </div>
        @if(count($expert->podcasts))
            <div class="wrapper no-padding">
                <ul class="explore-list">
                @foreach($expert->podcasts as $podcast)
                    <li>
                        <a href="/player/{{ $expert->slug }}/{{ $podcast->slug }}">
                            <span class="title">{{ $podcast->title }}</span><br/>
                            <span class="podcast-date">{{ $podcast->created_at->format('F d Y') }}</span>
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection