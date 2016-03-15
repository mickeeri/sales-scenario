<?php

namespace App\Http\Controllers;

use App\Expert;
use App\Podcast;
use Carbon\Carbon;
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
            return redirect('expert/'.$expert)->with('status', "The audio blog you are looking for can't be found.");
        }elseif(!$author){
            return redirect('explore')->with('status', "The sales expert you are looking for can't be found.");
        }

        //Remove old history relationships for this podcast to save db space
        \Auth::user()->podcasts()->detach($podcast->id);
        //Log new history i db
        \Auth::user()->podcasts()->attach($podcast->id);

        return view('player')->with(compact('author', 'podcast'));
    }

    public function history($days = 30, $limit = 10)
    {
        if(!is_numeric($days) || $days < 1 || $days > 30){
            return redirect('player/history/30/' . $limit);
        }

        if(!is_numeric($limit) || $limit < 1 || $limit > 100){
            return redirect('player/history/' . $days . '/10');
        }

        $carbon = Carbon::now()->subDays($days);
        $podcasts = \Auth::user()->podcasts()->withPivot('created_at')->where('podcast_user.created_at', '>', $carbon->format('Y-m-d H:i:s'))->get()->sortBy('pivot.created_at')->reverse();

        //Limit podcasts if more than defined number
        if($podcasts->count() > $limit){
            $podcasts = $podcasts->splice(0, $limit);
        }

        return view('history')->with(compact('podcasts', 'days', 'limit'));
    }

}
