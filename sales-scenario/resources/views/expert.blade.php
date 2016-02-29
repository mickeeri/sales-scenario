@extends('layouts.app')

@section('js')

@endsection

@section('content')
    @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="profile-information">
        <div class="image-div">
        @if($expert->photo)
            <img class="expert-img" src="/expert_photo/{{ $expert->photo }}" alt="Profile picture of {{ $expert->first_name }} {{ $expert->last_name }}"/>
        @else
            <img class="expert-img" src="/expert_photo/blank-profile-picture.png" alt="Profile picture of {{ $expert->first_name }} {{ $expert->last_name }}"/>
        @endif
        </div>
        <div class="info">
            <h1>{{ $expert->first_name }} {{ $expert->last_name }} </h1>
            <ul class="expert-tags">
            @foreach($expert->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
            </ul>
            <p>{{ $expert->info }}</p>
            <p><em><a href=" {{ $expert->website }}">Visit website</a></em></p>
        </div>
    </div>
    <div class="experts-podcasts">
        <!--Insert photo somewhere here. Should we show tags here also? -->
        <h3>Podcasts by {{ $expert->first_name }} {{ $expert->last_name }}</h3>
        <hr/>
        @if(count($expert->podcasts))
        <ul class="explore-list">
        @foreach($expert->podcasts as $podcast)
            <li><a href="/player/{{ $expert->id }}/{{ $podcast->id }}">{{ $podcast->title }}</a></li>
        @endforeach
        </ul>
        @endif
    </div>
@endsection