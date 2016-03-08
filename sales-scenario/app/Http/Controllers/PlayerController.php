<?php

namespace App\Http\Controllers;

use App\Expert;
use App\Podcast;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    public function index($expert, $track)
    {
        $author = Expert::findBySlugOrId($expert);
        $podcast = Podcast::findBySlugOrId($track);

        if($author && (!$podcast || $podcast->expert_id != $author->id)) {
            return redirect('expert/'.$expert)->with('status', "The podcast you are looking for can't be found.");
        }elseif(!$author){
            return redirect('explore')->with('status', "The sales expert you are looking for can't be found.");
        }

        //Remove old history relationships for this podcast to save db space
        \Auth::user()->podcasts()->detach($podcast->id);
        //Log new history i db
        \Auth::user()->podcasts()->attach($podcast->id);

        return view('player')->with(compact('author', 'podcast'));
    }

    public function history()
    {
        $podcasts = \Auth::user()->podcasts()->limit(10)->get();

        return view('history')->with(compact('podcasts'));
    }

}
