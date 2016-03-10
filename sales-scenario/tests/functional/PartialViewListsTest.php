<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartialViewListsTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function test_dashboard_lists(){
        $this->ExpertWithMostPodcastsShow("dashboard");
        $this->ExpertNotMostContributingNotShow("dashboard");
        $this->FiveTagsAlwaysShow("dashboard");
        $this->ExpertWithoutPodcastNotShow("dashboard");

    }

/*    public function test_player_lists(){

        $expert = $this->getExpertWithPodcast();
        $podcast = $expert->podcasts[0];
        $player = '/player/'.$expert->slug.'/'.$podcast->slug;

        $this->ExpertWithMostPodcastsShow($player);
        $this->ExpertNotMostContributingNotShow($player);
        $this->FiveTagsAlwaysShow($player);
        $this->ExpertWithoutPodcastNotShow($player);
    }*/
    private function createExpertWithPodcasts($numberOfPodcasts){

        $expert = factory(App\Expert::class)->create();

        for ($i = 0; $i <= $numberOfPodcasts; $i++) {
            $podcast = new App\Podcast;
            $podcast->title = "Example podcast";
            $podcast->expert_id = $expert->id;
            $expert->podcasts->add($podcast);
            $podcast->filename = "test.mp3";
            $podcast->save();
            $podcast->filename = "{$podcast->id}.mp3";
            $podcast->save();
        }
        return $expert;
    }

    private function ExpertWithMostPodcastsShow($location){

        //Since the factory creates expert with max 10 podcasts, this expert must be most contributing

        $leastContributing = $this->createExpertWithPodcasts(2);

        for ($i = 0; $i < 5; $i++) {
            $this->createExpertWithPodcasts(5);
        }

        $mostContributing = $this->createExpertWithPodcasts(11);

        $this->visit($location)
            ->see("$mostContributing->full_name")
            ->dontSee("$leastContributing->full_name");
    }

    private function ExpertNotMostContributingNotShow($location){

        $expert_no_podcasts = factory(App\Expert::class)->create();

        $this->visit($location)
            ->dontSeeLink("$expert_no_podcasts->full_name");

    }

    private function FiveTagsAlwaysShow($location){
        $tags = [];
        for ($i = 0; $i < 5; $i++) {
            $tags[] = \App\Tag::create([
                'name' => "Tag name " . $i
            ]);
        }

        //Tags are randomized, so lets make sure we see the 5 tags after a refresh
        for ($i = 0; $i < 2; $i++) {
            $this->visit($location);

            foreach ($tags as $tag) {
                $this->seeLink($tag->name);
            }
        }
    }

    private function ExpertWithoutPodcastNotShow($location){
        for ($i = 0; $i < 4; $i++) {
            $this->createExpertWithPodcasts(1);
        }

        $expert_no_podcasts = factory(App\Expert::class)->create();
        $this->visit($location)
            ->dontSeeLink("$expert_no_podcasts->full_name");
    }
}
