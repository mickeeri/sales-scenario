<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MostContributingTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;



    private function getURL()
    {
        $this->login();
        $expert = $this->getExpertWithPodcast();
        $podcast = $expert->podcasts[0];
        return $player = '/player/' . $expert->slug . '/' . $podcast->slug;
    }
    private function getVisitLinks(){
        $a = array(
            $this->getURL(),
            "dashboard"
        );
        return $a;

    }
    public function test_expert_with_most_podcasts_show(){

        //Since the factory creates expert with max 10 podcasts, this expert must be most contributing

        $leastContributing = $this->createExpertWithMultiplePodcasts(2);

        for ($i = 0; $i < 5; $i++) {
            $this->createExpertWithMultiplePodcasts(5);
        }

        $mostContributing = $this->createExpertWithMultiplePodcasts(11);

        foreach($this->getVisitLinks() as $link){
            $this->visit($link)
                ->see("$mostContributing->full_name")
                ->dontSee("$leastContributing->full_name");
        }
    }

    public function test_expert_not_most_contributing_not_show(){

        $expert_no_podcasts = factory(App\Expert::class)->create();
        foreach($this->getVisitLinks() as $link){
            $this->visit($link)
                ->dontSeeLink("$expert_no_podcasts->full_name");
        }

    }

    public function test_expert_without_podcast_not_show(){
        for ($i = 0; $i < 4; $i++) {
            $this->createExpertWithMultiplePodcasts(1);
        }

        $expert_no_podcasts = factory(App\Expert::class)->create();
        foreach($this->getVisitLinks() as $link){
            $this->visit($link)
                ->dontSeeLink("$expert_no_podcasts->full_name");
        }
    }
}