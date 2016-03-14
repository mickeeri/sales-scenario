<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MostContributingTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function test_expert_with_most_podcasts_show(){

        $leastContributing = $this->createExpertWithMultiplePodcasts(2);

        for ($i = 0; $i < 5; $i++) {
            $this->createExpertWithMultiplePodcasts(5);
        }

        // Now there are seven experts. Most contributing only shows five.
        $mostContributing = $this->createExpertWithMultiplePodcasts(8);

        foreach($this->getLinksForMostContributingAndExploreTopics() as $link){
            // Assert that the expert with the most podcasts are visible and that the
            // expert with the least podcast is not.
            $this->visit($link)
                ->seeInElement(".explore-list", "$mostContributing->full_name")
                ->dontSeeInElement(".explore-list", "$leastContributing->full_name");
        }
    }

    public function test_expert_not_most_contributing_not_show(){

        //Creating expert without podcast
        $expert_no_podcasts = factory(App\Expert::class)->create();
        foreach($this->getLinksForMostContributingAndExploreTopics() as $link){
            $this->visit($link)
                ->dontSeeLink("$expert_no_podcasts->full_name");
        }
    }

    public function test_expert_without_podcast_not_show(){

        //Creating 4 experts with podcasts
        for ($i = 0; $i < 4; $i++) {
            $this->createExpertWithMultiplePodcasts(1);
        }
        //Most contribution can show up to 5 experts, but this one without podcasts should
        // not show even if there are only 4 other experts
        $expert_no_podcasts = factory(App\Expert::class)->create();
        foreach($this->getLinksForMostContributingAndExploreTopics() as $link){
            $this->visit($link)
                ->dontSeeLink("$expert_no_podcasts->full_name");
        }
    }
}