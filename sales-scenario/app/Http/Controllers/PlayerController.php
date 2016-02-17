<?php

namespace App\Http\Controllers;

use App\Expert;
use App\Podcast;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    private $podcast;

    public function Index($expert, $track) {

        $this->podcast = Podcast::find($track);
        $author = Expert::find($expert);    //TODO: Change to slug???

        $player = [
            'imgSrc'        => $author->photo,
            'expertFirst'   => $author->first_name,
            'expertLast'    => $author->last_name,
            'podcastTitle' => $this->podcast->title,
        ] ;

        return view('player')->with(compact('player'));
    }

    //m4a: "http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",

    /**
     * @return json   for jPlayer 'media' object
     */
    public function PodcastUrl() {

        $path = '/audio/'.$this->podcast->id;       // '/audio/podcast id'

        $mime = pathinfo($this->podcast->filename);
        $mime = $mime['extension'];

        $url = [
            $mime     => $path,
        ];

        return json_encode($url);
    }

}
