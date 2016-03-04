<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Expert;
use App\Podcast;
use App\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        //Get x number of tags by parameter in function random()
        $tags = Tag::all()->random(5);
        //Get x newest created pordcasts
        $podcasts =  Podcast::orderBy('created_at', 'desc')->take(5)->get();
        $experts = Expert::all();

        //Most contributing expert
        foreach ($experts as $expert)
        {
            //For each expert we add a field that makes it easier to sort.
            $expert->nrOfPodcasts = $expert->podcasts->count();
        }

        //Check if any expert is without podcast, if so, remove that expert from the array
        foreach ($experts as $key => $expert){
            if($expert->nrOfPodcasts <=0){
                unset($experts[$key]);
            }
        }

        //Now we can use this field to sort out most contributing experts
        $experts = $experts->sortByDesc('nrOfPodcasts')->splice(0, 5);

        //Now we have our models so we can send these to the dashboard view
        return view('dashboard')->with(compact('experts', 'podcasts', 'tags'));
    }
}
