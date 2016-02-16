@extends('layouts.app')

@section('js')

@endsection

@section('content')
        <div class="profile-information">
                <h1>{{ $expert->first_name }} {{ $expert->last_name }} </h1>
                <p>{{ $expert->info }}</p>
                <p><em><a href=" {{ $expert->website }}"> {{ $expert->website }}</a></em></p>
                <img src="/expert_photo/{{ $expert->photo }}" alt="Profile picture of {{ $expert->first_name }} {{ $expert->last_name }}"/>
        </div>
        <!--Insert photo somewhere here. Should we show tags here also? -->
        @if(count($expert->podcasts))
                <ul>
                @foreach($expert->podcasts as $podcast)
                    <li><a href="/player/{{ $expert->id }}/{{ $podcast->id }}">{{ $podcast->title }}</a></li>
                @endforeach
                </ul>
        @endif
@endsection