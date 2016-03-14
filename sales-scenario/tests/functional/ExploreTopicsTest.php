<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExploreTopicsTest extends TestCase
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

    public function test_5_tags_always_show(){

        // Tags without experts does not show, so each tag needs an expert
        $expert = $this->createExpertWithMultiplePodcasts(2);
        $tags = [];

        // Creating five tags
        for ($i = 0; $i < 5; $i++) {
            $tags[] = \App\Tag::create(['name' => "Tag name " . $i]);
        }

        // Adding tags to expert.
        foreach ($tags as $tag) {
            $expert->tags()->attach($tag);
        }

        foreach ($this->getVisitLinks() as $link) {

            // Tags are randomized, so lets make sure we see the 5 tags after a refresh.
            for ($i = 0; $i < 2; $i++) {

                $this->visit($link);

                foreach ($tags as $tag) {
                    $this->seeLink($tag->name);
                }

            }
        }
    }
}