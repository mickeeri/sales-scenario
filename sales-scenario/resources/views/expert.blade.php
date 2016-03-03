@extends('layouts.app')

@section('js')

@endsection

@section('content')
    <div class="profile-information">
        <div class="wrapper">
            <div class="image-div">
                @include('partials.expert_img', array('src' =>$expert->photo, 'class' =>'expert-img', 'first' =>$expert->first_name, 'last' =>$expert->last_name))
            </div>
            <div class="info">
                <h1>{{ $expert->first_name }} {{ $expert->last_name }} </h1>
                <ul class="expert-tags">
                @foreach($expert->tags as $tag)
                    <li>{{ $tag->name }}</li>
                @endforeach
                </ul>
                <p>{{ $expert->info }}</p>
                <a class="expert-website" href=" {{ $expert->website }}">Visit website</a>
            </div>
        </div>
    </div>
        <div class="experts-podcasts">
            <div class="wrapper">
                <h3>Podcasts by {{ $expert->first_name }} {{ $expert->last_name }}</h3>
            </div>
            @if(count($expert->podcasts))
                <div class="wrapper no-padding">
                    <ul class="explore-list">
                    @foreach($expert->podcasts as $podcast)
                        <li>
                            <a href="/player/{{ $expert->id }}/{{ $podcast->id }}">
                                <span class="title">{{ $podcast->title }}</span><br/>
                                <span class="podcast-date">{{ $podcast->created_at->format('Y-m-d') }}</span>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            @endif

    </div>
@endsection