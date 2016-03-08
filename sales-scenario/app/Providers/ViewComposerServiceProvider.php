<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Expert;
use App\Tag;
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.explore_topics', function($view){
            $randomizedTags = self::getRandomizedTags(5);
            $view->with(compact('randomizedTags'));
        });

        view()->composer('partials.most_contribution_expert', function($view){
            $experts = self::getMostContributingExperts(5);
            $view->with(compact('experts'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @param int $toTake
     */
    public static function getMostContributingExperts($toTake = 5)
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

    /**
     * @param int $toTake
     */
    public static function getRandomizedTags($toTake = 5)
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

}
