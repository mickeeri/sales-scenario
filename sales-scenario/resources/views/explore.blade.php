@extends('layouts.app')

@section('js')

@endsection

@section('content')
    @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
    @endif
    @foreach($list as $letter => $experts)
        <h2>{{ $letter }}</h2>
        @foreach($experts as $expert)
            <a href="/expert/{{$expert->id}}">{{ $expert->first_name }} {{ $expert->last_name }}</a>
            <p>Sales Strategy, Social Selling, Old School Sales</p>
        @endforeach
    @endforeach
@endsection