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

    <div id="player-content">
        <div class="slide">
            @include('partials.expert_img', array('src' =>$player['imgSrc'], 'class'=> 'profile-img', 'first' =>$player['expertFirst'], 'last' =>$player['expertLast']))

            <div class="description">
                <span class="podcast-title">{{$player['podcastTitle']}}</span>
                <a class="podcast-author" href="#">By {{ $player['expertFirst'] }} {{ $player['expertLast'] }}</a>
                <div id="expert_info" style="display: none">
                    <h4>About {{ $player['expertFirst'] }} {{ $player['expertLast'] }}</h4>
                    <p>{{$player['expertInfo']}}</p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="ui360">
            <a href="{{ $player["podcastFile"] }}">{{$player['podcastTitle']}}</a>
        </div>

    </div>


@endsection