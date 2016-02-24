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
    public function Index()
    {
        $tags = Tag::all()->random(5);
        $podcasts =  Podcast::orderBy('created_at', 'desc')->take(5)->get();
        $experts = Expert::all();

        foreach ($experts as $expert)
        {
            $expert->nrOfPodcasts = $expert->podcasts->count();
        }

        $experts = $experts->sortByDesc('nrOfPodcasts')->splice(0, 5);

        return view('dashboard')->with(compact('experts', 'podcasts', 'tags'));

    }
}
