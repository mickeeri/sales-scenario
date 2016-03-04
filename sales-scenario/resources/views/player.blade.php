@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/vendor/soundmanager/css/360player.css" />
    <link rel="stylesheet" type="text/css" href="/vendor/soundmanager/css/flashblock.css" />
@endsection

@section('js')

    <!-- Apache-licensed animation library -->
    <script type="text/javascript" src="/vendor/soundmanager/script/berniecode-animator.js"></script>

    <!-- the core stuff -->
    <script type="text/javascript" src="/vendor/soundmanager/script/soundmanager2.js"></script>
    <script type="text/javascript" src="/vendor/soundmanager/script/360player.js"></script>
    <script type="text/javascript">
        threeSixtyPlayer.config.playRingColor = '#e95d0f';

        soundManager.setup({
    // path to directory containing SM2 SWF
            url: '/vendor/soundmanager/swf/'
        });
    </script>


@endsection

@section('content')
    <div class="wrapper no-padding">
        <div id="player_content">
            <div class="player-info-area">
                @include('partials.expert_img', ['src' => $author->photo, 'class'=> 'profile-img', 'first' => $author->first_name, 'last' => $author->last_name])
    
                <div class="description">
                    <p class="podcast-title center">{{ $podcast->title }}</p>
                    <p class="center"><a class="podcast-author" href="#">By {{ $author->first_name }} {{ $author->last_name }}</a></p>
                    <div id="expert_info">
                        <h4>About {{ $author->first_name }} {{ $author->last_name }}</h4>
                        <p>{{ $author->info }}</p>
                    </div>
                </div>
                </div>
            <div class="clear"></div>
    
            <div class="player-gray-area">
            <div class="ui360">
                <a href="/audio/podcasts/{{ $podcast->filename }}">{{ $podcast->title }}</a>
            </div>
            <p class="center podcast-time-text"></p>
            </div>
        </div>
    </div>
@endsection