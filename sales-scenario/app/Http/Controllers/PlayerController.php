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

        return view('player')->with(compact('author', 'podcast'));
    }

}
