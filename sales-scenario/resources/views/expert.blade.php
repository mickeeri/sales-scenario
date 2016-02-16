@extends('layouts.app')

@section('js')

@endsection

@section('content')
        <h1>{{ $expert->first_name }} {{ $expert->last_name }} </h1>
        @foreach($expert->podcasts as $podcast)
            <a href="/player/{{ $expert->id }}/{{ $podcast->id }}">{{ $podcast->title }}</a>
        @endforeach
@endsection