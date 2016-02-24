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
        <ul class="expert-list explore-list">
            @each('partials.expert_listing', $experts, 'expert')
        </ul>
    @endforeach
@endsection