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
        //Get x nr of newest created podcasts
        $podcasts =  $this->getNewestPodcasts();

        //Now we have our models, and we can send these to the dashboard view
        return view('dashboard')->with(compact('podcasts'));
    }


    /**
     * @param int $toTake
     */
    private function getNewestPodcasts($toTake = 5)
    {
        return Podcast::orderBy('created_at', 'desc')->take($toTake)->get();
    }


}
