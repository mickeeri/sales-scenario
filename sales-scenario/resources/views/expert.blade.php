@extends('layouts.app')

@section('js')

@endsection

@section('content')
        <h1>{{ $expert->first_name }} {{ $expert->last_name }} </h1>
        <p>{{ $expert->info }}</p>
        <p><em><a href=" {{ $expert->website }}"> {{ $expert->website }}</a></em></p>
        <!--Insert photo somewhere here. Should we show tags here also? -->
        @foreach($expert->podcasts as $podcast)
            <a href="/player/{{ $expert->id }}/{{ $podcast->id }}">{{ $podcast->title }}</a><br>
        @endforeach
@endsection