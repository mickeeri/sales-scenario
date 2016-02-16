@extends('layouts.app')

@section('js')

@endsection

@section('content')
    @foreach($list as $letter => $experts)
        <h2>{{ $letter }}</h2>
        @foreach($experts as $expert)
            <a href="/expert/{{$expert->id}}">{{ $expert->first_name }} {{ $expert->last_name }}</a>
        @endforeach
    @endforeach
@endsection