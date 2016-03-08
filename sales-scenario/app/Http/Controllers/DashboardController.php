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
        //Get x nr of randomized tags
        $randomizedTags = $this->getRandomizedTags();

        //Get x nr of newest created podcasts
        $podcasts =  $this->getNewestPodcasts();

        //Get x nr of most contributing experts
        $experts = $this->getMostContributingExperts();

        //Now we have our models, and we can send these to the dashboard view
        return view('dashboard')->with(compact('experts', 'podcasts', 'randomizedTags'));
    }

    /**
     * @param int $toTake
     */
    private function getRandomizedTags($toTake = 5)
    {
        //Get x number of tags by parameter in function random()
        $tagsToTake = $toTake;
        $allTags = Tag::all();

        if($allTags->count() < $tagsToTake)
        {
            //We can't take as many as value of $tagsToTake says.
            //But we take what som many we can get instead.
            $randomizedTags = $allTags->random($allTags->count());
        }
        else
        {
            $randomizedTags = $allTags->random($tagsToTake);
        }

        return $randomizedTags;
    }

    /**
     * @param int $toTake
     */
    private function getNewestPodcasts($toTake = 5)
    {
        return Podcast::orderBy('created_at', 'desc')->take($toTake)->get();
    }

    /**
     * @param int $toTake
     */
    private function getMostContributingExperts($toTake = 5)
    {
        $experts = Expert::all();

        //Prevent error for splice function by setting to Zero if No experts exists.
        if($experts->count() == 0)
        {
            $toTake = 0;
        }

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
        $experts = $experts->sortByDesc('nrOfPodcasts')->splice(0, $toTake);

        return $experts;
    }
}
