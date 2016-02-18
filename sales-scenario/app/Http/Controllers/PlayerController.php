<?php

namespace App\Http\Controllers;

use App\Expert;
use App\Podcast;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    public function Index($expert, $track) {

        $podcast = Podcast::find($track);
        $author = Expert::find($expert);    //TODO: Change to slug???

        if(!$podcast) {
            return redirect('expert/'.$expert)->with('status', 'The podcast you are looking for cant be found.');
        }

        if(!$author) {
            return redirect('explore')->with('status', 'The sales expert you are looking for cant be found.');
        }

        else {
            $path = '/audio/' . $podcast->id;
            //Get the ext of the file
            $ext = pathinfo($podcast->filename);
            $ext = $ext['extension'];

            $player = [
                'imgSrc' => $author->photo,
                'expertFirst' => $author->first_name,
                'expertLast' => $author->last_name,
                'podcastTitle' => $podcast->title,
                'podcastType' => $ext,
                'podcastPath' => $path,
            ];

            return view('player')->with(compact('player'));
        }
    }

}
